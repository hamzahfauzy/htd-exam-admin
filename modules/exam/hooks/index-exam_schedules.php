<?php
$role = get_role(auth()->id);
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


$additionalColumn = ", (CASE WHEN DATE_FORMAT(start_at, '%Y-%m-%d') = CURDATE() THEN 'today' 
WHEN DATE_FORMAT(start_at, '%Y-%m-%d') < CURDATE() THEN 'overdue'
WHEN DATE_FORMAT(start_at, '%Y-%m-%d') > CURDATE() THEN 'upcoming'
END) AS schedule_status";
if($role->role_id == env('EXAM_MEMBER_ROLE_ID'))
{
    // get user group : SELECT group_id FROM exam_group_member WHERE user_id = auth()->id
    $where = (empty($where) ? 'WHERE ' : $where .' AND ')  . " status='PUBLISH' AND id IN (SELECT schedule_id FROM exam_schedule_groups WHERE group_id IN (SELECT group_id FROM exam_group_member WHERE user_id = ".auth()->id."))";
    $additionalColumn .= ", (SELECT COUNT(*) FROM exam_member_answers WHERE exam_member_answers.schedule_id = exam_schedules.id AND exam_member_answers.user_id = ".auth()->id.") as is_answered";
    $additionalColumn .= ", (SELECT status FROM exam_schedule_user_data WHERE exam_schedule_user_data.schedule_id = exam_schedules.id AND exam_schedule_user_data.user_id = ".auth()->id.") as exam_user_status";
}

$where = $where ." ". $having;
$baseQuery = "SELECT *, IF(randomize_question=1,'Ya','Tidak') randomize_question, IF(randomize_answer=1,'Ya','Tidak') randomize_answer $additionalColumn FROM $this->table $where ORDER BY ".$col_order." ".$order[0]['dir'];
$db->query = $baseQuery." LIMIT $start,$length";

$data  = $this->db->exec('all');

$this->db->query = $baseQuery;
$total = $this->db->exec('exists');

return compact('data','total');