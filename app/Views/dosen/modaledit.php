<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit dosen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?= form_open('dosen/updatedata', ['class' => 'formdosen'])?>
      <!-- autenfikasi menjaga serangan injeksi -->
      <?= csrf_field(); ?>

      <div class="modal-body">

        <div class="form-group row">
            <label for="nidn" class="col-sm-2 col-form-label">NIDN</label>
            <div class="col-sm-10">
                <input type="hidden" class="form-control is-valid" id="id_dosen" name="id_dosen" 
                placeholder="Masukkan NIDN" value="<?= $id_dosen ?>" readonly>
                <input type="text" class="form-control is-valid" id="nidn" name="nidn" 
                placeholder="Masukkan NIDN" value="<?= $nidn ?>" readonly>
                <div class="valid-feedback errornidn"></div>
            </div>
        </div>

        <div class="form-group row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
                <input type="text" class="form-control is-valid" id="nama" name="nama" 
                placeholder="Masukkan Nama Lengkap" value="<?= $nama ?>">
                <div class="valid-feedback errornama"></div>
            </div>
        </div>

        <div class="form-group row">
            <label for="tmplahir" class="col-sm-2 col-form-label">Tempat & Tanggal Lahir</label>
            <div class="col-sm-5">
                <input type="text" class="form-control is-valid" id="tmplahir" name="tmplahir" 
                placeholder="Masukkan Tempat Lahir" value="<?= $tmplahir ?>">
                <div class="valid-feedback errortmplahir"></div>
            </div>
            <div class="col-sm-5">
                <input type="date" class="form-control is-valid" id="tgllahir" name="tgllahir" 
                placeholder="Masukkan Tanggal Lahir" value="<?= $tgllahir ?>">
                <div class="valid-feedback errortgllahir"></div>
              </div>
        </div>

        <div class="form-group row">
            <label for="jenkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <select name="jenkel" id="jenkel" class="form-control is-valid">
                <option value="L" <?php if ($jenkel == 'L') echo"selected"; ?>>Laki-Laki</option>
                <option value="P" <?php if ($jenkel == 'P') echo"selected"; ?>>Perempuan</option>
              </select>
              <div class="valid-feedback errorjenkel"></div>
            </div>
        </div>

        <div class="form-group row">
            <label for="jabatan" class="col-sm-2 col-form-label">jabatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control is-valid" id="jabatan" name="jabatan" 
                placeholder="Masukkan jabatan Lengkap" value="<?= $jabatan ?>">
                <div class="valid-feedback errorjabatan"></div>
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
    $('.formdosen').submit(function(e){
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
              //panggil fungsi data dosen pada viewtampildata
              datadosen();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });
  });
</script>