<?
class Order extends CI_Model {
    public function get($oid) {
        $order = $this->db->get_where('store_orders', ['order_id'=>$oid])->row_array();
        $items =  $this->db
                        ->select('store_orders_item.price as price, name, store_orders_item.item_order_id as id, quantity')
                        ->join('store_items', 'store_items.id = store_orders_item.store_item_id')
                        ->get_where('store_orders_item', ['order_id'=>$order['order_id']])
                        ->result_array();
        foreach($items as $item) {
            // get all the attributes of each item
            $attrs = $this->db
                          ->select('value, attribute')
                          ->join('store_item_attribute_values', 'store_item_attribute_values.id = store_orders_item_attribute_values.item_attribute_value_id')
                          ->join('store_item_attributes', 'store_item_attributes.id = store_item_attribute_values.attribute_id')
                          ->get_where('store_orders_item_attribute_values', ['order_item_id'=>$item['id']])->result_array();
            foreach($attrs as $a) {
                $item['attrs'][] = $a;
            }
            $order['items'][] = $item;
        }
        return $order;
    }
    public function get_simple_list() {
        return $this->db->get('store_orders')->result_array();
    }
           /* $res = $this->db
                                        ->join('store_orders_item', 'store_orders_item.order_id = store_orders.order_id')
                                        ->join('store_orders_item_attribute_values', 'store_orders_item_attribute_values.order_item_id = store_orders.order_id')
                                        ->join('store_item_attribute_values', 'store_item_attribute_values.id = store_orders_item_attribute_values.item_attribute_value_id')
                                        ->join('store_item_attributes', 'store_item_attributes.id = store_item_attribute_values.attribute_id')
                                        ->get('store_orders')->result_array();*/

}
