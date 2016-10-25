<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
Handles CRUD functions for members (not users)
**/
class Members extends MY_Admin {

    function __construct(){
		parent::__construct();
        $this->load->library(['table','form_validation']);
        $this->load->library('email');
        
        $this->form_validation->set_rules('name', 'Name', 'htmlspecialchars|required|regex_match[/^[a-zA-Z]+,\s+[a-zA-Z]$/]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('address', 'Address', 'htmlspecialchars');
		$this->form_validation->set_rules('handedness','Handedness', 'in_list[R,L]');
		$this->form_validation->set_rules('telephone','Telephone', 'regex_match[/^[\d ]+$/]');
		$this->form_validation->set_rules('mobile','Mobile', 'regex_match[/^[\d ]+$/]');

        $this->data['msg'] = '';
        $this->form_validation->set_rules('date','dob',function($dob) {
            if(date_create_format("Y-m-d",$dob)) {
                return True;
            } else {
                return False;
            }
        }); 
        $this->data['summary'] = [
            'left'=>0,
            'right'=>0,
            'junior'=>0,
            'senior'=>0
        ];
    }

    /**
    Generates a new html row
    **/
    private function user_row($m, $year_date) {
        $out = "<tr id='member-{$m['id']}' data-id='{$m['id']}'>";
        $out .= "<td class='edit-user'><button type=\"button\" class=\"btn btn-default btn-xs\"><i class='fa fa-edit'></button></td>";
        $out .= "<td>{$m['name']}</td>";
        $out .= "<td><a href='mailto:{$m['email']}'>{$m['email']}</a></td>";
        $out .= "<td>{$m['address']}</td>";
        $out .= "<td><a href='tel:+61-8-{$m['telephone']}'>{$m['telephone']}</a></td>";
        $out .= "<td><a href='tel:+{$m['mobile']}'>{$m['mobile']}</a></td>";
        $out .= "<td>{$m['handedness']}</td>";
        
        $cake = '';
        if(!$m['dob']) {
            $dob = '';
            $age = '';
        } else {
            //echo $m['dob'];
            $dt = DateTime::createFromFormat('Y-m-d',$m['dob']);
            $age = $year_date->diff($dt)->y;
            // is it their birthday this week?
            $now = new DateTime();
            $nowBd = DateTime::createFromFormat('Y-m-d',$now->format('Y-').$dt->format('m-d'));
            $diff_tobd = abs($nowBd->diff($now)->days);
            if($diff_tobd <= 7)
                $cake = '<i class="fa fa-birthday-cake" aria-hidden="true"></i>';
            $dob = $dt->format('d/m/Y');
            if($age >= 18) {
                $this->data['summary']['senior'] += 1;
            } elseif ($age > 0) {
                $this->data['summary']['junior'] += 1;
            }
        }    
        $out .= "<td>$dob</td><td>$age $cake</td>";
        if($m['handedness'])
            $this->data['summary'][$m['handedness']=='L'?'left':'right'] += 1;
        
        $out .= "</tr>";
        return $out;
    }
    // actual stuff we can see
    function index(){
        // List users
        $year = $this->input->get('year');
        if (!$year) {
            $year = date('Y');
        }
        $this->data['year_date'] = new DateTime("$year-01-01");
        $this->data['years'] = ['2016']; // should probably get these as uniques from registrations table
        $result = $this->db->get('members');
        $this->data['msgreset'] = $this->session->flashdata('msgreset');
        $members = $result->result_array();
        $this->data['member_table'] = '';
        foreach($members as $m) {
            $this->data['member_table'] .= $this->user_row($m, $this->data['year_date']);
        }
        
        $this->data['main_content'] .= $this->load->view('admin/list_members',$this->data,true);
        $this->load->view('default',$this->data);
	}
    public function registrations() {
        $this->data['members'] = $this->db->join('registrations', 'registrations.member_id = members.id', 'left outer')->order_by('registrations.year', 'DESC')->get('members')->result_array();
        $this->data['main_content'] .= $this->load->view('admin/list_registrations',$this->data,true);
        $this->load->view('default',$this->data);
    }
/*    public function attendance() {
   
    }*/
    // api functions
    public function update($mid) {
        if($this->form_validation->run()) {
            $out = 1;
            $this->db->where('id', $mid);
            $this->db->update('members', $this->input->post());
            $user = $this->db->get_where('members',['id'=>$mid])->row_array();
            $html = $this->user_row($user, new DateTime());
        } else {
            $html = validation_errors(' ','<br>');
            $out = 0;
        }
        
        return $this->output->set_content_type('application/json')
                                ->set_output(json_encode(['status'=>$out, 'html'=>$html]));
    }
    public function delete() {
        $id = $this->input->post('id');
        $this->db->delete('members', ['id'=>$id]);
        return $this->output->set_content_type('application/json')
                            ->set_output(json_encode(['status'=>$this->db->affected_rows()]));
    }
    public function create(){
        $html = '';
        $status = 0;
        if($this->form_validation->run()) {
            $vars = $this->input->post();
            unset($vars['id']);
            if(!$vars['dob']) {
                unset($vars['dob']);
            }
            $this->db->insert('members',$vars);
           
            if($this->db->affected_rows()) {
                $user = $this->db->get_where('members',['id'=>$this->db->insert_id()])->row_array();
                $html = $this->user_row($user, new DateTime());
                $status = 1;
                }
            else
                $html = "Could not create Member";
        }
        else {
            $html = validation_errors(' ','<br>');
        }
        return $this->output->set_content_type('application/json')
                                ->set_output(json_encode(['csrf_token'=>$this->security->get_csrf_hash(),'status'=>$status, 'html'=>$html]));
    }

    public function set_attended($member_id, $date) {
        // date should be a string matching YYYY-MM-DD
        $d = DateTime::createFromFormat('Y-m-d', $date);
        $good = $d && $d->format('Y-m-d') === $date;
        if(!$good) {
            $msg = 'Invalid date';
        } else {
            $this->db->insert('attendance',['member_id'=>$member_id, 'date'=>$date]);
            $msg = $this->db->affected_rows()>0?'User attended':'Member already attended this date';
        }
        return $this->output->set_content_type('application/json')
                                ->set_output(json_encode(['status'=>$msg]));
    }
    public function update_registration() {
        // post variable is mid = ['2014-club','2015-state']
   //     echo var_dump($this->input->post());
        // dele
        $errors = [];
        foreach($this->input->post() as $uid => $years) {
            // Delete every registration about this user
            $this->db->delete('registrations', ['member_id'=>$uid]);
            // Set everything up
            
            foreach($years as $y) {
                $parts = explode('-', $y);
                $year = $parts[0];
                //validate year
                
                $level = $parts[1];
                // validate level
                if(!checkdate(1,1,$year)) {
                    $errors[$uid][] = "Invalid year";
                }
                if(!in_array($level, ['club','state'])) {
                    $errors[$uid][] = "Invalid level";
                    continue;
                }
                $this->db->insert('registrations', ['member_id'=>$uid, 'level'=> $level, 'year'=>$year]);
            }
        }
        return $this->output->set_content_type('application/json')
                                ->set_output(json_encode(['status'=>$errors]));
    }
    
    
}
