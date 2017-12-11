<?php
class Comments extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _draw_comments($comment_type, $update_id)
{
    $mysql_query = "select * from comments where comment_type='$comment_type' and update_id=$update_id";
    $mysql_query.= " order by date_created";
    $data['query'] = $this->_custom_query($mysql_query);
    $num_rows = $data['query']->num_rows();
    if ($num_rows>0) {
        $this->load->view('comments', $data);
    }
}

function submit()
{
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data['comment_type'] = $this->input->post('comment_type', TRUE);
    $data['update_id'] = $this->input->post('update_id', TRUE);
    $data['comment'] = $this->input->post('comment', TRUE);
    $data['date_created'] = time();

    if ($data['comment']!='') {
        $this->_insert($data);
        $flash_msg = "The comment was successfully submitted.";
        $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
        $this->session->set_flashdata('item', $value);
    }

    $finish_url = $_SERVER['HTTP_REFERER'];
    redirect($finish_url);
}

function get($order_by)
{
    $this->load->model('mdl_comments');
    $query = $this->mdl_comments->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_comments');
    $query = $this->mdl_comments->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_comments');
    $query = $this->mdl_comments->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_comments');
    $query = $this->mdl_comments->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_comments');
    $this->mdl_comments->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_comments');
    $this->mdl_comments->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_comments');
    $this->mdl_comments->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_comments');
    $count = $this->mdl_comments->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_comments');
    $max_id = $this->mdl_comments->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_comments');
    $query = $this->mdl_comments->_custom_query($mysql_query);
    return $query;
}

}