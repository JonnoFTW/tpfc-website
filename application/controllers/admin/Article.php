<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Admin {

    function __construct(){
		parent::__construct();	
        $this->data['msg'] = '';
        $this->data['parents'] = $this->_get_parents();
    }
    private function _get_parents($title = false) {
        if($title)
            $this->db->where('title !=',$title);
        $result = $this->db->select('aid, title')->where('parent',null)->get('articles');
        $parents = array(-1=>'');
        foreach($result->result_array() as $k=>$v) {
            $parents[$v['aid']] = $v['title'];
        }
        return $parents;
    }
    function index(){ 
        // List articles to edit
		$this->data['main_content'] .= $this->load->view('admin/admin_article_list',$this->data,true);
		$this->load->view('default',$this->data);
	}
    public function edit($title=false){
        if($this->input->post('article') && $title){
            $res= $this->db->get_where('articles',array('title'=>$title));
            $parent = $this->input->post('parent');
            if($this->article_parent($parent) != null) {
                $this->data['msg'] = "Child articles cannot have children: " .$parent;
                $this->index();
                return;
            }
            $article = $res->row_array();
            if(!$article['permanent']) {
                $newTitle = $this->input->post('title');
            } else {
                $newTitle = $title;
            }
            if(!$newTitle){
               $this->data['msg'] = "Please provide a title for the page. Article was not updated";
            } else {
                $this->db->trans_start();
                $this->db->where('title',$title)->update('articles',array(
                            'parent'=>$parent,
                            'title'=>$newTitle,
                            'updated'=>date('Y-m-d'),
                            'updated_by'=>$this->session->userdata('uid'),
                            'article'=>$this->input->post('article'))
                );
                $this->db->trans_complete();
                $this->data['msg'] = "Article successfully updated";
                $title = $this->input->post('title');
                redirect('admin/article/edit/'.$newTitle);
            }
        }
        //Edit a page
        if($title){
            $result = $this->db->get_where('articles',array('title'=>$title));
            $this->data['article'] = $result->row_array();
            if($this->input->post('delete')) {
                $this->remove_page($this->data['article']['aid']);
                return;
            } else {
                $this->data['parents'] = $this->_get_parents($title);
                $this->data['main_content'] .= $this->load->view('admin/admin_article',$this->data,true);
            }
        }else{
            redirect('admin/article');
        }
		$this->load->view('default',$this->data);
    }
    public function remove_page($aid) {
        if($aid) {
            $result = $this->db->get_where('articles',array("aid"=>$aid));
            $page = $result->row_array(); 
            if($page['permanent']) {
                $this->data['msg'] = "This page is permanent and cannot be removed";
                $this->edit($page['title']);
            } else {
                $this->db->delete('articles',array("aid"=>$aid));
                $this->data['msg'] ="Page successfully removed";
                $this->index();
            }
        } else {
           echo "Please specify an article to remove"; 
        }
    }
    public function new_page(){
        $this->load->library('form_validation');
        $title = $this->input->post('title');
        $this->form_validation->set_rules('title', 'Title', 'required|min_length[1]|is_unique[articles.title]');
        if(!$title){
            $this->data['msg'] = "Please provide a title for the new page";
            $this->index();
            return;
        }
        $parent = $this->input->post('parent');
        if(intval($parent) == -1) {
            $parent = null;
        } else if($this->article_parent($parent) != null) {
            $this->data['msg'] = "Child articles cannot have children ".$parent." parent: ".$this->article_parent($parent);
            $this->index();
            return;
        }
        $default = "<p>This page has not been written yet</p>";
        $this->db->insert('articles',
            array('title'=>str_replace(' ','_',trim($title)),
                  'article'=>$default,
                  'updated'=>date('Y-m-d'),
                  'parent'=>$parent)
              );
        redirect('admin/article/edit/'.str_replace(' ','_',$title));
    }
    private function article_parent($aid) {
        $res = $this->db->get_where('articles',array('aid'=>$aid));
        if($res->num_rows() == 0)
            return null;
        $row = $res->row_array();
        return $row['parent'];
    }

}
