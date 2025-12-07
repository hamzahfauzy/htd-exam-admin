<?php get_header() ?>
<style>
table td img {
    max-width:150px;
}
</style>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>
        <div class="right-button ms-auto">
            
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <tr>
                <td rowspan="2" width="250px">
                    <img src="<?=asset('assets/default/img/user-default.png')?>" alt="" width="250px">
                </td>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td width="150px">Nama</td>
                            <td width="20px">:</td>
                            <td><?=$user->name?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>:</td>
                            <td><?=$user->username?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>

<?php if(is_array($files)): ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Uplaod</h5>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group mb-3">
                <label for="" class="mb-2">File</label>
                <input type="file" class="form-control" name="file">
            </div>
            <div class="form-group mb-3">
                <label for="" class="mb-2">Tipe</label>
                <select name="record_type" id="" class="form-control">
                    <?php foreach($mediaTypes as $type): ?>
                    <option value="<?=$type?>"><?=$type?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0">Berkas</p>

        <?php if(auth()->id == $user->id): ?>
        <div class="right-button ms-auto">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Upload Berkas
            </button>
        </div>
        <?php endif ?>
    </div>
    <div class="card-body">
        <div class="table-responsive table-hover">
            <table class="table table-bordered datatable" style="width:100%">
                <thead>
                    <tr>
                        <th width="20px">#</th>
                        <th>File</th>
                        <th>Tipe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($files as $index => $file): ?>
                    <tr>
                        <td><?=$index+1?></td>
                        <td><a href="<?=asset($file->name)?>">Lihat File</a></td>
                        <td><?=$file->record_type?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif ?>
<?php get_footer() ?>
