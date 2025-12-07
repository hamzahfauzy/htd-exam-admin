<?php

use Core\Database;
use Core\Page;
use Core\Request;
use Core\Setting;
use Core\Utility;
use Modules\Default\Libraries\Sdk\Media;

$title = __('default.label.settings');
$success_msg = get_flash_msg('success');
$error_msg  = get_flash_msg('error');
$old        = get_flash_msg('old');
$db = new Database();

$parentPath = Utility::parentPath();
$settingFile = $parentPath . 'settings.json';
$fields = [];
$data   = [];
if(file_exists($settingFile))
{
    $fields = json_decode(file_get_contents($settingFile), true);

    foreach($fields as $key => $field)
    {
        if(isset($field['target']) && $field['target'] == 'db')
        {
            $data[$key] = Setting::get($key);
        }
        else
        {
            $data[$key] = env($field['key'], '');
        }
    }


    if(Request::isMethod('POST'))
    {
        $writer = new \MirazMac\DotEnv\Writer($parentPath . '.env');
        foreach($fields as $key => $field)
        {
            $field_value = isset($_POST[$key]) ? $_POST[$key] : $data[$key];
            if($field['type'] == 'file' && isset($_FILES[$key]) && !empty($_FILES[$key]['name']))
            {
                $file = Media::singleUpload($_FILES[$key]);
                $field_value = asset($file->name);
            }
            
            if(isset($field['target']) && $field['target'] == 'db')
            {
                Setting::save($field['key'], $field_value);
            }
            else
            {
                $writer->set($field['key'], $field_value);
            }
        }

        $writer->write();
        set_flash_msg(['success'=>"$title berhasil diupdate"]);

        header('location:'.routeTo('default/settings/index'));
        die();
    }
}

// page section
Page::setActive("default.settings");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'title' => $title
    ]
]);

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<script src="https://cdn.tiny.cloud/1/rsb9a1wqmvtlmij61ssaqj3ttq18xdwmyt7jg23sg1ion6kn/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>');
Page::pushHead("<script>
tinymce.init({
    selector: 'textarea:not(.select2-search__field)',
    relative_urls : false,
  remove_script_host : false,
  convert_urls : true,
  plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
});
</script>");
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;}.select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='".asset('assets/crud/js/crud.js')."'></script>");

Page::pushHook('edit');

return view('default/views/settings/index', compact('fields','error_msg','old','data','success_msg'));