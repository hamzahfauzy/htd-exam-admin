<?php

$params = [];
if(isset($_GET['filter']) && isset($_GET['filter']['question_id']))
{
    $params['question_id'] = $_GET['filter']['question_id'];
}
return '<a href="'.routeTo('exam/questions/items/import',$params).'" class="btn btn-sm btn-primary"><i class="fas fa-upload"></i> '.__('exam.label.import').'</a> 
<a href="'.routeTo('exam/questions/items/bulk-text',$params).'" class="btn btn-sm btn-primary"><i class="fas fa-file"></i> '.__('exam.label.bulk_text').'</a>
<a href="'.routeTo('exam/questions/preview',['id' => $_GET['filter']['question_id']]).'" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> '.__('exam.label.preview').'</a>';