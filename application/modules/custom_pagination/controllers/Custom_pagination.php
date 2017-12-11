<?php
class Custom_pagination extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _generate_pagination($data)
{
    //NOTE: for this to work, data must contain;
    //$template, $target_base_url, $total_rows, $offset_segment, $limit

    $template = $data['template'];
    $target_base_url = $data['target_base_url'];
    $total_rows = $data['total_rows'];
    $offset_segment = $data['offset_segment'];
    $limit = $data['limit'];

    if ($template=="public_bootstrap") {
        $settings = $this->get_settings_for_public_bootstrap();
    } elseif ($template=="admin") {
        $settings = $this->get_settings_for_admin();
    }

    $this->load->library('pagination');
    $config['base_url'] = $target_base_url;
    $config['total_rows'] = $total_rows;
    $config['uri_segment'] = $offset_segment;

    $config['per_page'] = $limit;
    $config['num_links'] = $settings['num_links'];
    
    $config['full_tag_open'] = $settings['full_tag_open'];
    $config['full_tag_close'] = $settings['full_tag_close'];
    
    $config['cur_tag_open'] = $settings['cur_tag_open'];
    $config['cur_tag_close'] = $settings['cur_tag_close'];
    
    $config['num_tag_open'] = $settings['num_tag_open'];
    $config['num_tag_close'] = $settings['num_tag_close'];
    
    $config['first_link'] = $settings['first_link'];
    $config['first_tag_open'] = $settings['first_tag_open'];
    $config['first_tag_close'] = $settings['first_tag_close'];
    
    $config['last_link'] = $settings['last_link'];
    $config['last_tag_open'] = $settings['last_tag_open'];
    $config['last_tag_close'] = $settings['last_tag_close'];
    
    $config['prev_link'] = $settings['prev_link'];
    $config['prev_tag_open'] = $settings['prev_tag_open'];
    $config['prev_tag_close'] = $settings['prev_tag_close'];
    
    $config['next_link'] = $settings['next_link'];
    $config['next_tag_open'] = $settings['next_tag_open'];
    $config['next_tag_close'] = $settings['next_tag_close'];

    $this->pagination->initialize($config);
    $pagination = $this->pagination->create_links();
    return $pagination;

}

function get_showing_statement($data)
{
    //NOTE: for this to work, data should contain;
    //limit, offset, total_rows

    $limit = $data['limit'];
    $offset = $data['offset'];
    $total_rows = $data['total_rows'];

    $value1 = $offset+1;
    $value2 = $offset+$limit;
    $value3 = $total_rows;

    if ($value2>$value3) {
        $value2 = $value3;
    }

    $showing_statement = "Showing ".$value1." to ".$value2." of ".$value3." results.";
    return $showing_statement;
}

function get_settings_for_public_bootstrap()
{
    $settings['num_links'] = 12;

    $settings['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';
    $settings['full_tag_close'] = '</ul></nav>';

    $settings['cur_tag_open'] = '<li class="active"><a href="#">';
    $settings['cur_tag_close'] = '</a></li>';

    $settings['num_tag_open'] = '<li>';
    $settings['num_tag_close'] = '</li>';

    $settings['first_link'] = 'First';
    $settings['first_tag_open'] = '<li>';
    $settings['first_tag_close'] = '</li>';

    $settings['last_link'] = 'Last';
    $settings['last_tag_open'] = '<li>';
    $settings['last_tag_close'] = '</li>';

    $settings['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
    $settings['prev_tag_open'] = '<li>';
    $settings['prev_tag_close'] = '</li>';

    $settings['next_link'] = '<span aria-hidden="true">&raquo;</span>';
    $settings['next_tag_open'] = '<li>';
    $settings['next_tag_close'] = '</li>';
    return $settings;
}

function get_settings_for_admin()
{
    $settings['num_links'] = '10';

    $settings['full_tag_open'] = '<div class="pagination pagination-left"><ul>';
    $settings['full_tag_close'] = '</ul></div>';

    $settings['cur_tag_open'] = '<li class="active"><a href="#">';
    $settings['cur_tag_close'] = '</a></li>';

    $settings['num_tag_open'] = '<li>';
    $settings['num_tag_close'] = '</li>';

    $settings['first_link'] = 'First';
    $settings['first_tag_open'] = '<li>';
    $settings['first_tag_close'] = '</li>';

    $settings['last_link'] = 'Last';
    $settings['last_tag_open'] = '<li>';
    $settings['last_tag_close'] = '</li>';

    $settings['prev_link'] = 'Prev';
    $settings['prev_tag_open'] = '<li>';
    $settings['prev_tag_close'] = '</li>';

    $settings['next_link'] = 'Next';
    $settings['next_tag_open'] = '<li>';
    $settings['next_tag_close'] = '</li>';

    return $settings;
}

/*
function get_settings_for_some_template()
{
    $settings['num_links'] = '';

    $settings['full_tag_open'] = '';
    $settings['full_tag_close'] = '';

    $settings['cur_tag_open'] = '';
    $settings['cur_tag_close'] = '';

    $settings['num_tag_open'] = '';
    $settings['num_tag_close'] = '';

    $settings['first_link'] = '';
    $settings['first_tag_open'] = '';
    $settings['first_tag_close'] = '';

    $settings['last_link'] = '';
    $settings['last_tag_open'] = '';
    $settings['last_tag_close'] = '';

    $settings['prev_link'] = '';
    $settings['prev_tag_open'] = '';
    $settings['prev_tag_close'] = '';

    $settings['next_link'] = '';
    $settings['next_tag_open'] = '';
    $settings['next_tag_close'] = '';
    return $settings;
}
*/

/*
<div class="pagination pagination-centered">
  <ul>
    <li><a href="#">Prev</a></li>
    <li class="active">
      <a href="#">1</a>
    </li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">Next</a></li>
  </ul>
</div>     
*/ 

// kept for future reference



}