<title>Kartu Ujian <?=$member[0]->group_name?></title>
<style>
* {
    font-family: arial;
    margin:0;
    padding:0;
    font-size:12px;
}
.card-container {
    display: flex;
    flex-wrap: wrap;
}

.card-item {
    width: 100%;
    box-sizing: border-box;
}

.card-content {
    padding:20px;
}

table tr td {
    padding: 5px;
}

@media print {
    .card-item {
    page-break-inside: avoid;
    break-inside: avoid;
  }

  .card-container {
    page-break-inside: avoid;
  }
  
  @page {
    size: 210mm 330mm; /* Ukuran F4 */
    margin: 10mm;       /* Sesuaikan margin */
  }
}
</style>
<div class="card-container">
    <div class="card-item">
        <div class="card-content">
            <h1 align="center" style="margin-bottom: 8px"><u>AKUN CBT</u></h1>
            <table cellpadding="5" cellspacing="0" border="1" width="100%" align="center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Ruangan</th>
                    <th>Username</th>
                    <th>Password</th>
                </tr>
                <?php foreach($member as $index => $_member): ?>
                <tr>
                    <td><?=$index+1?></td>
                    <td><?= $_member->name?></td>
                    <td><?= $_member->group_name?></td>
                    <td><?= $_member->exam_room?></td>
                    <td><?= $_member->username?></td>
                    <td><?= $passwords[$_member->user_id] ?></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
<script>
window.print()
</script>