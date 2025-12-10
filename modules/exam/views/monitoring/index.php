<?php get_header() ?>

<h4>Monitoring</h4>
<div class="card mb-3">
    <div class="card-body">
        <div class="table-hover table-sales overflow-hidden">
            <table class="table table-striped datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Siswa</th>
                        <th>Aktivitas Terakhir</th>
                        <th>Potensi Kecurangan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $badges = ['Tidak Curang' => 'bg-secondary', 'Rendah' => 'bg-success', 'Sedang' => 'bg-warning', 'Tinggi' => 'bg-danger', 'Sangat Tinggi' => 'bg-danger'];
                    foreach($logs as $index => $log): 
                        $cheating = detectCheating(json_decode($log->logs,1));
                    ?>
                    <tr>
                        <td style="width:1%"><?=$index+1?></td>
                        <td class="text-nowrap"><?=$log->user_name?></td>
                        <td class="text-nowrap"><?=$log->last_time?></td>
                        <td class="text-nowrap"><span class="badge <?=$badges[$cheating['risk_level']]?>"><?=$cheating['risk_level']?></span></td>
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
