<?php get_header() ?>
<div class="card mt-3">
    <div class="card-body">
        <h1><?=$title?></h1>
        <?php if(is_allowed(parsePath(routeTo('exam/schedules/groups/reset-all')), auth()->id)): ?>
        <a href="<?=routeTo('exam/schedules/groups/reset-all', ['schedule_group_id' => $_GET['schedule_group_id']])?>" class="btn btn-warning mb-2" onclick="if(confirm('Apakah anda yakin akan me-reset semua jawaban peserta ?')){return true}else{return false}">Reset All</a>
        <?php endif ?>
        <a href="<?=routeTo('exam/schedules/groups/export', ['schedule_group_id' => $_GET['schedule_group_id']])?>" class="btn btn-primary mb-2" target="_blank">Cetak</a>
        <div class="table-hover table-sales">
            <table class="table table-striped datatable" style="width:100%">
                <thead>
                    <tr>
                        <th width="20px">#</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                        <th>Potensi Kecurangan</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $badges = ['Tidak Curang' => 'bg-secondary', 'Rendah' => 'bg-success', 'Sedang' => 'bg-warning', 'Tinggi' => 'bg-danger', 'Sangat Tinggi' => 'bg-danger'];
                    foreach($member as $index => $user): 
                        $cheating = detectCheating($user->logs ? json_decode($user->logs,1) : []);
                    ?>
                    <tr>
                        <td><?=$index+1?></td>
                        <td><?=$user->name?></td>
                        <td><?=$user->final_score?ceil($user->final_score):'<i>Belum ada nilai</i>'?></td>
                        <td class="text-nowrap"><span class="badge <?=$badges[$cheating['risk_level']]?>"><?=$cheating['risk_level']?></span></td>
                        <td><?=$user->status??'-'?></td>
                        <td>
                            <?php if($user->status): ?>
                                <a href="<?=routeTo('exam/schedules/groups/result-detail',['user_id' => $user->id, 'schedule_id' => $user->schedule_id])?>" class="btn btn-info"><i class="fa fa-eye"></i> Detail</a>
                                <?php if(is_allowed(parsePath(routeTo('exam/schedules/groups/reset')), auth()->id)): ?>
                                <a href="<?=routeTo('exam/schedules/groups/reset',['user_id' => $user->id, 'schedule_id' => $user->schedule_id])?>" class="btn btn-warning" onclick="if(confirm('Apakah anda yakin akan mereset ujian pada siswa ini ?')){ return true }else{ return false }">Reset</a>
                                <?php endif ?>
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php get_footer() ?>
