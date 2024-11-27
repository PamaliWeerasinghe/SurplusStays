<?php

//home controller

class Login extends Controller
{
    function index()
    {
        echo $this->view('login');
    }
}
