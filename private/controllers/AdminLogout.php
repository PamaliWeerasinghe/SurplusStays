<?php

class AdminLogout extends Controller
{
    function index()
    {
        Auth::logout();        
        $this->view('home');
    }

    
}