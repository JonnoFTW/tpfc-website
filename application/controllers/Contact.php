<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('Recaptcha');
        $this->data['mailed']=false;
        $this->data['send_fail']=false;
		$this->data['title'] = 'Contact';
        $this->data['msg'] = "Please provide your details and we'll get back to your shortly";
	}
	public function index(){
        $this->db->select('users.first_name, users.last_name, users.phone, users.contact')->where('contact !=',0);
        $this->db->from('users');
        $query = $this->db->get();
        $this->data['mails'] = $query->result_array();
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('message', 'message', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        if($this->form_validation->run()) {

            $config = [
                'protocol'=> 'smtp',
            ];
            $this->email->from($this->input->post('email'),$this->input->post('name'));
            $this->email->message($this->input->post('message'));
            $this->email->subject('TPFC Enquiry');
            $this->email->to($this->data['email']);
            $this->email->cc('trottparkfc@hotmail.com, president@trottparkfencingclub.org.au');
            $response = $this->recaptcha->verifyResponse($this->input->post('g-recaptcha-response'));
            if (!(isset($response['success']) and $response['success'] === true)) {
                $msg = "Invalid recaptcha";
            } else {
                $success = $this->email->send();
                $msg = '';
                if($success) {
                    $msg = 'Email was sent successfully';
                } else {
                    $msg = 'Email was not sent. Please use the link above';
                }
                if($this->session->userdata('logged')){
                    $msg .= "<pre>".$this->email->print_debugger() ."</pre>";
                } elseif(!$success) {
                    header('Location: mailto:trottparkfc@hotmail.com?subject=TPFC%20Enquiry&body='.urlencode($this->input->post('message')));
                    exit;
                }
                $this->data['msg'] = $msg;
                $name = $this->input->post('name');
                $this->data['mailed'] = true;
            }
        } else if($this->input->post()) {
            $this->data['msg'] = validation_errors() ;
        } 
		$this->data['main_content'] = $this->load->view('contact',$this->data,true);
		$this->load->view('default',$this->data);
	}
  
}
