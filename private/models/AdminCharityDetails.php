<?php


class AdminCharityDetails extends Admin_Model
{
    public function getDonorCount($id)
    {
        $query = "select count(organization_id) as donors 
        from donations
        inner join organization 
        on organization.id=donations.organization_id
        where organization_id=:id";

        $params = ["id" => $id];

        $result = $this->query($query, $params);

        return $result[0]->donors;
    }
    public function getComplaintsCount($id)
    {
        $query = "select count(donations_id) as donations
        from charity_complaints
        inner join donations
        on charity_complaints.donations_id=donations.id
        where organization_id=:id";

        $params = ["id" => $id];
        $result = $this->query($query, $params);

        return $result[0]->donations;
    }
}