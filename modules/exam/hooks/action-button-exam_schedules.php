<?php

use Core\Request;

$isApiRoute = Request::$isApiRoute;
$role = get_role(auth()->id);
$button = $isApiRoute ? [] : "";
$doUrl = routeTo('exam/do',['schedule_id' => $data->id]);
$groupUrl = routeTo('crud/index',['table'=>'exam_schedule_groups','filter'=>['schedule_id' => $data->id]]);
$questionUrl = routeTo('crud/index',['table'=>'exam_schedule_questions','filter'=>['schedule_id' => $data->id]]);
$generateUrl = routeTo('exam/schedules/generate',['schedule_id' => $data->id]);
$generateTokenUrl = routeTo('exam/schedules/generate-token',['schedule_id' => $data->id]);

if(is_allowed(parsePath(routeTo('exam/do')), auth()->id) && $role->role_id == env('EXAM_MEMBER_ROLE_ID'))
{
    $start_at   = strtotime($data->start_at);
    $end_at     = strtotime($data->end_at);
    $now        = strtotime('now');
    $notStarted = $now < $start_at;
    $finished   = $data->is_answered;
    $isDone     = $data->exam_user_status == 'DONE';
    if($notStarted)
    {
        if($isApiRoute)
        {
            $button[] = [
                'name'   => 'action',
                'label'  => 'Belum Mulai',
                'route'  => null,
                'params' => null
            ];
        }
        else
        {
            $button .= 'Belum Mulai';
        }
    }
    else if($finished)
    {
        if($isApiRoute)
        {
            $button[] = [
                'name'   => 'action',
                'label'  => __('exam.label.result'),
                'route'  => 'exam/result',
                'params' => ['id'=>$data->id]
            ];
        }
        else
        {
            $button .= '<a href="'.routeTo('exam/result',['id'=>$data->id]).'" class="btn btn-sm btn-primary">'.__('exam.label.result').'</a> ';
        }
    }
    else if($isDone || $finished)
    {
        if($isApiRoute)
        {
            $button[] = [
                'name'   => 'action',
                'label'  => 'Ujian Telah Selesai',
                'route'  => null,
                'params' => null
            ];
        }
        else
        {
            $button .= 'Ujian Telah Selesai';
        }
    }
    else
    {
        if($isApiRoute)
        {
            $button[] = [
                'name'   => 'action',
                'label'  => __('exam.label.do'),
                'route'  => 'exam/do',
                'params' => ['schedule_id' => $data->id]
            ];
        }
        else
        {
            $button .= '<a href="'.$doUrl.'" class="btn btn-sm btn-primary" onclick="return validateToken(this)" data-token='.$data->token.'>'.__('exam.label.do').'</a> ';
        }
    }
}

if(is_allowed(parsePath(routeTo('crud/index',['table'=>'exam_schedule_groups'])), auth()->id))
{
    if($isApiRoute)
    {
        $button[] = [
            'name'   => 'group',
            'label'  => __('exam.label.group'),
            'route'  => 'crud/index',
            'params' => ['table'=>'exam_schedule_groups','filter'=>['schedule_id' => $data->id]]
        ];
    }
    else
    {
        $button .= '<a href="'.$groupUrl.'" class="btn btn-sm btn-info"> '.__('exam.label.group').'</a> ';
    }
}

if(is_allowed(parsePath($questionUrl), auth()->id))
{
    if($isApiRoute)
    {
        $button[] = [
            'name'   => 'question',
            'label'  => __('exam.label.exam_question'),
            'route'  => 'crud/index',
            'params' => ['table'=>'exam_schedule_questions','filter'=>['schedule_id' => $data->id]]
        ];
    }
    else
    {
        $button .= '<a href="'.$questionUrl.'" class="btn btn-sm btn-primary"> '.__('exam.label.exam_question').'</a> ';
    }
    
}

if(is_allowed(parsePath($generateUrl), auth()->id))
{
    if($isApiRoute)
    {
        $button[] = [
            'name'   => 'generate',
            'label'  => __('exam.label.generate'),
            'route'  => 'exam/schedules/generate',
            'params' => ['schedule_id' => $data->id]
        ];
    }
    else
    {
        // if(isset($_GET['generate']))
        // {
            $button .= '<a href="'.$generateUrl.'" class="btn btn-sm btn-secondary" onclick="if(confirm(\'Tombol ini akan menghapus data soal yang sudah digenerate. Apakah anda yakin ?\')){return true}else{return false}"> '.__('exam.label.generate').'</a> ';
        // }
    }
}

if(is_allowed(parsePath($generateTokenUrl), auth()->id))
{
    if($isApiRoute)
    {
        $button[] = [
            'name'   => 'generate_token',
            'label'  => __('exam.label.generate token'),
            'route'  => 'exam/schedules/generate-token',
            'params' => ['schedule_id' => $data->id]
        ];
    }
    else
    {
        $button .= '<a href="'.$generateTokenUrl.'" class="btn btn-sm btn-primary"> '.__('exam.label.generate token').'</a> ';
    }

}

return $button;