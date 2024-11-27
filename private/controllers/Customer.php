<?php
class Customer extends Controller{
    function index(){
        $this->view('CustomerDashboard');
    }
    function browseShops(){
        $this->view('CustomerBrowseShops');
    }
    function cart(){
        $this->view('custCart');
    }
    
}
?>