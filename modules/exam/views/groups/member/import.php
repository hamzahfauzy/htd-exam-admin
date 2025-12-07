<?php get_header() ?>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?= __('exam.label.member_import') ?></p>
        <div class="right-button ms-auto">
            <a href="<?=asset('assets/exam/format-import-peserta.xlsx')?>" class="btn btn-primary btn-sm">
                <i class="fa fa-download"></i> <?= __('exam.label.member_format_download') ?>
            </a>
            <a href="<?=routeTo('crud/index',['table' => 'exam_group_member', 'filter' => ($group_id ? ['group_id' => $group_id] : [])])?>" class="btn btn-warning btn-sm">
                <?= __('crud.label.back') ?>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <?php if(!empty($groups)): ?>
            <div class="form-group mb-2">
                <label for=""><?= __('exam.label.group')?></label>
                <select name="group_id" id="" class="form-control select2" required>
                    <option value="">Pilih</option>
                    <?php foreach($groups as $group): ?>
                    <option value="<?=$group->id?>"><?=$group->name?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <?php endif ?>
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
