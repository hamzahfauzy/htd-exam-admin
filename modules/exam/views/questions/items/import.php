<?php get_header() ?>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?= __('exam.label.question_import') ?></p>
        <div class="right-button ms-auto">
            <a href="<?=asset('assets/exam/format-import-soal.xlsx')?>" class="btn btn-primary btn-sm">
                <i class="fa fa-download"></i> <?= __('exam.label.question_format_download') ?>
            </a>
            <a href="<?=routeTo('crud/index',['table' => 'exam_question_items', 'filter' => ['question_id' => $question_id]])?>" class="btn btn-warning btn-sm">
                <?= __('crud.label.back') ?>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group mb-2">
                <label for=""><?= __('exam.label.question_file')?></label>
                <input type="file" name="question_file" id="" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            </div>
            <div class="form-group mb-2">
                <label for=""><?= __('exam.label.image_file')?></label>
                <input type="file" name="image_file[]" multiple id="" class="form-control" accept="image/png, image/gif, image/jpeg">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php get_footer() ?>
