<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Training extends MY_Controller {

	function __construct(){ 
		parent::__construct();
        $this->data['title'] = '';
        
	}
	public function index(){
        $this->show('training');
	}
    public function show(){
        $result = $this->db->select("title,article,parent, users.first_name, users.last_name,  DATE_FORMAT(articles.updated,'%D %M, %Y') as updated",false)->join('users','users.uid = articles.updated_by','left')->get_where('articles',array('title'=>'training'));
        $this->data['article'] = $result->row_array();
        $this->data['main_content'] = $this->load->view('home',$this->data,true);
        $title = $this->data['article']['title'];
        $this->data['title'] = $this->data['article']['title'];
		$this->load->view('default',$this->data);
	}
}
