<?php
if(get_role(auth()->id)->role_id == env('USER_ROLE_ID'))
{
    $filter['created_by'] = auth()->id;
}

$having = "";

if($filter)
{
    $filter_query = [];
    foreach($filter as $f_key => $f_value)
    {
        $filter_query[] = "$f_key = '$f_value'";
    }

    $filter_query = implode(' AND ', $filter_query);

    $having = (empty($having) ? 'HAVING ' : ' AND ') . $filter_query;
}

$db->query = "SELECT * FROM $this->table $where ORDER BY ".$col_order." ".$order[0]['dir']." LIMIT $start,$length";
$data  = $this->db->exec('all');

$total = $this->db->exists($this->table,$where,[
    $col_order => $order[0]['dir']
]);

return compact('data','total');