<?php get_header() ?>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?= __('exam.label.bulk_text') ?></p>
        <div class="right-button ms-auto">
            <a href="<?=routeTo('crud/index',['table' => 'exam_question_items', 'filter' => ['question_id' => $question_id]])?>" class="btn btn-warning btn-sm">
                <?= __('crud.label.back') ?>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="submit" value="preview">
            <div class="form-group mb-2">
                <label for="">Num of Options</label>
                <input type="number" name="num_of_options" class="form-control" value="5">
            </div>
            <div class="form-group mb-2">
                <label for="">Text</label>
                <textarea name="text" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Preview</button>
            </div>
        </form>
    </div>
</div>

<?php get_footer() ?>
