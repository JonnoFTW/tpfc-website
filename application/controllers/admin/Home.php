<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Admin {

    function __construct(){
		parent::__construct();	
    }
    function index(){
		$this->data['main_content'] .= $this->load->view('admin/admin',$this->data,true);
		$this->load->view('default',$this->data);
	}
    function update_info(){
    
        $this->load->library('form_validation');
		$this->form_validation->set_rules('lat', 'Latitude',  'required|less_than[90]|greater_than[-90]');
		$this->form_validation->set_rules('lng', 'Longitude', 'required|less_than[180]|greater_than[-180]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if($this->form_validation->run()) {
                $this->db->truncate('info');
                $this->db->insert('info',array(
                    "club_email"=>    $this->input->post('email'),
                    "club_locationLAT"=>$this->input->post('lat'),
                    "club_locationLNG"=>$this->input->post('lng')
                ));
                $this->data['msg'] = 'Information updated successfully';
                $this->data['email'] = $this->input->post('email');
            } else {
                $this->data['msg'] = validation_errors();
            }
        $this->index();
    }

}
