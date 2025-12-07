<?php

use Core\Page;
use Core\Request;
use Core\Utility;
use Core\Database;
use Modules\Crud\Libraries\Repositories\CrudRepository;
$question_id = isset($_GET['question_id']) ? $_GET['question_id'] : null;

if(Request::isMethod('POST'))
{
    $text = $_POST['text'];
    $num_of_options = $_POST['num_of_options'];
    $parsed = parseSoal($text, $num_of_options);
    
    if($_POST['submit'] == 'preview')
    {
        Page::setActive("exam.exam_question_items");
        Page::setTitle('Preview');

        return view('exam/views/questions/items/bulk-text-preview', compact('question_id', 'text', 'parsed','num_of_options'));
    }
    else
    {
        $db = new Database;
        foreach($parsed as $index => $item)
        {
            // create question
            $question_item = $db->insert('exam_question_items', [
                'question_id' => $question_id,
                'description' => $item['description']
            ]);

            foreach($item['answers'] as $key => $answer)
            {
                $db->insert('exam_question_answers',[
                    'item_id' => $question_item->id,
                    'description' => $answer['description'],
                    'score' => $answer['score'] ? 1 : 0
                ]);
            }
        }

        set_flash_msg(['success'=>"Bulk from text berhasil"]);

        header('location:'.routeTo('crud/index',[
            'table' => 'exam_question_items',
            'filter' => [
                'question_id' => $question_id
            ]
        ]));
        die();
    }
}

$params = [
    'filter' => []
];

if($question_id)
{
    $params['filter']['question_id'] = $question_id;
}
// page section
$title = _ucwords(__("exam.label.bulk_text"));
Page::setActive("exam.exam_question_items");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('crud/index', ['table' => 'exam_question_items', $params]),
        'title' => __('exam.label.exam_question_items')
    ],
    [
        'title' => 'Import'
    ]
]);

return view('exam/views/questions/items/bulk-text', compact('question_id'));