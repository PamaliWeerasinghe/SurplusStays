<?php

class Charity extends Controller
{
    function index($id = '')
    {
        echo $this->view('adminPage');
    }
}
