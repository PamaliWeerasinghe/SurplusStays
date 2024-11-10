<?php

//home controller

class Login extends Controller
{
    function index()
    {

        $product = new Products();

        //$data=$product->where('name','koiu');

        
        //$arr['business_id'] = 1;
        //$arr['name'] = 'karamel';
        //$arr['category_id'] = 1;
        //$arr['description'] = 'jghmghngmnhngnh';
        //$arr['qty'] = 20;
        //$arr['price_per_unit'] = 55;
        //$arr['expiration_dateTime'] = '2024-11-13 02:59:41';
        //$arr['productImages_id'] = 1;
        //$arr['discount_type_id'] = 1;
        //$arr['discountPrice'] = 5;
        //$product->insert($arr);
        //$arr['name'] = 'karamelupdate';
        //$product->update(7,$arr);
        $product->delete(8);
        $data = $product->findAll();
        $this->view('business_login', ['rows' => $data]);
    }
}
