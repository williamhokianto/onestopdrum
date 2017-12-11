<?php
class Store_basket extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _avoid_cart_conflicts($data)
{
    /*
    NOTE : this make sure no items on store_shoppertrack
    ... with the same session_id and shopper_id
    */

    $this->load->module('store_shoppertrack');
    $original_session_id = $data['session_id'];
    $shopper_id = $data['shopper_id'];

    $col1 = 'session_id';
    $value1 = $original_session_id;
    $col2 = 'shopper_id';
    $value2 = $shopper_id;
    $query = $this->store_shoppertrack->get_with_double_condition($col1, $value1, $col2, $value2);
    $num_rows = $query->num_rows();
    
    if ($num_rows>0) { //IF items conflicting with store_shoppertrack!
        //regenerate the session_id
        session_regenerate_id();

        //update the $data['session_id'] variable
        $new_session_id = $this->session->session_id;
        $data['session_id'] = $new_session_id;
    }

    return $data;
}

function get_with_double_condition($col1, $value1, $col2, $value2) 
{
    $this->load->model('mdl_store_basket');
    $query = $this->mdl_store_basket->get_with_double_condition($col1, $value1, $col2, $value2);
    return $query;
}

function remove()
{
    $update_id = $this->uri->segment(3);
    $allowed = $this->_make_sure_remove_allowed($update_id);
    if ($allowed==FALSE) {
        redirect('cart');
    }

    $update_id = $this->uri->segment(3);
    $this->_delete($update_id);
    redirect('cart');
}

function _make_sure_remove_allowed($update_id)
{
    $query = $this->get_where($update_id);
    foreach($query->result() as $row) {
        $session_id = $row->session_id;
        $shopper_id = $row->shopper_id;
    }

    if (!isset($shopper_id)) {
        return FALSE;
    }

    $customer_session_id = $this->session->session_id;
    $this->load->module('site_security');
    $customer_shopper_id = $this->site_security->_get_user_id();

    if (($session_id==$customer_session_id) OR ($shopper_id==$customer_shopper_id)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function add_to_basket()
{
    $submit = $this->input->post('submit', TRUE);
    if ($submit=="Submit") {
        //process the form
        $this->load->library('form_validation');


        $this->form_validation->set_rules('item_colour', 'Item Colour', 'numeric');
        $this->form_validation->set_rules('item_size', 'Item Size', 'numeric');
        $this->form_validation->set_rules('item_qty', 'Item Quantity', 'required|numeric');
        $this->form_validation->set_rules('item_id', 'Item ID', 'required|numeric');

        if ($this->form_validation->run() == TRUE) {
            //cool
            $data = $this->_fetch_the_data();
            $data = $this->_avoid_cart_conflicts($data);
            $this->_insert($data);
            redirect('cart');
        } else {
            //uncool
            $refer_url = $_SERVER['HTTP_REFERER'];
            $error_msg = validation_errors("<p style='color: red;'>", "</p>");
            $this->session->set_flashdata('item', $error_msg);
            redirect($refer_url);
        }
    }
}

function _fetch_the_data()
{
    //gathers together all of the data, so that we can do a table insert
    $this->load->module('site_security');
    $this->load->module('store_items');

    $item_id = $this->input->post('item_id', TRUE);
    $item_data = $this->store_items->fetch_data_from_db($item_id);
    $item_price = $item_data['item_price'];
    $item_qty = $this->input->post('item_qty', TRUE);
    $item_size = $this->input->post('item_size', TRUE);
    $item_colour = $this->input->post('item_colour', TRUE);
    $shopper_id = $this->site_security->_get_user_id();

    if (!is_numeric($shopper_id)) {
        $shopper_id = 0;
    }

    $data['session_id'] = $this->session->session_id;
    $data['item_title'] = $item_data['item_title'];
    $data['price'] = $item_price;
    $data['tax'] = '0';
    $data['item_id'] = $item_id;
    $data['item_size'] = $this->_get_value('size', $item_size);
    $data['item_qty'] = $item_qty;
    $data['item_colour'] = $this->_get_value('colour', $item_colour);
    $data['date_added'] = time();
    $data['shopper_id'] = $shopper_id;
    $data['ip_address'] = $this->input->ip_address();
    return $data;
}

function _get_value($value_type, $update_id)
{
    //NOTE: value_type can be 'colour' or 'size'
    if ($value_type=='size') {
        $this->load->module('store_item_sizes');
        $query = $this->store_item_sizes->get_where($update_id);
        foreach($query->result() as $row) {
            $item_size = $row->size;
        }
        if (!isset($item_size)) {
            $item_size = 'Original Size';
        }
        $value = $item_size;
    } else {
        //fetch the name of the colour
        $this->load->module('store_item_colours');
        $query = $this->store_item_colours->get_where($update_id);
        foreach($query->result() as $row) {
            $item_colour = $row->colour;
        }
        if (!isset($item_colour)) {
            $item_colour = 'Original Colour';
        }
        $value = $item_colour;        
    }
    return $value;
}

function test()
{
    $session_id = $this->session->session_id;
    echo $session_id;
    echo "<hr>";
    $this->load->module('site_security');
    $shopper_id = $this->site_security->_get_user_id();
    echo "You are shopper ID ".$shopper_id;
    echo "<hr>";
    session_regenerate_id();
    echo "<h1>NEW SESSION ID HAS BEEN GENERATED</h1>";

    $session_id = $this->session->session_id;
    echo $session_id;
    echo "<hr>";
    $this->load->module('site_security');
    $shopper_id = $this->site_security->_get_user_id();
    echo "You are shopper ID ".$shopper_id;
    echo "<hr>";
}

function get($order_by)
{
    $this->load->model('mdl_store_basket');
    $query = $this->mdl_store_basket->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_basket');
    $query = $this->mdl_store_basket->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_basket');
    $query = $this->mdl_store_basket->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_basket');
    $query = $this->mdl_store_basket->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_basket');
    $this->mdl_store_basket->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_basket');
    $this->mdl_store_basket->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_basket');
    $this->mdl_store_basket->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_basket');
    $count = $this->mdl_store_basket->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_basket');
    $max_id = $this->mdl_store_basket->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_basket');
    $query = $this->mdl_store_basket->_custom_query($mysql_query);
    return $query;
}

}