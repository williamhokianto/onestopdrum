<?php
class Paypal extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _display_summary_info($update_id)
{
    $this->load->module('timedate');
    $query = $this->get_where($update_id);
    foreach ($query->result() as $row) {
        $date_created = $row->date_created;
        $posted_information = $row->posted_information;
    }

    $data = unserialize($posted_information);
    $data['date_created'] = $this->timedate->get_nice_date($date_created, 'full');

    if ($data['business'] == "") {
        $data['business'] == "-";
    }

    $this->load->view('summary_info', $data);
}

function submit_test()
{
    $on_test_mode = $this->_is_on_test_mode();
    $num_orders = $this->input->post('num_orders', TRUE);
    $custom = $this->input->post('custom', TRUE);

    if (($on_test_mode == FALSE) OR (!is_numeric($num_orders))) {
        die(); // not allowed
    }

    // simulate order creation
    $paypal_id = 1;
    $this->load->module('store_orders');
    $this->load->module('site_security');
    $this->load->module('store_basket');

    $customer_session_id = $this->site_security->_decrypt_string($custom);

    $query = $this->store_basket->get_where_custom('session_id', $customer_session_id);
    foreach ($query->result() as $row) {
        $store_basket_data['session_id'] = $row->session_id;
        $store_basket_data['item_title'] = $row->item_title;
        $store_basket_data['price'] = $row->price;
        $store_basket_data['tax'] = $row->tax;
        $store_basket_data['item_id'] = $row->item_id;
        $store_basket_data['item_size'] = $row->item_size;
        $store_basket_data['item_qty'] = $row->item_qty;
        $store_basket_data['item_colour'] = $row->item_colour;
        $store_basket_data['date_added'] = $row->date_added;
        $store_basket_data['shopper_id'] = $row->shopper_id;
        $store_basket_data['ip_address'] = $row->ip_address;
    }


    for ($i=0; $i < $num_orders ; $i++) { 
        $this->store_orders->_auto_generate_order($paypal_id, $customer_session_id);
        $this->store_basket->_insert($store_basket_data);
    }

    $mysql_query = "delete from store_basket where session_id='$customer_session_id'";
    $query = $this->_custom_query($mysql_query);

    echo "Finished.";
}

function ipn_listener()
{
    // the URL that accept things that paypal has posted
    header('HTTP/1.1 200 OK'); // Let Paypall know that all is well

    // STEP 1: read POST data
    // Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
    // Instead, read raw POST data from the input stream. 
    $raw_post_data = file_get_contents('php://input');
    $raw_post_array = explode('&', $raw_post_data);
    $myPost = array();
    foreach ($raw_post_array as $keyval) {
      $keyval = explode ('=', $keyval);
      if (count($keyval) == 2)
         $myPost[$keyval[0]] = urldecode($keyval[1]);
    }
    // read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
    $req = 'cmd=_notify-validate';
    if(function_exists('get_magic_quotes_gpc')) {
       $get_magic_quotes_exists = true;
    } 
    foreach ($myPost as $key => $value) {        
       if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
            $value = urlencode(stripslashes($value)); 
       } else {
            $value = urlencode($value);
       }
       $req .= "&$key=$value";
    }
     
    // Step 2: POST IPN data back to PayPal to validate
    // if using live change the url to 'https://www.paypal.com/cgi-bin/webscr'
    if ($on_test_mode==TRUE) {
        $ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
    } else {
        $ch = curl_init('https://www.paypal.com/cgi-bin/webscr'); 
    }
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
    // In wamp-like environments that do not come bundled with root authority certificates,
    // please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set 
    // the directory path of the certificate as shown below:
    // curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
    if( !($res = curl_exec($ch)) ) {
        // error_log("Got " . curl_error($ch) . " when processing IPN data");
        curl_close($ch);
        exit;
    }
    curl_close($ch);

    // inspect IPN validation result and act accordingly
    if (strcmp ($res, "VERIFIED") == 0) {
        // The IPN is verified, process it
        $this->load->module('site_security');
        $data['date_created'] = time();
        foreach ($_POST as $key => $value) {
            if ($key=='custom') {
                $customer_session_id = $this->site_security->_decrypt_string($value);
                $value = $customer_session_id;
            }

            $posted_information[$key] = $value;
        }
        $data['posted_information'] = serialize($posted_information);
        $this->_insert($data);
        $this->max_id = $this->get_max();
        $this->load->module('store_orders');
        $this->store_orders->_auto_generate_order($max_id, $customer_session_id);

    } else if (strcmp ($res, "INVALID") == 0) {
        // IPN invalid, log for manual investigation
    }

}
function thankyou()
{   
    $data['view_file'] = 'thankyou';

    $this->load->module('templates');
    $this->templates->public_bootstrap($data);
}

function cancel()
{
    $data['view_file'] = 'cancel';
    $this->load->module('templates');
    $this->templates->public_bootstrap($data);
}


function _is_on_test_mode()
{
    return TRUE; //set this to FALSE if we are live!
}

function _draw_checkout_btn($query)
{
    $this->load->module('site_settings');
    $this->load->module('site_security');
    $this->load->module('shipping');

    foreach($query->result() as $row) {
        $session_id = $row->session_id;
    }

    $on_test_mode = $this->_is_on_test_mode();

    if ($on_test_mode==TRUE) {
        $data['form_location'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    } else {
        $data['form_location'] = 'https://www.paypal.com/cgi-bin/webscr';
    }

    $data['on_test_mode'] = $on_test_mode;
    $data['return'] = base_url().'paypal/thankyou';
    $data['cancel_return'] = base_url().'paypal/cancel';
    $data['shipping'] = $this->shipping->_get_shipping();
    $data['custom'] = $this->site_security->_encrypt_string($session_id);
    $data['paypal_email'] = $this->site_settings->_get_paypal_email();
    $data['currency_code'] = $this->site_settings->_get_currency_code();
    $data['query'] = $query;
    $this->load->view('checkout_btn', $data);
}

function get($order_by)
{
    $this->load->model('mdl_paypal');
    $query = $this->mdl_paypal->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_paypal');
    $query = $this->mdl_paypal->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_paypal');
    $query = $this->mdl_paypal->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_paypal');
    $query = $this->mdl_paypal->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_paypal');
    $this->mdl_paypal->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_paypal');
    $this->mdl_paypal->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_paypal');
    $this->mdl_paypal->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_paypal');
    $count = $this->mdl_paypal->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_paypal');
    $max_id = $this->mdl_paypal->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_paypal');
    $query = $this->mdl_paypal->_custom_query($mysql_query);
    return $query;
}

/*
function curl_test()
{
    // STEP 1: read POST data
    // Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
    // Instead, read raw POST data from the input stream. 

    $data['name'] = 'William';
    $data['city'] = 'Hokianto';
    $data['age'] = 21;

    $data_string = '';
    foreach ($data as $key => $value) {
        $data_string.= $key.'='.$value.'&';
    }

    $raw_post_array = explode('&', $data_string);
    $myPost = array();
    foreach ($raw_post_array as $keyval) {
      $keyval = explode ('=', $keyval);
      if (count($keyval) == 2)
         $myPost[$keyval[0]] = urldecode($keyval[1]);
    }
    // read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
    $req = 'cmd=_notify-validate';
    if(function_exists('get_magic_quotes_gpc')) {
       $get_magic_quotes_exists = true;
    } 
    foreach ($myPost as $key => $value) {        
       if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
            $value = urlencode(stripslashes($value)); 
       } else {
            $value = urlencode($value);
       }
       $req .= "&$key=$value";
    }
     
    // STEP 2: POST IPN data back to PayPal to validate
    $ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
    // In wamp-like environments that do not come bundled with root authority certificates,
    // please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set 
    // the directory path of the certificate as shown below:
    // curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
    if( !($res = curl_exec($ch)) ) {
        // error_log("Got " . curl_error($ch) . " when processing IPN data");
        curl_close($ch);
        exit;
    }
    curl_close($ch);

    echo $res; die();
    
        // inspect IPN validation result and act accordingly
    if (strcmp ($res, "VERIFIED") == 0) {
        // The IPN is verified, process it
    } else if (strcmp ($res, "INVALID") == 0) {
        // IPN invalid, log for manual investigation
    }
}
*/

function test()
{
    $query = $this->get_where(1);
    foreach ($query->result() as $row) {
        $posted_information = $row->posted_information;
    }

    echo $posted_information;
    echo "<hr>";
    $posted_information = unserialize($posted_information);

    foreach ($posted_information as $key => $value) {
        echo "key of $key has value of $value<br>";
    }
}




}