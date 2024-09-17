<?php

class Charity extends Controller
{
    function index()
    {
       $this->view('charity_dashboard');
    }

    function manage_events()
    {
        $this->view('charity_manage_events');
    }

    function donations()
    {
        $this->view('charity_donations');
    }

    function browse_shops()
    {
        $this->view('charity_browse_shops');
    }

    function reports()
    {
        $this->view('charity_reports');
    }

    function profile()
    {
        $this->view('charity_profile');
    }
}
