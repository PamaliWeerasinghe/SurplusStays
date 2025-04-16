<?php 

class AdminDeleteCharity extends Controller{
    function index($id){
        $charity=new AdminModel();
        $data["status_id"]=3;
        $charity->update($id,$data,'user');
       
        $this->redirect("Admin/ManageCharityOrg");

    }
    //Managing charity organizations
    // function ManageCharityOrg()
    // {
    //     if (!Auth::logged_in()) {
    //         $this->redirect('register');
    //     } else {
    //         $org = new AdminModel();
    //         $org_limit=2;
    //         //count the no of organizations in the organization table
    //         $orgCountData=$org->count('charity_details');
    //         //calculate the no of pages
    //         $noOfPages_org= ceil($orgCountData/$org_limit);

    //         //pagination for organizations
    //         $org_pager=Pager::getInstance('charity_details',$noOfPages_org,$org_limit);
    //         $org_offset=$org_pager->offset;
    //         $organization=$org->select('charity_details','org_id',$org_limit,$org_offset);

    //         $this->view('AdminManageCharityOrganizations', [
    //             "org"=>$organization,
    //             "org_pager"=>$org_pager
    //         ]);
    //     }
    // }
}






?>