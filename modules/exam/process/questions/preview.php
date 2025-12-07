<?php

use Core\Page;
use Core\Database;

$id = $_GET['id'];
$db = new Database;

$question = $db->single('exam_questions',[
    'id' => $id
]);

$items = $db->all('exam_question_items',[
    'question_id' => $id
]);

$items = array_map(function($item) use ($db){
    $item->answers = $db->all('exam_question_answers', [
        'item_id' => $item->id
    ]);

    return $item;
}, $items);

// page section
$title = _ucwords(__("exam.label.preview")) .' - '.$question->name;
Page::setActive("exam.exam_questions");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('crud/index', ['table' => 'exam_questions']),
        'title' => __('exam.label.question')
    ],
    [
        'title' => 'Preview'
    ]
]);

return view('exam/views/questions/preview', compact('items'));