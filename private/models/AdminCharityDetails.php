<?php


class AdminCharityDetails extends Model
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
}
