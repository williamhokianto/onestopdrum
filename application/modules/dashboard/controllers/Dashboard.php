<?php
class Dashboard extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function home()
{
	$this->load->module('store_items');
	$mysql_query_product = "select * from store_items";
	$query_product = $this->store_items->_custom_query($mysql_query_product);
	$num_rows_product = $query_product->num_rows();
	$data['num_rows_product'] = $num_rows_product;

	$this->load->module('enquiries');
	$mysql_query_message = "select * from enquiries where sent_to = 0 and opened = 0";
	$query_message = $this->store_items->_custom_query($mysql_query_message);
	$num_rows_message = $query_message->num_rows();
	$data['num_rows_message'] = $num_rows_message;

    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "home";
    $this->load->module('templates');
    $this->templates->admin($data);

}

}