<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Store extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->data['title'] = 'Store';
        
        if(!$this->session->userdata('logged')){
            $this->coming_soon();
            return;
        }
        $this->load->model('order', '', TRUE);
        $result = $this->db->get('store_categories');
        $this->data['categories'] = $result->result_array();
        $this->data['main_content'] = $this->load->view('store/default',$this->data,true);
    
	}
	
    public function coming_soon() {
        $this->data['main_content'] = $this->load->view('store/coming_soon', $this->data,true);
        $this->load->view('default', $this->data);
    }
	public function index()	{
        

		$this->data['main_content'] .= $this->load->view('store/categories',$this->data,true);
		$this->load->view('default',$this->data);
	}
    public function cat($cid) {
        // Show all items in a category, no pagination lol
        $result = $this->db->get_where('store_categories', ['category_id'=>$cid]);
        $this->data['category'] = $result->row_array();
        if($this->data['category']) {
            $result = $this->db->get_where('store_items', ['category_id'=>$cid]);
            $this->data['items'] = $result->result_array();
            $this->data['main_content'] .= $this->load->view('store/category_show', $this->data, true);
        } else {
            $this->data['main_content'] .= "Invalid category";
        }
        $this->load->view('default', $this->data);
        
    }
  
    public function item($iid) {
        $result = $this->db->join('store_categories', 'store_categories.category_id = store_items.category_id')->get_where('store_items', ['id'=>$iid])->row_array();
        if($result) {
            $this->data['item'] = $result;
            $res  = $this->db->select('store_item_attributes.attribute as attribute,store_item_attribute_values.value as value, store_item_attribute_values.id as id')
                                                 ->from('tpfc.store_item_has_attributes')
                                                 ->join('store_item_attribute_values', 'store_item_attribute_values.attribute_id = store_item_has_attributes.attribute_id', 'inner')
                                                 ->join('store_item_attributes', 'store_item_has_attributes.attribute_id = store_item_attributes.id', 'inner')
                                                 ->where('store_item_has_attributes.item_id',$iid)->get()->result_array();
            $this->data['attributes'] = $this->_group_by($res, "attribute", "value", "id");                     
            $this->data['main_content'] .= $this->load->view('store/item_show', $this->data, true);
        }  else {
            
        }
        $this->load->view('default', $this->data);
        
    }
}
?>
