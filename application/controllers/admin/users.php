<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Admin {

    function __construct(){
		parent::__construct();
        $this->load->library(array('table','form_validation'));
        $this->load->library('email');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        $this->data['msg'] = '';
    }
    
    function index(){
        // List users
        $result = $this->db->get('users');
        $this->data['msgreset'] = $this->session->flashdata('msgreset');
        $this->table->set_heading(array('Name','Email','Phone',"Reset Password"));
        foreach($result->result_array() as $v) {
            $resetbtn = form_open("admin/users/resetPassword/{$v['uid']}").form_submit("reset","Reset").form_close();
            $this->table->add_row(array(
                anchor('admin/users/user/'.$v['uid'],
                "{$v['first_name']} {$v['last_name']}"),
                $v['email'],$v['phone'],
                $resetbtn));
        }
        $this->data['users'] = $this->table->generate();
        $this->data['main_content'] .= $this->load->view('admin/list_users',$this->data,true);
        $this->data['main_content'] .= $this->load->view('admin/create_user',null,true);
        $this->load->view('default',$this->data);
	}
     
    public function new_user(){
        if($this->form_validation->run()) {
            $fields = array('first name','last name','phone','email');
            $query = $this->db->query('SELECT UUID()');
            $uid = $query->row_array();
            $uid = $uid['UUID()'];
            $pass = uniqid();
            $email = $this->input->post('email');
            $this->db->insert('users',array(
                'uid'=>$uid,
                'first_name'=>$this->input->post('first_name'),
                'last_name'=>$this->input->post('last_name'),
                'phone'=>$this->input->post('phone'),
                'contact'=>$this->input->post('contact' != null),
                'email'=>$email,
                'pass'=>crypt($pass,$this->data['pass_salt']))
            );
            $this->data['msg'] = "User created";
            // Send an email
            
            $this->email->from($this->data['email']);
            $this->email->message("You now have an acccount on the Trott Park Fencing Club website. To access it go to this page:".anchor('login')."\n Your login details are:\nEmail: {$email}\nPassword: {$pass}\n Thankyou");
            $this->email->subject('TPFC Website Account');
            $this->email->to($this->input->post('email'));
            $this->email->send();
            $this->user($uid);
        } else {
            // Show error 
            $this->data['msg'] = validation_errors(); 
            $this->index();
        }
        
    }
    
    function user($uid = false) {
        // Display information about a single user
        if(!$uid) {
            redirect('admin/users');
        } else {
            // Show the information on the user and forms to update this data
            $this->data['uid'] = $uid;
            $result = $this->db->get_where('users',array('uid'=>$uid));
            if($result->num_rows() == 0) {
                $this->data['main_content'] .=  $this->load->view('admin/no_user_error',$this->data,true);
            } else {
                // Load the form to edit this user
                $this->data['user'] = $result->row_array();
                $this->data['main_content'] .= $this->load->view('admin/view_user',$this->data,true);
            }
        }
        $this->load->view('default',$this->data);
    }
    
    function update_user($uid) {
        // Update information about a user
         if($this->form_validation->run()) {
            $user = array(
                    "phone"=>$this->input->post('phone'),
                    "last_name"=>$this->input->post('last_name'),
                    "first_name"=>$this->input->post('first_name'),
                    "email"=>$this->input->post('email'),
                    "contact"=>$this->input->post('phone')
                    );
            $this->db->update('users',$user,array('uid'=>$uid));
            $this->data['msg'] = "Updated user information";
        } else {
            $this->data['msg'] = "An error occurred, nothing was updated";
            
        }
        $this->user($uid);
    }
    /**
      * Delete a specific user
      */
    function delete($uid) {
        // Delete the specified image
        // Check it exists
        $result = $this->db->get_where('users',array('uid'=>$uid));
        if($result->num_rows() == 0) {
            $this->data['msg'] = "User does not exist";
        } elseif($this->db->count_all('users') == 1) {
            $this->data['msg'] ="There must always be at least 1 user";
        } else {
            $usr = $result->row_array();
            $this->db->delete('users',array('uid'=>$uid));
            $this->data['msg'] = "Deleted: {$usr['first_name']} {$usr['last_name']}";
        }
        $this->index();
    }
    /**
      * Resets the the password of the given user
      * emails them a new generated password
      */
    function resetPassword($uid) {
        $result = $this->db->get_where('users',array('uid'=>$uid));
        if($result->num_rows() == 0) {
            $this->session->set_flashdata("msgreset","User does not exist");
        } else {
            $newpass = uniqid();
            $row = $result->row_array();
            $email =  $row['email'];
            $name = $row['first_name']. ' '. $row['last_name'];
            $this->db->where("uid",$uid)->update("users",array('pass'=>crypt($newpass,$this->data['pass_salt'])));
            
            $this->email->from($this->data['email']);
            $this->email->message("Your password on the TPFC websight has been reset. Remember to keep your password secure. To access it go to this page:".anchor('login')."\n Your login details are:\nEmail: {$email}\nPassword: {$newpass}\n Thankyou");
            $this->email->subject('TPFC Website Account: Password Reset');
            $this->email->to($email);
            $this->email->send();
            
            $this->session->set_flashdata("msgreset","Password reset for {$name}");
        }
        redirect('admin/users/');
        
    }
    
}