<?php get_header() ?>
<style>
.card-body img {
    max-width:300px;
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
<h4>Nilai : <?=($totalScore/count($schedule_user_data->data))*100?></h4>
<?php foreach($schedule_user_data->data as $index => $data): ?>
<div class="card mb-3">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0">Soal No. <?=$index+1?></p>
    </div>
    <div class="card-body">
        <p><?=$data->description?></p>
        <div class="answers">
            <ul>
                <?php foreach($data->answers as $key => $answer): ?>
                <li>
                    <div style="display:flex;flex-direction: row-reverse;align-items:center">
                        <input type="radio" id="asnwer_<?=$data->id?>_<?=$answer->id?>" <?= isset($normalizeAnswers[$data->id]) && $answer->id == $normalizeAnswers[$data->id]->answer_id ? 'checked' : '' ?> disabled>
                        <label for="answer_<?=$data->id?>_<?=$answer->id?>">
                            <?=$answer->description?>
                        </label>
                        <span class="me-3 cursor-pointer"  onclick="document.querySelector('#answer_<?=$data->id?>_<?=$answer->id?>').click()">
                            <?=chr($key+65)?>
                        </span>
                    </div>
                </li>
                <?php endforeach ?>
            </ul>

            <?= isset($normalizeAnswers[$data->id]) && $normalizeAnswers[$data->id]->score ? '<span class="badge bg-success">Benar</span>' : '<span class="badge bg-danger">Salah</span>' ?>
        </div>
    </div>
</div>
<?php endforeach ?>

<?php get_footer() ?>
