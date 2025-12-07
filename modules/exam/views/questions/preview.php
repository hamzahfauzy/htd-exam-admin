<?php get_header() ?>
<style>
.card-body img {
    max-width:450px;
    height: auto;
    display:block;
    margin-top:10px;
}
.answers ul, .answers li {
    list-style-type: none;
    margin:0;
    padding:0;
}

.answers li label {
    display:block;
    width:100%;
    padding-top:5px;
    padding-bottom:5px;
}

/* input[type="radio"]:checked+label { font-weight: bold; color: green !important; } */
input[type="radio"] ~ span {
    border-radius: 50%;
    padding: 5px;
    height: 25px;
    width: 25px;
    line-height: 14px;
    background: #FFF;
    text-align: center;
    font-weight:bold;
}
input[type="radio"]:checked ~ span { 
    font-weight: bold;
    color: #FFF;
    background: green;
}
/* input[type="radio"]:checked ~ label { 
    font-weight: bold;
    color: #FFF;
    background: green;
} */
input[type="radio"] {
    margin-right: -10px;
    opacity: 0;
}
</style>
<?php foreach($items as $index => $item): ?>
<div class="card mb-3">
    <div class="card-header d-flex flex-grow-1 align-items-center justify-content-between">
        <p class="h4 m-0">Soal No. <?=$index+1?></p>
        <a href="<?= routeTo('crud/edit', ['table' => 'exam_question_items', 'id' => $item->id, 'filter' => ['question_id' => $item->question_id]]) ?>" class="btn btn-success btn-sm">Edit</a>
    </div>
    <div class="card-body">
        <p><?=$item->description?></p>
        <div class="answers">
            <ul>
                <?php foreach($item->answers as $key => $answer): ?>
                <li>
                    <div style="display:flex;flex-direction: row-reverse;align-items:center">
                        <input type="radio" <?= $answer->score ? 'checked' : ''?>>
                        <label>
                            <?=$answer->description?>
                        </label>
                        <span class="me-3 cursor-pointer">
                            <?=chr($key+65)?>
                        </span>
                    </div>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>
<?php endforeach ?>

<?php get_footer() ?>
