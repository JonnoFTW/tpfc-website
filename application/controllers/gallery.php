<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
        $this->load->helper('text');
        $this->data['title'] = anchor('/gallery','Gallery');
        
	}
	public function index(){
        // List the galleries available
		$result = $this->db->get('galleries');
		$this->data['galleries'] = $result->result_array();
		$this->data['main_content'] = $this->load->view('gallery/gallery_list',$this->data,true);
		$this->load->view('default',$this->data);
	}
    public function view($gid,$iid = false){
        $this->db->from('galleries'); 
        $this->db->where(array('galleries.gid'=>$gid));
        $this->db->join('images','images.gid = galleries.gid')->order_by('images.iid','asc');
  
        $result = $this->db->get();
        if($result->num_rows == 0) {
            $this->data['main_content'] = $this->load->view('gallery/error',$this->data,true);
        } else {
            $this->data['images'] = $result->result_array();
            $res = $this->db->get_where('galleries',array('gid'=>$gid));
            $row = $res->row_array();
            $this->data['title'] .= " - ".anchor('/gallery/view/'.$row['gid'],$row['title']);
            $this->data['gdescription'] =  $row['description'];
            if($iid !== false){
                //Show the ith image in the gallery
                $result = $this->db->get_where('images',array('iid'=>$iid));
                if($result->num_rows() == 0) {
                    $this->data['main_content'] = 'No such image exists in this gallery!';
                } else {
                    $this->data['img'] = $result->row_array();
                    $this->data['main_content'] = $this->load->view('gallery/gallery_view',$this->data,true);
                }
            }
            else{
                //Show the entire gallery
                $this->load->library('table');
                $table = array();
                foreach($this->data['images'] as $i) {
                    $img = img('assets/images/thumbs/'.$i['link']).'<br/>'.character_limiter($i['description'],40);
                    $table[] = anchor('gallery/view/'.$i['gid'].'/'.$i['iid'],$img);
                }   
                $table = $this->table->make_columns($table,4);
                $this->data['image_table'] = $this->table->generate($table);
                $this->data['main_content'] = $this->load->view('gallery/gallery_preview',$this->data,true);
            }
        }
		$this->load->view('default',$this->data);
    }

}
