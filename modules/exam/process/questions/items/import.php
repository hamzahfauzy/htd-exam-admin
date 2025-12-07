<?php

use Core\Page;
use Core\Request;
use Core\Utility;
use Core\Database;
use Modules\Crud\Libraries\Repositories\CrudRepository;
$question_id = isset($_GET['question_id']) ? $_GET['question_id'] : null;

if(Request::isMethod('POST'))
{
    // upload gambar
    $fileCount = count($_FILES['image_file']['name']);
    $parentPath = Utility::parentPath();
    $storageFolder = $parentPath . 'storage/media/' . $question_id;
    if(!file_exists($storageFolder))
    {
        mkdir($storageFolder, 0777);
    }

    $allFiles = [];
    for ($i = 0; $i < $fileCount; $i++) {
        $namaFile = $_FILES['image_file']['name'][$i];
        $lokasiTmp = $_FILES['image_file']['tmp_name'][$i];
   
        $lokasiBaru = "{$storageFolder}/{$namaFile}";
        move_uploaded_file($lokasiTmp, $lokasiBaru);
        $allFiles[] = $namaFile;
    }

    $db = new Database;
    $inputFileName = $_FILES['question_file']['tmp_name'];

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

    $alphabet = range('A', 'Z');
    for ($row = 2; $row <= $highestRow; $row++) { 
        $description = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
        if(empty($description) || $description == '' || is_null($description)) break;

        foreach($allFiles as $file)
        {
            $fileLocation = asset('storage/'.$question_id.'/'.$file);
            $description = str_replace('{'.$file.'}','<img src="'.$fileLocation.'" width="100%">', $description);
        }
        
        // create question
        $question_item = $db->insert('exam_question_items', [
            'question_id' => $question_id,
            'description' => $description
        ]);

        $answer_score = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

        if($answer_score)
        {
            $correct = array_search($answer_score, $alphabet);
            
            for($ansCol=4;$ansCol<=$highestColumnIndex;$ansCol++)
            {
                $normalizeColumn = $ansCol - 4;
                $answer = $worksheet->getCellByColumnAndRow($ansCol, $row)->getValue();
                if(empty($answer) || $answer == '' || is_null($answer)) continue;
                $answer = htmlspecialchars($answer);
                foreach($allFiles as $file)
                {
                    $fileLocation = asset('storage/'.$question_id.'/'.$file);
                    $description = str_replace('{'.$file.'}','<img src="'.$fileLocation.'" width="100%">', $description);
                    $answer = str_replace('{'.$file.'}','<img src="'.$fileLocation.'" width="100%">', $answer);
                }
                $db->insert('exam_question_answers',[
                    'item_id' => $question_item->id,
                    'description' => $answer,
                    'score' => $normalizeColumn == $correct ? 1 : 0
                ]);
            }
        }
    }

    set_flash_msg(['success'=>"Import soal berhasil"]);

    header('location:'.routeTo('crud/index',[
        'table' => 'exam_question_items',
        'filter' => [
            'question_id' => $question_id
        ]
    ]));
    die();
}

$params = [
    'filter' => []
];

if($question_id)
{
    $params['filter']['question_id'] = $question_id;
}
// page section
$title = _ucwords(__("exam.label.import"));
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

return view('exam/views/questions/items/import', compact('question_id'));