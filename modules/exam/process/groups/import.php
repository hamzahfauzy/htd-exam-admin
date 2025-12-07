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

    $groups = $db->all('exam_groups');
    $groupMap = [];
    foreach($groups as $group)
    {
        $groupMap[$group->name] = $group;
    }

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
        $username = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
        $password = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
        $group_name = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
        $group = $groupMap[$group_name];
        $group_id = $group->id;
        $exam_room = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
        $exam_room = !empty($exam_room) ? $exam_room : 1;

        if(empty($name) || $name == '' || is_null($name)) break;

        // check user
        if($db->exists('users',[
            'username' => $username
        ]))
        {
            // user exists
            $user = $db->single('users',[
                'username' => $username
            ]);
            // check exam group member
            if($db->exists('exam_group_member',[
                'user_id' => $user->id,
                'group_id' => $group_id
            ]))
            {
                $db->update('exam_group_member',[
                    'exam_room' => $exam_room
                ],[
                    'user_id' => $user->id,
                    'group_id' => $group_id
                ]);
            }
            else
            {
                $db->insert('exam_group_member',[
                    'user_id' => $user->id,
                    'group_id' => $group_id,
                    'exam_room' => $exam_room
                ]);
            }
        }
        else
        {
            // create users
            $user = $db->insert('users', [
                'name' => $name,
                'username' => $username,
                'password' => md5($password),
            ]);

            $db->insert('user_roles', [
                'user_id' => $user->id,
                'role_id' => env('EXAM_MEMBER_ROLE_ID')
            ]);
            
            $db->insert('exam_group_member',[
                'user_id' => $user->id,
                'group_id' => $group_id,
                'exam_room' => $exam_room
            ]);
        }
        

    }

    set_flash_msg(['success'=>"Import peserta berhasil"]);

    header('location:'.routeTo('crud/index',[
        'table' => 'exam_groups',
    ]));
    die();
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
        'title' => 'Import Group'
    ]
]);

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='".asset('assets/crud/js/crud.js')."'></script>");

return view('exam/views/groups/member/import');