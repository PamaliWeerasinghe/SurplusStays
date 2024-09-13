<?php

//home controller

class Register extends Controller
{
    function index()
    {
        $this->view('register');
    }

     // This method handles displaying the charity login page
     function charity()
     {
         $this->view('charity_register');
     }
}


