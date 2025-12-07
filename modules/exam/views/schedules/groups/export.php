<h2 align="center">Hasil <?=$schedule->name?> - <?=$group->name?></h2>
<table class="table table-bordered" style="width:100%" border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th width="20px">#</th>
            <th>Nama</th>
            <th>Nilai</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($member as $index => $user): ?>
        <tr>
            <td><?=$index+1?></td>
            <td><?=$user->name?></td>
            <td><?=$user->final_score?ceil($user->final_score):'<i>Belum ada nilai</i>'?></td>
            <td><?=$user->status??'-'?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<script>
window.print()
</script>