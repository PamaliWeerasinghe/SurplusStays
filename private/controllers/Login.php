<?php 


class Login extends Controller{

    function index(){
        $errors=array();
        $successfull=array();
        // check the POST method
        if(count($_POST)>0){
            $user=new User();
            //find the user with the relevant email
            $email=$user->where('email',$_POST['email'],'user');
            //check the user exists
            if($email){
                $user_details=$email[0];
                
                //check the password
                $password=$user_details->password;
                if(password_verify($_POST['password'],$password)){
                
                //check the roles
                switch ($user_details->role) {
                    case 'admin':
                        $admin= new AdminModel();
                        $admin_details=$admin->where(['user_id1'],[$user_details->id],'admin');
                        //generate the tocken
                        $token=TokenHandler::generateToken();
                        $expiry=TokenHandler::generateExpiryDate();
                        Auth::authenticate($admin_details,$user_details);
                        //insert the token into the database
                        $data['token']=$token;
                        $data['token_expiry']=$expiry;
                        $admin->updateUserWhere($user_details->id,$data,'admin');

                        Mail::sendAdminDashboard($_POST['email'],$token);
                        
                        $_SESSION['alert_message']="Check your email";
                        $_SESSION['alert_type']="success";
                        $this->redirect('login/checkEmail');

                        self::verifyEmail();

                        break;
                    case 'customer':
                        $customer=new AdminUser();
                        $customer_details=$customer->where(['user_id'],[$user_details->id],'customer');
                        Auth::authenticate($customer_details,$user_details);
                        $this->view('CustomerDashboard',[
                            'customerDetails'=>$customer,
                            'commonDetails'=>$user
                        ]);
                        break;
                    case 'business':
                        $business= new AdminUser();
                        $business_details=$business->where(['user_id'],[$user_details->id],'business');
                        Auth::authenticate($business_details,$user_details);
                        $this->view('businessWelcomePage',[
                            'businessDetails'=>$business,
                            'commonDetails'=>$user
                        ]);
                        break;
                    case 'charity':
                        $charity= new AdminUser();
                        $charity_details=$charity->where(['user_id'],[$user_details->id],'organization');
                        // print_r($charity_details);
                        Auth::authenticate($charity_details[0],$user_details);
                        $this->view('charity_dashboard',[
                            'charityDetails'=>$charity,
                            'commonDetails'=>$user
                        ]);
                        break;
                    default:
                        $this->view('AdminLoginStep1');
                        break;
                }
                //password doesn't match
                }else{
                    $errors['password'] = "Please check your password";
                    $this->view('AdminLoginStep1', [
                        'errors' => $errors
                    ]);
                }


            }else{
                //No email found
                $errors['email']="Please check your email";
                $this->view('AdminLoginStep1',[
                    'errors'=>$errors
                ]);
            }
        }else{
            $this->view('AdminLoginStep1');
        }
        
    }

    public function verifyEmail()
    {
        $token = $_GET['token'];
        //get token details from database
        $admin =new AdminModel();
        $find_token=$admin->where(['token'],[$token],'admin_details');
        
        if(!empty($find_token)){
            // print_r($find_token[0]);
            // $find_token=$find_token[0];
            if($find_token[0]->token_expiry>date("Y-m-d H:i:s")){
                if($_GET['token']==$find_token[0]->token){
                    $admin_details=$admin->where(['token'],[$token],'admin');
        
                    if(isset($admin_details[0]->id)){
                        $admin_details=$admin_details[0];
                        $id=$admin_details->user_id1;
                    }
                    $user_details=$admin->where(['id'],[$id],'user');
                    if(isset($user_details[0]->id)){
                        $user_details=$user_details[0];
                       
                    }
                    Auth::authenticate($admin_details,$user_details);
                    $this->redirect('admin/dashboard');
                }else{
                    //prepare a page for invalid login
                    $this->view('404');
                }
            }else{
                $errors["token_expiry"]="Token is expired. Retry to login";
                //prepare a page for invalid login
                $this->view('404');
            }
        }else{
            $this->view('404');
        }
       
       

    
    }
    public function verifyForgotEmail(){
        $token=$_GET['token'];

        //get the token details from the database
        $user=new AdminModel();
        $find_token=$user->where(['token'],[$token],'user');
    
        if(isset($find_token)){
            if($find_token[0]->token_expiry > date("Y-m-d H:i:s")){
                if($_GET['token']==$find_token[0]->token){
                    $user_details=$user->where(['token'],[$token],'user');
                    
                    if(isset($user_details[0]->id)){
                        $user_details=$user_details[0];
                        $id=$user_details->id;
                        // print_r($user_details->role);
                        switch ($user_details->role){
                            case 'customer':
                                $role_details=$user->where(['user_id'],[$id],'customer');
                                Auth::authenticate($user_details,$role_details[0]);
                                $this->redirect('login/ResetPassword');
                                break;
                            case 'charity':
                                $role_details=$user->where(['user_id'],[$id],'organization');
                                Auth::authenticate($user_details,$role_details[0]);
                                $this->redirect('login/ResetPassword');
                                break;
                            case 'business':
                                $role_details=$user->where(['user_id'],[$id],'business');
                                Auth::authenticate($user_details,$role_details[0]);
                                $this->redirect('login/ResetPassword');
                                break;
                            case 'admin':
                                $role_details=$user->where(['user_id1'],[$id],'admin');
                                Auth::authenticate($user_details,$role_details[0]);
                                $this->redirect('login/ResetPassword');
                                break;
                            default:
                               $this->view('ForgotPassword');
                               break;

                        }
                    }
                   
                  
                }else{
                    $this->view('404');
                }
            }else{
                $errors["token_expiry"]="Token is expired. Retry to login";
                //prepare a page for invalid login
                $this->view('404');
            }
        }


    }

    public function checkEmail(){
        
        $this->view('AdminLoginStep1',[
            'successfull'=>$_SESSION['alert_message'],
        ]);
    }
    function forgot(){
        $errors=array();
        //Check the POST method
        if(count($_POST)>0){
            $user=new User();
            //find a user with the relevant email
            $email=$user->where('email',$_POST['email'],'user');
            //check the user exists
            if($email){
                $user_details=$email[0];
                //generate the token
                $token=TokenHandler::generateToken();
                $expiry=TokenHandler::generateExpiryDate();
                //insert the token into the database
                $data['token']=$token;
                $data['token_expiry']=$expiry;

                $admin=new AdminModel();

                $admin->update($user_details->id,$data,'user');

                Mail::sendEmailVerification($_POST['email'],$token);
                


                
            }
        }else{

        }
        $this->view('ForgotPassword');
    }
    function ResetPassword(){
        // print_r(count($_POST));
        // print_r($_SESSION['USER']->id);
        // print_r(Auth::getUserId());
        $errors=array();
        $id=Auth::getUserId();
        if(count($_POST)>0){
            if($_POST['new_password']!=$_POST['renter_password']){
                $errors['mismatch']="Two passwords doesn't match";
            }else{
                $password=password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                $user=new AdminModel();
                $data['password']=$password;
                $user->update($id,$data,'user');

                $this->redirect('login/');
            }
          

        }
        $this->view('ResetPassword',[
            "errors"=>$errors
        ]);
    }
   

}



?>