<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller {

	function __construct(){ 
		parent::__construct();
        $this->data['title'] = '';
	}
	public function index(){
        $this->data['main_content'] = $this->load->view('home_content', $this->data, true);
        $this->data['home'] = True;
        $this->load->view('default', $this->data);
	}
	public function getFBgallery() {
            $this->load->library('facebook');
            $this->output->enable_profiler(FALSE);
            $photos = $this->facebook->get_uploaded_photos('trottparkfencingclub');
            //if($photos===null) {
            //    return;            
           // } else {
                $this->output
                     ->set_content_type('application/json')
                     ->set_output(json_encode($photos->asArray()));
       //  }
	   // phpinfo();
	}
    public function show($article = false){
        if(!$article) {
            $article = "home";
        }
        $this->data['article_title'] = $article;
        /*if(strcasecmp($article,"home")==0) {
            $result = $this->db->join('images','images.gid = galleries.gid')->order_by("images.iid","random")->limit(30)->get('galleries');
            $this->data['banner_images'] = $result->result_array();
        }*/
        $result = $this->db->select("title,article,parent, users.first_name, users.last_name,  DATE_FORMAT(articles.updated,'%D %M, %Y') as updated",false)->join('users','users.uid = articles.updated_by','left')->get_where('articles',array('title'=>$article));
        if($result->num_rows() == 0) {
            $this->data['title'] = 404;
            $this->data['main_content'] = "<div class='grid_12'><div class='box'><p>Page Not Found</p></div></div>";
            $this->output->set_status_header(404, 'text');
            log_message('error', '404 Page Not Found --> '.$article);
        } else {
            if($article === "Training") 
                redirect("training");
            $this->data['article'] = $result->row_array();
            $this->data['main_content'] = $this->load->view('home',$this->data,true);
	    if($article == "Home") 
	            $this->data['home_content'] = $this->load->view('home_content', $this->data, true);
            $this->data['p'] = '';
            $res = $this->db->get_where('articles',array('aid'=>$this->data['article']['parent']));
            if($res->num_rows() != 0) {
                $row = $res->row_array();
                $this->data['p'] = $this->_titleAnchor($row['title'])." - ";
            }
            $this->data['title'] = $this->data['article']['title'];
        }
        $this->load->view('default',$this->data);
	}
}
