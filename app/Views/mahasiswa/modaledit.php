<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?= form_open('mahasiswa/updatedata', ['class' => 'formmahasiswa'])?>
      <!-- autenfikasi menjaga serangan injeksi -->
      <?= csrf_field(); ?>

      <div class="modal-body">

        <div class="form-group row">
            <label for="nim049" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
                <input type="hidden" class="form-control is-valid" id="id_mahasiswa049" name="id_mahasiswa049" 
                placeholder="Masukkan NIM" value="<?= $id_mahasiswa049 ?>" readonly>
                <input type="text" class="form-control is-valid" id="nim" name="nim" 
                placeholder="Masukkan NIM" value="<?= $nim049 ?>" readonly>
                <div class="valid-feedback errornim"></div>
            </div>
        </div>

        <div class="form-group row">
            <label for="nama049" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
                <input type="text" class="form-control is-valid" id="nama" name="nama" 
                placeholder="Masukkan Nama Lengkap" value="<?= $nama049 ?>">
                <div class="valid-feedback errornama"></div>
            </div>
        </div>

        <div class="form-group row">
            <label for="tmplahir049" class="col-sm-2 col-form-label">Tempat & Tanggal Lahir</label>
            <div class="col-sm-5">
                <input type="text" class="form-control is-valid" id="tmplahir" name="tmplahir" 
                placeholder="Masukkan Tempat Lahir" value="<?= $tmplahir049 ?>">
                <div class="valid-feedback errortmplahir"></div>
            </div>
            <div class="col-sm-5">
                <input type="date" class="form-control is-valid" id="tgllahir" name="tgllahir" 
                placeholder="Masukkan Tanggal Lahir" value="<?= $tgllahir049 ?>">
                <div class="valid-feedback errortgllahir"></div>
              </div>
        </div>

        <div class="form-group row">
            <label for="jenkel049" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <select name="jenkel" id="jenkel" class="form-control is-valid">
                <option value="L" <?php if ($jenkel049 == 'L') echo"selected"; ?>>Laki-Laki</option>
                <option value="P" <?php if ($jenkel049 == 'P') echo"selected"; ?>>Perempuan</option>
              </select>
              <div class="valid-feedback errorjenkel"></div>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      <?= form_close()?>
    </div>
  </div>
</div>

<div class="position-fixed align-items-center" style="position : absolute; top: 50%; left: 50%;">
<div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
<div class="toast-header">
  <strong class="mr-auto">Simpan</strong>
  <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-Label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="toast-body">Data Berhasil di Simpan!!</div>
</div>
</div>

<script>
  $(document).ready(function(){
    $('.formmahasiswa').submit(function(e){
      e.preventDefault();
      $.ajax({
        type: "post",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",
        beforeSend: function(){
          $('.btnsimpan').attr('disable', 'disabled');
          $('.btnsimpan').html('<i class="bi bi-arrow-repeat"></i>');
        },
        complete: function(){
          $('.btnsimpan').removeAttr('disable');
          $('.btnsimpan').html('Simpan');
        },
        success: function(response){
              Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: response.sukses,
              });
              //tutup modal edit
              $('#modaledit').modal('hide');
              //panggil fungsi data mahasiswa pada viewtampildata
              datamahasiswa();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });
  });
</script>