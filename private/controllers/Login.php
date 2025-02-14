<?php 


class Login extends Controller{

    function index(){
        $errors=array();
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
                // if(password_verify($_POST['password'],$password)){
                
                //check the roles
                switch ($user_details->role) {
                    case 'admin':
                        $admin= new AdminModel();
                        $admin_details=$admin->where(['user_id1'],[$user_details->id],'admin');
                        //generate the tocken
                        $token=TokenHandler::generateToken();

                        Auth::authenticate($admin_details,$user_details);
                        //insert the token into the database
                        $data['token']=$token;
                        $admin->update($user_details->id,$data,'admin_details');

                        Mail::sendAdminDashboard($_POST['email'],$token);
                        
                        // TODO: view email sent 
                        die('Email sent');
                        self::verifyEmail();
                        break;
                    case 'customer':
                        $customer=new AdminUser();
                        $customer_details=$customer->where('user_id',$user_details->id,'customer');
                        Auth::authenticate($customer_details,$user_details);
                        $this->view('CustomerDashboard',[
                            'customerDetails'=>$customer,
                            'commonDetails'=>$user
                        ]);
                        break;
                    case 'business':
                        $business= new AdminUser();
                        $business_details=$business->where('user_id',$user_details->id,'business');
                        Auth::authenticate($business_details,$user_details);
                        $this->view('businessWelcomePage',[
                            'businessDetails'=>$business,
                            'commonDetails'=>$user
                        ]);
                        break;
                    case 'charity':
                        $charity= new AdminUser();
                        $charity_details=$charity->where('user_id',$user_details->id,'organization');
                        Auth::authenticate($charity_details,$user_details);
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
                // }else{
                //     $errors['password'] = "Please check your password";
                //     $this->view('AdminLoginStep1', [
                //         'errors' => $errors
                //     ]);
                // }


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

    public function verifyEmail(){
        $token = $_GET['token'];
        //get token details from database
        $admin =new AdminModel();
        $find_token=$admin->where(['token'],[$token],'admin_details');
        
        $find_token=$find_token[0];
        if($_GET['token']==$find_token->token){
            $this->view('AdminWelcomePage',[
                'rows'=>$find_token
            ]);
        }

    
    }

}



?>