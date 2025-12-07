<style>
* {
    font-family: arial;
    font-size:12px;
}

.card-container {
    max-width: 1000px;
    margin:auto;
}

.card-content {
    padding:20px;
}
</style>
<div class="card-container">
    <div class="card-item">
        <div class="card-content">
            <h2 align="center">
                <?= getSetting('exam_print_header_text') ?>
            </h2>
            <table cellpadding="0">
                <tr>
                    <td>Nama Sekolah</td>
                    <td>:</td>
                    <td><?=getSetting('application_name')?></td>
                </tr>
                <tr>
                    <td>Hari</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><?=$member[0]->group_name?></td>
                </tr>
                <tr>
                    <td>Mata Pelajaran</td>
                    <td>:</td>
                    <td></td>
                </tr>
            </table>
            <table cellpadding="5" cellspacing="0" width="100%" align="center" border="1" style="margin:0">
                <tr>
                    <th width="20px">NO</th>
                    <th width="50px">NIS</th>
                    <th width="200px">NAMA</th>
                    <th colspan="2">TANDA TANGAN</th>
                    <th width="50px">KET</th>
                </tr>
                <?php foreach($member as $no => $_member): ?>
                <tr>
                    <td><?=$no+1?></td>
                    <td><?=$_member->username?></td>
                    <td><?=$_member->name?></td>
                    <td><?=$no%2==0?($no+1).'.':''?></td>
                    <td><?=$no%2!=0?($no+1).'.':''?></td>
                    <td></td>
                </tr>
                <?php endforeach ?>
            </table>

            <div style="width:300px;margin-left:auto;text-align:center;margin-top:50px;">
            <b>DIKETAHUI</b><br>
            <b>PENGAWAS</b>
            <br><br>
            <br><br>
            __________________________
            </div>
        </div>
    </div>
</div>
<script>
window.print()
</script>