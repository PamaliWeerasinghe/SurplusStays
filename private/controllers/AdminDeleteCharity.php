<?php 

class AdminDeleteCharity extends Controller{
    function index($id){
        $charity=new AdminModel();
        $charity->delete($id,'organization');
        $data=$charity->findAll('organization');
        $countd = new AdminCharityDetails();
        foreach ($data as $row) {
            $count = $countd->getDonorCount($row->id);
            $row->donors = $count;
        }
        foreach ($data as $row) {
            $count = $countd->getComplaintsCount($row->id);
            $row->donations = $count;
        }
        $this->view('AdminManageCharityOrganizations',['rows'=>$data]);

    }
}






?>