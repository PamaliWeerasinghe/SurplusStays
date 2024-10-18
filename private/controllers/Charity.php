<?php

class Charity extends Controller
{
    function index()
    {
        $charity = new Organization();
        $data = $charity->findAll();
        $this->view('charity_dashboard',['rows' => $data]);
    }

    function manage_events()
    {
        $this->view('charity_manage_events');
    }

    function donations()
    {
        $this->view('charityDonations');
    }

    function browse_shops()
    {
        $this->view('charityBrowseShops');
    }

    function reports()
    {
        $this->view('charityReports');
    }

    function profile()
    {
        $this->view('charityProfile');
    }

    function createEvent()
    {
        $this->view('charityCreateEvent');
    }
}
