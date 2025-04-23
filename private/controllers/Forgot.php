<?php
class Forgot extends Controller
{
    function index()
    {
        $errors = array();
        //Check the POST method
        if (count($_POST) > 0) {
            $user = new User();
            //find a user with the relevant email
            $email = $user->where('email', $_POST['email'], 'user');
            //check the user exists
            if ($email) {
                $user_details = $email[0];
                //generate the token
                $token = TokenHandler::generateToken();
                $expiry = TokenHandler::generateExpiryDate();
                //insert the token into the database
                $data['token'] = $token;
                $data['token_expiry'] = $expiry;

                $admin = new AdminModel();

                $admin->update($user_details->id, $data, 'user');

                Mail::sendEmailVerification($_POST['email'], $token);
            }else{
                $this->view('ForgotPassword');
            }
            
        } else {
            $this->view('ForgotPassword');
        }
        
    }

    //Verify the token sent via email
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
}
