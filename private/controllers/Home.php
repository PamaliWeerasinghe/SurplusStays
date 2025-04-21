<?php

//home controller

class Home extends Controller
{
    function index()
    {
        $this->view('home');
    }

    function shop(){
        $this->view('unregShop');
    }
}

