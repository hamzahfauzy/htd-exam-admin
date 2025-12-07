<?php

use Core\Page;
use Core\Request;
use Core\Utility;
use Core\Database;
use Modules\Crud\Libraries\Repositories\CrudRepository;

$db = new Database;

if(Request::isMethod('POST'))
{
    $inputFileName = $_FILES['member_file']['tmp_name'];
    $group_id = isset($_GET['group_id']) ? $_GET['group_id'] : (isset($_POST['group_id']) ? $_POST['group_id'] : null);

    /**  Identify the type of $inputFileName  **/
    $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
    /**  Create a new Reader of the type that has been identified  **/
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
    /**  Load $inputFileName to a Spreadsheet Object  **/
    $spreadsheet = $reader->load($inputFileName);
    $worksheet   = $spreadsheet->getActiveSheet();
    $highestRow  = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

    for ($row = 2; $row <= $highestRow; $row++) { 
        $name = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
        $group_id = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
        $exam_room = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

        // check user
        if($db->exists('users',[
            'name' => $name
        ]))
        {
            // user exists
            $user = $db->single('users',[
                'name' => $name
            ]);

            $db->update('exam_group_member',[
                'exam_room' => $exam_room
            ],[
                'user_id' => $user->id,
                'group_id' => $group_id
            ]);
        }

    }

    set_flash_msg(['success'=>"Patch peserta berhasil"]);

    header('location:'.routeTo('crud/index',[
        'table' => 'exam_group_member',
        'filter' => [
            'group_id' => $group_id
        ]
    ]));
    die();
}

$filter = [
    'filter' => []
];


$groups = [];
$group_id = null;
if(isset($_GET['group_id']))
{
    $group_id = $_GET['group_id'];
    $filter['filter']['group_id'] = $_GET['group_id'];
}
else
{
    $groups = $db->all('exam_groups');
}

// page section
$title = _ucwords(__("exam.label.import"));
Page::setActive("exam.exam_group_member");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('crud/index', ['table' => 'exam_group_member', $filter]),
        'title' => __('exam.label.exam_group_member')
    ],
    [
        'title' => 'Import'
    ]
]);

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='".asset('assets/crud/js/crud.js')."'></script>");

return view('exam/views/groups/member/import', compact('group_id','groups'));