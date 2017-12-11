<?php
class Store_items extends MX_Controller 
{

function __construct() {
parent::__construct();

$this->load->library('form_validation');
$this->form_validation->CI =& $this;
}

function _get_title($update_id)
{
    $data = $this->fetch_data_from_db($update_id);
    $item_title = $data['item_title'];
    return $item_title;
}

function _get_item_id_from_item_url($item_url)
{
    $query = $this->get_where_custom('item_url', $item_url);
    foreach($query->result() as $row) {
        $item_id = $row->id;
    }

    if (!isset($item_id)) {
        $item_id = 0;
    }

    return $item_id;
}

function view($update_id)
{
    if (!is_numeric($update_id)) {
        redirect('site_security/not_allowed');
    }

    $this->load->module('site_settings');

    //fetch the item details
    $data = $this->fetch_data_from_db($update_id); 
    $data['update_id'] = $update_id;

    $data['item_price_desc'] = number_format($data['item_price'], 2);
    $data['item_price_desc'] = str_replace('.00', '', $data['item_price_desc']);

    $query_gallery_pics = $this->_get_gallery_pics($update_id);
    $num_rows = $query_gallery_pics->num_rows();
    if ($num_rows>0) {
        //load page with angularjs
        $data['use_angularjs'] = TRUE; 

        //build an array of the gallery pictures
        $count = 0;
        foreach ($query_gallery_pics->result() as $row) {
            $gallery_pics[$count] = base_url().'item_galleries_pics/'.$row->picture;
            $count++;
        }

        $data['gallery_pics'] = $gallery_pics;
        $data['view_file'] = 'view_gallery_version';
    } else {
        //load page normally without angularjs
        $data['use_angularjs'] = FALSE; 
        $data['view_file'] = 'view';
    }

    //build the breadcrumbs data array
    $breadcrumbs_data['template'] = 'public_bootstrap';
    $breadcrumbs_data['current_page_title'] = $data['item_title'];
    $breadcrumbs_data['breadcrumbs_array'] = $this->_generate_breadcrumbs_array($update_id);
    $data['breadcrumbs_data'] = $breadcrumbs_data;
    $data['currency_symbol'] = $this->site_settings->_get_currency_symbol();
    $data['flash'] = $this->session->flashdata('item');
    $data['use_featherlight'] = TRUE;
    $data['view_module'] = "store_items";
    $this->load->module('templates');
    $this->templates->public_bootstrap($data);   
}

function _generate_breadcrumbs_array($update_id)
{
    $homepage_url = base_url();
    $breadcrumbs_array[$homepage_url] = 'Home';

    //figure out what the sub_cat_id is for this item
    $sub_cat_id = $this->_get_sub_cat_id($update_id);

    //get the sub cat title
    $this->load->module('store_categories');
    $sub_cat_title = $this->store_categories->_get_cat_title($sub_cat_id);

    //get the sub cat URL
    $sub_cat_url = $this->store_categories->_get_full_cat_url($sub_cat_id);

    $breadcrumbs_array[$sub_cat_url] = $sub_cat_title;
    return $breadcrumbs_array;
}

function _get_sub_cat_id($update_id)
{
    
    if (!isset($_SERVER['HTTP_REFERER'])) {
        $refer_url = '';
    } else {
        $refer_url = $_SERVER['HTTP_REFERER'];
    }

    //http://localhost/onestopdrum/music/instruments/Yamaha-Drums
    $this->load->module('site_settings');
    $this->load->module('store_cat_assign');
    $this->load->module('store_categories');

    $items_segments = $this->site_settings->_get_items_segments();
    $ditch_this = base_url().$items_segments;
    $cat_url = str_replace($ditch_this, '', $refer_url);
    $sub_cat_id = $this->store_categories->_get_cat_id_from_cat_url($cat_url);
    if ($sub_cat_id>0) {
        return $sub_cat_id;
    } else {
        $sub_cat_id = $this->_get_best_sub_cat_id($update_id);
    }
    return $sub_cat_id;
}

function _get_best_sub_cat_id($update_id)
{
    //Figure out which associated sub cat has the most items
    $query = $this->store_cat_assign->get_where_custom('item_id', $update_id); 
    foreach($query->result() as $row) {
        $potential_sub_cats[] = $row->cat_id;
    }

    //how many sub cats does this item appear in?
    $num_sub_cats_for_item = count($potential_sub_cats);

    if ($num_sub_cats_for_item==1) {
        //the item ONLY appears in one sub category, so use this
        $sub_cat_id = $potential_sub_cats['0'];
        return $sub_cat_id;
    } else {
        //we have more than one sub cat START

        foreach ($potential_sub_cats as $key => $value) {
            $sub_cat_id = $value;
            $num_items_in_sub_cat = $this->store_cat_assign->count_where('cat_id', $sub_cat_id);
            $num_items_count[$sub_cat_id] = $num_items_in_sub_cat;
        }

        //which array key is paired with the highest value?
        $sub_cat_id = $this->get_best_array_key($num_items_count);
        return $sub_cat_id;
        //we have more than one sub cat END
    }
}

function get_best_array_key($target_array)
{
    foreach ($target_array as $key => $value) {
        
        if (!isset($key_with_highest_value)) {
            $key_with_highest_value = $key;
        } elseif ($value > $target_array[$key_with_highest_value]) {
            $key_with_highest_value = $key;
        }
    }
    return $key_with_highest_value;
}     


function _process_delete($update_id)
{
    //attempt to delete item colours
    $this->load->module('store_item_colours');
    $this->store_item_colours->_delete_for_item($update_id);

    //attempt to delete item sizes
    $this->load->module('store_item_sizes');
    $this->store_item_sizes->_delete_for_item($update_id);

    $data = $this->fetch_data_from_db($update_id);
    $big_pic = $data['big_pic'];
    $small_pic = $data['small_pic'];

    $big_pic_path = './big_pics/'.$big_pic;
    $small_pic_path = './small_pics/'.$small_pic;

    //attempt to remove the images
    if (file_exists($big_pic_path)) {
        unlink($big_pic_path);
    }

    if (file_exists($small_pic_path)) {
        unlink($small_pic_path);
    }

    //delete the item record from store_items
    $this->_delete($update_id);
}

function delete($update_id)
{
    if (!is_numeric($update_id)) {
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $submit = $this->input->post('submit', TRUE);
    if ($submit=="Cancel") {
        redirect('store_items/create/'.$update_id);
    } elseif ($submit=="Yes - Delete Item") {
        $this->_process_delete($update_id);

        $flash_msg = "The item image was successfully deleted.";
        $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
        $this->session->set_flashdata('item', $value);

        redirect('store_items/manage');  
    }    
}

function deleteconf($update_id)
{
    if (!is_numeric($update_id)) {
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data['headline'] = "Delete Item";
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "deleteconf";
    $this->load->module('templates');
    $this->templates->admin($data);        
}

function delete_image($update_id)
{

    if (!is_numeric($update_id)) {
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data = $this->fetch_data_from_db($update_id);
    $big_pic = $data['big_pic'];
    $small_pic = $data['small_pic'];

    $big_pic_path = './big_pics/'.$big_pic;
    $small_pic_path = './small_pics/'.$small_pic;

    //attempt to remove the images
    if (file_exists($big_pic_path)) {
        unlink($big_pic_path);
    }

    if (file_exists($small_pic_path)) {
        unlink($small_pic_path);
    }

    //update the database
    unset($data);
    $data['big_pic'] = "";
    $data['small_pic'] = "";
    $this->_update($update_id, $data);

    $flash_msg = "The item image was successfully deleted.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);

    redirect('store_items/create/'.$update_id);
}


function _generate_thumbnail($file_name)
{

$config['image_library'] = 'gd2';
$config['source_image'] = './big_pics/'.$file_name;
$config['new_image'] = './small_pics/'.$file_name;
$config['maintain_ratio'] = TRUE;
$config['width']         = 200;
$config['height']       = 200;

$this->load->library('image_lib', $config);

$this->image_lib->resize();

}

function do_upload($update_id)
{

    if (!is_numeric($update_id)) {
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $submit = $this->input->post('submit', TRUE);
    if ($submit=="Cancel") {
        redirect('store_items/create/'.$update_id);
    }

    $config['upload_path']          = './big_pics/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 5500;
    $config['max_width']            = 3500;
    $config['max_height']           = 3500;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('userfile'))
    {
            $data['error'] = array('error' => $this->upload->display_errors("<p style='color: red;'>", "</p>"));
            $data['headline'] = "Upload Error";
            $data['update_id'] = $update_id;
            $data['flash'] = $this->session->flashdata('item');
            $data['view_file'] = "upload_image";
            $this->load->module('templates');
            $this->templates->admin($data);
    }
    else
    {
            //upload was successful

            $data = array('upload_data' => $this->upload->data());

            $upload_data = $data['upload_data'];
            $file_name = $upload_data['file_name'];
            $this->_generate_thumbnail($file_name);

            //update the database
            $update_data['big_pic'] = $file_name;
            $update_data['small_pic'] = $file_name;
            $this->_update($update_id, $update_data);

            $data['headline'] = "Upload Success";
            $data['update_id'] = $update_id;
            $data['flash'] = $this->session->flashdata('item');
            $data['view_file'] = "upload_success";
            $this->load->module('templates');
            $this->templates->admin($data);
    }
}

function upload_image($update_id) 
{

    if (!is_numeric($update_id)) {
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();
 
    $data['headline'] = "Upload Image";
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "upload_image";
    $this->load->module('templates');
    $this->templates->admin($data);
}

function create() 
{

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    if ($submit=="Cancel") {
        redirect('store_items/manage');
    }

    if ($submit=="Submit") {
        //process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules('item_title', 'Item Title', 'required|max_length[240]|callback_item_check');
        $this->form_validation->set_rules('item_price', 'Item Price', 'required|numeric');
        $this->form_validation->set_rules('was_price', 'Was Price', 'numeric');
        $this->form_validation->set_rules('status', 'Status', 'required|numeric');
        $this->form_validation->set_rules('item_description', 'Item Description', 'required');

        if ($this->form_validation->run() == TRUE) {
            //get the variables
            $data = $this->fetch_data_from_post();
            $data['item_url'] = url_title($data['item_title']);

            if (is_numeric($update_id)) {
                //update the item details
                $this->_update($update_id, $data);
                $flash_msg = "The item details were successfully updated.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('store_items/create/'.$update_id);
            } else {
                //insert a new item
                $this->_insert($data);
                $update_id = $this->get_max(); //get the ID of the new item
                $flash_msg = "The item was successfully added.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('store_items/create/'.$update_id);
            }
        }
    }

    if ((is_numeric($update_id)) && ($submit!="Submit")) {
        $data = $this->fetch_data_from_db($update_id);
    } else {
        $data = $this->fetch_data_from_post();
        $data['big_pic'] = "";
    }

    if (!is_numeric($update_id)) {
        $data['headline'] = "Add New Item";
    } else {
        $data['headline'] = "Update Item Details";
    }

    $data['got_gallery_pic'] = $this->_got_gallery_pic($update_id);
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "create";
    $this->load->module('templates');
    $this->templates->admin($data);
}

function _got_gallery_pic($update_id)
{
    $this->load->module('item_galleries');
    $query = $this->item_galleries->get_where_custom('parent_id', $update_id);
    $num_rows = $query->num_rows();

    if($num_rows>0) {
        return TRUE; // have at least one gallery picture for this item
    } else {
        return FALSE;
    }

}

function _get_gallery_pics($update_id)
{
    $this->load->module('item_galleries');
    $query = $this->item_galleries->get_where_custom('parent_id', $update_id);
    return $query;
}

function manage() 
{
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data['flash'] = $this->session->flashdata('item');

    $data['query'] = $this->get('item_title');
    $data['view_file'] = "manage";
    $this->load->module('templates');
    $this->templates->admin($data);
}

function fetch_data_from_post() 
{
    $data['item_title'] = $this->input->post('item_title', TRUE);
    $data['item_price'] = $this->input->post('item_price', TRUE);
    $data['was_price'] = $this->input->post('was_price', TRUE);
    $data['item_description'] = $this->input->post('item_description', FALSE);
    $data['status'] = $this->input->post('status', TRUE);
    return $data;
}

function fetch_data_from_db($update_id) 
{

    if (!is_numeric($update_id)) {
        redirect('site_security/not_allowed');
    }

    $query = $this->get_where($update_id);
    foreach($query->result() as $row) {
        //`item_title`, `item_url`, `item_price`, `item_description`, `big_pic`, `small_pic`, `was_price`
        $data['item_title'] = $row->item_title;
        $data['item_url'] = $row->item_url;
        $data['item_price'] = $row->item_price;
        $data['item_description'] = $row->item_description;
        $data['big_pic'] = $row->big_pic;
        $data['small_pic'] = $row->small_pic;
        $data['was_price'] = $row->was_price;
        $data['status'] = $row->status;
    }

    if (!isset($data)) {
        $data = "";
    }

    return $data;
}



function get($order_by) 
{
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->get($order_by);
return $query;
}
//test

function get_with_limit($limit, $offset, $order_by) 
{
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id)
{
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->get_where($id);
return $query;
}

function get_where_custom($col, $value) 
{
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->get_where_custom($col, $value);
return $query;
}

function _insert($data)
{
$this->load->model('mdl_store_items');
$this->mdl_store_items->_insert($data);
}

function _update($id, $data)
{
$this->load->model('mdl_store_items');
$this->mdl_store_items->_update($id, $data);
}

function _delete($id)
{
$this->load->model('mdl_store_items');
$this->mdl_store_items->_delete($id);
}

function count_where($column, $value) 
{
$this->load->model('mdl_store_items');
$count = $this->mdl_store_items->count_where($column, $value);
return $count;
}

function get_max() 
{
$this->load->model('mdl_store_items');
$max_id = $this->mdl_store_items->get_max();
return $max_id;
}

function _custom_query($mysql_query) 
{
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->_custom_query($mysql_query);
return $query;
}

function item_check($str) 
{

    $item_url = url_title($str);
    $mysql_query = "select * from store_items where item_title='$str' and item_url='$item_url'";

    $update_id = $this->uri->segment(3);
    if (is_numeric($update_id)) {
        //this is an update
        $mysql_query.= " and id!=$update_id";
    }

    $query = $this->_custom_query($mysql_query);
    $num_rows = $query->num_rows();

    if ($num_rows>0)
    {
        $this->form_validation->set_message('item_check', 'The item title that you submitted is not available');
        return FALSE;
    }
    else
    {
        return TRUE;
    }
}


}