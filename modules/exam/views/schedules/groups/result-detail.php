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
<h4>Nilai : <?=$totalScore?>/<?=count($schedule_user_data->data)?> (<?=($totalScore/count($schedule_user_data->data))*100?>)</h4>
<form method="POST">
<?= csrf_field() ?>
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

            <?php 
            if(empty($data->answers))
            {
                $correction = !isset($normalizeAnswers[$data->id]) || $normalizeAnswers[$data->id]->score == NULL ? $correction*0 : $correction*1;
                echo isset($normalizeAnswers[$data->id]) ? "<b>JAWABAN : </b>".htmlspecialchars_decode($normalizeAnswers[$data->id]->answer_id) . '<br><br>' . ($normalizeAnswers[$data->id]?->score == null ? '<input type="number" class="form-control" name="score['.$data->id.']" value="0" step=".1" min="0" max="1">' : ($normalizeAnswers[$data->id]?->score != '0' ? '<span class="badge bg-success">Skor : '.$normalizeAnswers[$data->id]?->score.'</span>' : '<span class="badge bg-danger">Skor : 0</span>') ) : '';
            }
            else
            {
                echo isset($normalizeAnswers[$data->id]) && $normalizeAnswers[$data->id]?->score ? '<span class="badge bg-success">Benar</span>' : '<span class="badge bg-danger">Salah</span>';
            }
            ?>

        </div>
    </div>
</div>
<?php endforeach ?>

<?php if(!$correction): ?>
<button class="btn btn-primary">Submit</button>
<?php endif ?>

<?php if($schedule_user_data->logs): ?>
<div class="card mb-3 mt-3">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0">Log Aktivitas Peserta</p>
    </div>
    <div class="card-body">
        <?php foreach($schedule_user_data->logs as $log): ?>
        <div style="margin-bottom: 15px;">
            <strong><?=$log->type?></strong> -   
            <small><?=$log->time?></small>
            <p><?=$log->message?></p>
        </div>
        <?php endforeach ?>
    </div>
</div>
<?php endif ?>
</form>

<?php get_footer() ?>
