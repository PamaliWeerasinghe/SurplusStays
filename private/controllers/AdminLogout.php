<?php

class AdminLogout extends Controller
{
    function index()
    {
        AdminAuth::logout();        
        $this->view('home');
    }

    
}