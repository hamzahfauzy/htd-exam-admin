<?php get_header() ?>

<h4>Monitoring</h4>
<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive table-hover table-sales">
            <table class="table table-bordered datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Siswa</th>
                        <th>Aktivitas Terakhir</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($logs as $index => $log): ?>
                    <tr>
                        <td style="width:1%"><?=$index+1?></td>
                        <td><?=$log->user_name?></td>
                        <td><?=$log->last_time?></td>
                        <td>
                            <a href="<?=routeTo('exam/schedules/groups/result-detail', ['schedule_id' => $log->schedule_id, 'user_id'=>$log->user_id])?>" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php get_footer() ?>
