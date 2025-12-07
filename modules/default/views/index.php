<?php get_header() ?>
<div class="mt-3">
    <h4>Selamat Datang <?=auth()->name?></h4>

    <?= \Modules\Default\Libraries\Sdk\Dashboard::render() ?>
</div>
<?php get_footer() ?>