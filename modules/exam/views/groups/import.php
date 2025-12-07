<?php get_header() ?>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?= __('exam.label.member_import') ?></p>
        <div class="right-button ms-auto">
            <a href="<?=asset('assets/exam/format-import-group.xlsx')?>" class="btn btn-primary btn-sm">
                <i class="fa fa-download"></i> <?= __('exam.label.group_format_download') ?>
            </a>
            <a href="<?=routeTo('crud/index',['table' => 'exam_groups'])?>" class="btn btn-warning btn-sm">
                <?= __('crud.label.back') ?>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group mb-2">
                <label for=""><?= __('exam.label.member_file')?></label>
                <input type="file" name="member_file" id="" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php get_footer() ?>
