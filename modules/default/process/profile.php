<?php

use Core\Database;
use Core\Page;
use Core\Request;
use Modules\Default\Libraries\Sdk\Media;

$title = __("default.label.profile");
$db = new Database;
$user = isset($_GET['user_id']) && !empty($_GET['user_id']) ? $db->single('users', ['id' => $_GET['user_id']]) : auth();
$success_msg = get_flash_msg('success');
$error_msg   = get_flash_msg('error');

$files = null;
$mediaTypes = ['KTP','Ijazah','Transkrip','SK Pegawai','SK Dosen Tetap','Sertifikat Pelatihan','Sertifikat Lainnya','SK Jabatan Fungsional'];
if(in_array('organization', explode(',',env('APP_MODULES'))))
{
    if(Request::isMethod('POST'))
    {
        Media::singleUpload($_FILES['file'], $_POST['record_type']);

        set_flash_msg(['success'=>"Berkas berhasil diupload"]);

        header('location:'.routeTo('default/profile'));
        die();
    }
    $files = $db->all('media', [
        'record_type' => ['IN', '("'.implode('","',$mediaTypes).'")'],
        'created_by' => $user->id
    ]);
    
    Page::pushFoot("<script>$('.datatable').dataTable()</script>");
}

Page::setTitle($title);
Page::setActive("default.label.profile");
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'title' => 'Profile'
    ]
]);



return view('default/views/profile', compact('user','files','mediaTypes','error_msg','success_msg'));