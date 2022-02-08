  <style type="text/css">
    div.dt-top-container2 {
  display: grid;
  grid-template-columns: auto auto auto;
}

div.dt-center-in-div2 {
  margin: 0 auto;
}

div.dt-filter-spacer2 {
  margin: 10px 0;
}
  </style>
<br>
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pserta</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form id="form-filter">
                <div class="form-row align-items-center">
                      <div class="col-sm-3" >
                        <label>Pilih Event :</label>
                        <div class="text-center">
                        <select class="form-control text-center" data-live-search="true" name="eventSearch" id="eventSearch">
                          <option value="" selected disabled>--- Pilih Event ---</option>
                          <!-- <option value="" >All Data</option> -->
                          <?php foreach ($dataEvent as $key) { ?>
                            <option value="<?php echo $key->idx; ?>"><?php echo $key->name_event; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      </div>
                      <div class="col-sm-3" >
                        <label>Pilih Bidang :</label>
                        <div class="text-center">
                        <select class="form-control text-center" data-live-search="true" name="bidangSearch" id="bidangSearch">
                          <option value="" selected disabled>--- Pilih Bidang ---</option>
                          <!-- <option value="" >All Data</option> -->
                          <?php foreach ($dataBidang as $key) { ?>
                            <option value="<?php echo $key->id_slug; ?>"><?php echo $key->nama_bidang; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      </div>
                      <div class="col-sm-3" >
                        <label>Pilih Rentang Tanggal :</label>
                        <input   class="form-control" name="rentangTanggal">
                      </div>
                      <div class="col-sm-3 mt-4" >
                        <label></label>
                        <a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="cari()"><i class="fas fa-search-plus"></i> Search</a>

                        <!-- <a href="" class="btn btn-sm btn-danger"><i class="fas fa-search-plus"></i> Reset</a> -->
                      </div>
                  </div>
              </form>
              <br>
              <hr>
              <br>
                <table id="tabelPeserta" class="table table-bordered table-hover table-sm">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Bidang</th>
                    <th>Provinsi</th>
                    <th>Kab/Kota</th>
                    <th>Instansi</th>
                    <th>Email</th>
                    <th>No Telfon</th>
                    <th>Nama Event</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <!-- <tfoot>
                  <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Bidang</th>
                    <th>Provinsi</th>
                    <th>Kab/Kota</th>
                    <th>Instansi</th>
                    <th>Email</th>
                    <th>No Telfon</th>
                    <th>Nama Event</th>
                  </tr>
                  </tfoot> -->
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Bidang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formTambah">
            <div class="form-group">
              <label for="namaBidang" class="col-form-label">Nama Bidang:</label>
              <input type="text" class="form-control" name="namaBidang" id="namaBidang">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-success" onclick="save()">Save</button>
        </div>
      </div>
    </div>
  </div>

    <!-- End Moadl Tambah -->

<!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formEdit">
            <div class="form-group">
              <label for="namabidang2" class="col-form-label">Nama Bidang:</label>
              <input type="text" class="form-control" name="namaBidang" id="namabidang2">
              <input type="hidden" name="id_slug" id="id_slug">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-success" onclick="saveEdit()">Save</button>
        </div>
      </div>
    </div>
  </div>

    <!-- End Moadl Tambah -->



<script type="text/javascript">
$( document ).ready(function() {

cari = function() {
      tabelPeserta.ajax.reload();
}

showModal = function (){

  $('#modalTambah').modal('show');
}

// Proses Tambah Data
save = function (){
  
    $.ajax({
        url: base_url()+'C_bidang/save',
        type: "post",
        data: $("#formTambah").serialize(),
        success: function (res) {
       
        reset();
        success('SUCCESS', 'Data Disimpan');
        $('#modalTambah').modal('hide');
        tabelBidang.ajax.reload();
        
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
           error('Error', 'Ada yang Error Silahkan Hubungi Developer')
        }
    });

}

saveEdit = function(){

  $.ajax({
        url: base_url()+'C_bidang/update',
        type: "post",
        data: $("#formEdit").serialize(),
        success: function (res) {

        success('SUCCESS', 'Data Berhasil Disimpan');
        $('#modalEdit').modal('hide');
        tabelBidang.ajax.reload();
        
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
           error('Error', 'Ada yang Error Silahkan Hubungi Developer')
        }
    });

}

hapusData = function (slg_id){

  Swal.fire({
    title: 'Anda yakin ingin menghapus data ini?',
    text: "Data yang telah dihapus tidak akan bisa dikembalikan",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya hapus!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: base_url()+'C_bidang/delete',
        type: "post",
        dataType: 'json',
        data: {id_slug:slg_id} ,
      success: function (res) {
      if(res.code == 200){
        tabelBidang.ajax.reload();
        success('SUCCESS', res.massage);
      }

      if (res.code == 401) {
        error('Gagal', res.massage);
      }
      
      },
      error: function(jqXHR, textStatus, errorThrown) {
      
           console.log(textStatus, errorThrown);
           error('Error', 'Ada yang Error Silahkan Hubungi Developer')
      }
    });
    }
  })

}

editData = function (slg_id){
$("#selesai2").show();
$("#waktuAkhirInput2").hide();

$.ajax({
        url: base_url()+'C_bidang/getById',
        type: "post",
        dataType: 'json',
        data: {slug_id:slg_id},
        success: function (res) {
        console.log(res);
        
        $('#namabidang2').val(res.nama_bidang);
        $('#id_slug').val(res.id_slug);
        $('#modalEdit').modal('show');
         
        
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
           error('Error', 'Ada yang Error Silahkan Hubungi Developer')
        }
});

}


function reset(){
  $('#namabidang').val('');

}

});
</script>

