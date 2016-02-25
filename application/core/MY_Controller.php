<?php
class  MY_Controller  extends  CI_Controller  {

    function __construct(){ 
        parent::__construct();    
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('session');
        //$this->load->library('uri');
        $this->data['menu'] = $this->_generate_menu(); 
        $res = $this->db->get('info');
        $row = $res->row_array();
        $this->data['LOCATION_X'] = $row['club_locationLNG'];
        $this->data['LOCATION_Y'] = $row['club_locationLAT'];
        $this->data['email'] = $row['club_email'];
        $this->db->select('users.email, users.phone')->where('email =','jenny.cassidy@hotmail.com');
        $this->db->from('users');
        $query = $this->db->get();
        $this->data['phone'] = $query->result_array()[0]['phone'];

        $this->data['pass_salt'] = '$2a$07$FdAQgn8nY8NdOqs9OIGIGA$';
        $this->data['msg'] = '';
        $this->data['scripts'] = $this->load->view('google_analytics',null,true);
        if($this->session->userdata('logged')){
            $this->output->enable_profiler(TRUE);
            $this->data['scripts'] .= $this->load->view('admin/benchmark_view',$this->data,true);
        }
    }
    protected function _titleAnchor($title,$link = '', $dropdown=false) {
        $attrs = [];
        if($dropdown)
            $attrs =  ['class'=>"dropdown-toggle",
                       'data-toggle'=>"dropdown",
                       'role'=>"button",
                       'aria-haspopup'=>"true",
                       'aria-expanded'=>"false"];
        return anchor($title=='Home'?'/':$link.strtolower($title),
                      ucwords(str_replace('_',' ',htmlentities($title))).($dropdown?' <span class="caret"></span>':''),
                      $attrs);
    }
    
    protected function _get_articles($link='',$changes=false, $list_group=false, $no_home=false, $only_editable=true) {
        $out = '';
        if($no_home) {
                $this->db->where("articles.title != 'Home'");
        }
        if($only_editable) {
            $this->db->where('articles.editable = 1');
        }
        $result = $this->db->order_by('position','desc')->join('users','users.uid = articles.updated_by','left')->get('articles'); //get_where('articles',array('parent'=>null)); 
        $pages = $result->result_array();
        
        //Links to pages
        foreach($pages as $i) {
            if(!$i['parent']) {
                
                $subs = array();
                foreach($pages as $v) {
                    if($v['parent'] == $i['aid']) {
                        $suba = $this->_titleAnchor($v['title'],$link);
                        if($changes)
                            $suba .= " (last editted {$v['updated']} by {$v['first_name']}  {$v['last_name']})";
                        $subs[] = $suba;
                    }
                }
                if($subs && !$list_group) {
                    $out .=  "<li class='dropdown'>".$this->_titleAnchor($i['title'],$link, true);
                } else {
                    $segment = $this->uri->segment(1);
                    $class = '';
                    if ($segment===strtolower($i['title'])||(!$segment && $i['title']=='Home'))
                        $class .= 'active ';
                    if ($list_group)
                        $class .= 'list-group-item';
                    $out .= "<li class='$class'>";
                    $out .= $this->_titleAnchor($i['title'],$link);
                }
                if($changes)
                    $out .= " (last editted {$i['updated']} by {$i['first_name']}  {$i['last_name']})";
                if($subs) {
                    array_unshift($subs,$this->_titleAnchor($i['title'],$link),'');
                    $out .= ul($subs, ['class'=>'dropdown-menu']);
                }
                $out .= "</li>";
            }
        }
        return $out;
    }
    /**
      * What the hell do you think it might do?
      *
      */
    private function _generate_menu(){
        $out = "<ul class=\"nav navbar-nav\">";
        $out .= $this->_get_articles('',false,false,true, false);
       
        $out .= '</ul><ul class="nav navbar-nav navbar-right">';
        if($this->session->userdata('name')){

            $out .= "<li>".anchor('admin','Admin')."</li>\n";
            $out .= "<li>".anchor('login/logout','Logout')."</li>\n";

        }
        else{
            //Add login box possibly
            $out .= "<li >".anchor('login','Login')."</li>";
        }
       
        $out .= "</ul>";
        return $out;
    }

} 
/**
  * Setup the admin interface.
  */
class MY_Admin extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('user_agent');
        //    var_dump($this->session->all_userdata());
        $this->data['title'] = 'Administration';
        if(!$this->session->userdata('logged')){
            if($this->input->is_ajax_request()) {
                echo "Request failed, you will need to login<br>";
                return;
            }
            else
                redirect('login');
        }
        else{
            $articles[] = anchor('admin/forms#list','Forms and Resources'); 
            $this->data['articles'] = $articles;
            $rows = $this->db->get_where('articles', 'editable = 1')->result_array();
            $row_labels = [];
            foreach($rows as $v) {
                $row_labels[] = $this->_titleAnchor($v['title']);
            }
            $articles = ul($row_labels);
            $this->data['article_list'] = $articles;//'<ul>'.$this->_get_articles('admin/article/edit/', false,false).'</ul>';
            $this->data['article_list_edits'] = '<ul>'.$this->_get_articles('admin/article/edit/',true, true).'</ul>';
            $result = $this->db->get('galleries');
            $this->data['galleries'] = $result->result_array();
            $this->data['main_content'] = $this->load->view('admin/admin_side',$this->data,true);
        }
    }
    
    private function _get_article_list($pages) {
        $articles = array();
        foreach($pages as $i) {
            if($i['permanent']) {
                $a = anchor('admin/article/edit/'.$i['title'],$i['title']);
            } else {
                //$title = ucwords(str_replace('_',' ',htmlentities($i['title'])));
                //$a = anchor(strtolower('admin/article/edit/'.$i['title']),$title);
                $a = $this->_titleAnchor($i['title'],'admin/article/edit/');
            }
            $subs = $this->_get_subarticles($i['aid'],'admin/article/edit/');
            if($subs) {
                $articles[$a] = $subs;
            } else {
                $articles[] = $a;
            }
        }
        $articles[] = anchor('admin/forms/#list',"Forms and Resources");

        return $articles;
    }
}
?>
