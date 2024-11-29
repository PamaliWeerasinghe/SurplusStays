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

    function payment(){
        $this->view('custPayment');
    }

    function viewOrders(){
        $this->view('custViewOrders');
    }

    function wishlist(){
        $this->view('custWishlist');
    }

    function profile(){
        $this->view('custProfile');
    }

    function changePassword(){
        $this->view('custChangePassword');
    }

}
?>