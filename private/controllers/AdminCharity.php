<?php
class AdminCharity extends Controller
{   
    // function edit($id){
    //     $charity=new AdminModel();
    //     $data=$charity->where('id',$id,'organization');
    //     $errors=null;

    //     $this->view('AdminViewCharity',[
    //         'rows'=>$data,
    //         'errors'=>$errors
    //     ]);
    // }


    
    function index($id){
        $errors=array();
        $charity=new AdminModel();
        if(count($_POST)>0){
            if($charity->validateEditCharity($_POST)){
                $arr['name'] = $_POST['name'];
                $arr['picture'] = $charity->uploadLogo($_FILES['logo']['name']);
                $arr['city'] = $_POST['city'];
                $arr['email'] = $_POST['email'];
                $arr['phoneNo'] = $_POST['phone'];
                $arr['charity_description'] = $_POST['description'];
                $arr['username'] = $_POST['username'];
                $arr['date'] = date("Y-m-d H:i:s");

                if(empty($arr['password'])|| empty($arr['confirm_password'])){
                    $charity->updateExceptPassword($arr['name'],$arr['picture'],$arr['city'],$arr['email'],$arr['phoneNo'],$arr['charity_desctiption'],$arr['username'],$arr['date'],$id);
                    $data=$charity->where('id',$id,'organization');
                    $this->view('AdminViewCharity',[
                        'rows'=>$data
                    ]);
                }else{

                }

            }else{
                $this->view('AdminEditCharityOrg',[
                    'errors'=>$errors
                ]);
            }


        }else{
            
            $data=$charity->where('id',$id,'organization');
            if($data){
                $data=$data[0];
            }
    
    
            $this->view('AdminEditCharityOrg',[
                'rows'=>$data
            ]);
        }
       
        
        // if(count($_POST)>0){
            
        // }else{

        // }


        // $charity=new AdminModel();
        // $data=$charity->where('id',$id,'organization');
        // if($data){
        //     $data=$data[0];
        // }

        // $this->view('AdminViewCharity',[
        //     'rows'=>$data,
            
        // ]);

    }
    
    //delete a charity organization
    function delete($id=null){
        if(!Auth::logged_in()){
            $this->redirect('register');
        }
        $charity=new AdminModel();

        $errors=array();

        if(count($_POST)>0){
            $charity->delete($id,'organization');
            $this->redirect('ManageCharityOrg');
        }
        $row=$charity->where('id',$id,'organization');

        $this->view('AdminManageCharityOrg',[
            'row'=>$row,
        ]);

    }
    
}
?>