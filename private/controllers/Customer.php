<?php

class Customer extends Controller
{
    function index($id = '')
    {
        echo $this->view('customer');
    }
}