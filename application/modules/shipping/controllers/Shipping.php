<?php
class Shipping extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _get_shipping()
{
    $shipping = '0.01';
    return $shipping;
}

}