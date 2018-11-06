<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends MY_Admin {

    function __construct(){
		parent::__construct();
        $this->load->library(array('table','form_validation'));
        $this->load->library('email');
        $this->load->model('order', '', TRUE);
        $this->data['msg'] = '';
    }
    
    function index(){
        $this->data['main_content'] .= $this->load->view('admin/store/main',null,true);
        $this->load->view('default',$this->data);
	}
     
    public function edit_category($cid){
        // show the category name and description and picture
        $this->data['category'] = $this->db->get_where('store_categories', ['category_id'=>$cid])->row_array();
        $this->data['main_content'] .= $this->load->view('admin/store/edit_category', $this->data, true);
        $this->load->view('default', $this->data);
    }
    private function isPost() {
        return $this->input->method() == 'post';
    }
    public function edit_item($iid){
        if($this->isPost()) {
            // do a form upload or something
        } else {
            $cats = $this->db->get('store_categories')->result_array();
            $cats_arr = [];
            foreach($cats as $c) {
                $cats_arr[$c['category_id']] = $c['category_name'];
            }
            $this->data['all_attributes'] = $this->db->get('store_item_attributes')->result_array();
            $this->data['categories'] = $cats_arr;
            $this->data['item'] = $this->db->get_where('store_items', ['id'=>$iid])->row_array();
            $this->data['attributes'] = $this->db->
                                where(['item_id'=> $iid])->
                                join('store_item_attributes', 'store_item_attributes.id = store_item_has_attributes.attribute_id')->
                                get('store_item_has_attributes')->                                
                                result_array();
            $this->data['main_content'] .= $this->load->view('admin/store/edit_item', $this->data, true);
            $this->load->view('default',$this->data);
        }
        
    }
    public function set_item_category() {
        // Set the category of an item
    }
    public function add_item_category(){
        // Add an item to a category
    }
    public function set_item() {
        $iid = $this->input->post('iid');
    }
    public function categories() {
        $this->data['categories'] = $this->db->get('store_categories')->result_array();
        $this->data['main_content'] .= $this->load->view('admin/store/category_list',$this->data,true);
        $this->load->view('default',$this->data);
    }
    public function items() {
        $this->data['items'] = $this->db->join('store_categories', 'store_categories.category_id = store_items.category_id')->get('store_items')->result_array();
        $this->data['main_content'] .= $this->load->view('admin/store/item_list',$this->data,true);
        $this->load->view('default',$this->data);
    }
    public function order($oid) {
        $this->data['order'] = $this->order->get($oid);
        $this->data['main_content'] .= $this->load->view('admin/store/order_show',$this->data,true);
        $this->load->view('default',$this->data);
        
    }
    public function orders() {
        // List all the orders

        $this->data['orders'] = $this->order->get_simple_list();
        $this->data['main_content'] .= $this->load->view('admin/store/order_list',$this->data,true);
        $this->load->view('default',$this->data);
    }
    
    public function attributes() {
        $attrs = $this->db->            
                    join('store_item_attribute_values','store_item_attribute_values.attribute_id = store_item_attributes.id')->
                    get('store_item_attributes')->
                    result_array();
        $this->data['attributes'] = [];
        $this->data['attribute_names'] = [];
        foreach($attrs as $a) {
            $this->data['attribute_names'][$a['attribute_id']] = $a['attribute'];
            $this->data['attributes'][$a['attribute_id']][$a['id']] = $a['value'];
        }
        
        $this->data['main_content'] .= $this->load->view('admin/store/attribute_list',$this->data,true);
        $this->load->view('default',$this->data);
    }
    private function attr_to_lower($attr) {
        return strtolower(preg_replace([ '/[ _]+/','/[^A-Za-z\\-]/'],['-',''] , $attr));
    }
    public function update_attrs() {
        // foeach post field, 
        foreach($this->input->post() as $attr) {
            // if there's no attribute with this name,
            // create a new attribute
          //  $this->db->get_where('store_item_attributes', ['attribute'=>$this->attr_to_lower($attr)]);
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                    'data'=> $this->input->post(),
                    'success' => 'yep',
            ]));
    }
    
}
