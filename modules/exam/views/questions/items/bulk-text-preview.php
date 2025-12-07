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
<?php foreach($parsed as $index => $item): ?>
<div class="card mb-3">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0">Soal No. <?=$index+1?></p>
    </div>
    <div class="card-body">
        <p><?=$item['description']?></p>
        <div class="answers">
            <ul>
                <?php foreach($item['answers'] as $key => $answer): ?>
                <li>
                    <div style="display:flex;flex-direction: row-reverse;align-items:center">
                        <input type="radio" <?= $answer['score'] ? 'checked' : ''?>>
                        <label>
                            <?=$answer['description']?>
                        </label>
                        <span class="me-3 cursor-pointer">
                            <?=$key?>
                        </span>
                    </div>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>
<?php endforeach ?>

<form action="" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="submit" value="save">
    <input type="hidden" name="num_of_options" value="<?=$num_of_options?>">
    <textarea name="text" class="form-control" style="opacity:0"><?=$text?></textarea>
    <div class="form-group">
        <button class="btn btn-primary">Submit</button>
    </div>
</form>

<?php get_footer() ?>
