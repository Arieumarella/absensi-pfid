 
<br>
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Event</h3>
                <a href="#" class="btn btn-success btn-sm" onclick="showModal();" style="float: right;"><i class="fas fa-plus"></i> <b>Tambah Data</b></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabelevent" class="table table-bordered table-hover table-sm">
                  <thead>
                  <tr>
                    <th>Aksi</th>
                    <th>Nama Event</th>
                    <th>Location</th>
                    <th>Tanggal</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Akhir</th>
                    <th>Link</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Aksi</th>
                    <th>Nama Event</th>
                    <th>Location</th>
                    <th>Tanggal</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Akhir</th>
                    <th>Link</th>
                  </tr>
                  </tfoot>
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
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formTambah">
            <div class="form-group">
              <label for="namaBidang" class="col-form-label">Nama Event:</label>
              <input type="text" class="form-control" name="namaEvent" id="namaEvent">
            </div>
            <div class="form-group">
              <label for="namaBidang" class="col-form-label">Tanggal :</label>
              <input class="form-control" name="dateTimePicker" id="tglEvnt">
            </div>
            <div class="form-group">
              <label for="namaBidang" class="col-form-label clockpicker">Waktu Mulai :</label>
               <div class="input-group date" id="reservationdate" data-target-input="nearest">
                  <input type="text" class="form-control clockTest" name="waktuMulai" id="clockTest">
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                       <div class="input-group-text"><i class="far fa-clock"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label for="namaBidang" class="col-form-label">Waktu Akhir :</label>
              <br>
                        <div class="custom-control custom-radio d-inline mr-2">
                          <input class="custom-control-input custom-control-input-danger" type="radio" id="radio1" checked name="waktuAkhir" value="selesai">
                          <label for="radio1" class="custom-control-label">Selesai</label>
                        </div>
                        <div class="custom-control custom-radio d-inline">
                          <input class="custom-control-input custom-control-input-danger" type="radio" id="radio2" name="waktuAkhir">
                          <label for="radio2" class="custom-control-label">Input Waktu</label>
                        </div>

                        <div>
                          <input type="text" class="form-control mt-2" name="waktuAkhirInput" value="Selesai" disabled id="selesai">
                          <input type="text" class="form-control clockTest mt-2" name="setWaktuAkhir" id="waktuAkhirInput">
                        </div>
            </div>

            <div class="form-group">
              <label for="namaBidang" class="col-form-label">Lokasi :</label>
              <input type="text" class="form-control" name="lokasi" id="lokasi">
            </div>
            <div class="form-group">
              <label for="namaBidang" class="col-form-label">Pilih Bidang :</label>
              <div id="bidangHtml">
                
              </div>
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
              <label for="namaBidang" class="col-form-label">Nama Event:</label>
              <input type="text" class="form-control" name="namaEvent" id="namaEvent2">
              <input type="hidden" name="idx" id="idx">
            </div>
            <div class="form-group">
              <label for="namaBidang" class="col-form-label">Tanggal :</label>
              <input class="form-control" name="dateTimePicker" id="tglEvnt2">
            </div>
            <div class="form-group">
              <label for="namaBidang" class="col-form-label clockpicker">Waktu Mulai :</label>
               <div class="input-group date" id="reservationdate" data-target-input="nearest">
                  <input type="text" class="form-control clockTest" name="waktuMulai2" id="clockTest2">
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                       <div class="input-group-text"><i class="far fa-clock"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label for="namaBidang" class="col-form-label">Waktu Akhir :</label>
              <br>
                        <div class="custom-control custom-radio d-inline mr-2">
                          <input class="custom-control-input custom-control-input-danger" type="radio" id="radio3" checked name="waktuAkhir2" value="selesai">
                          <label for="radio3" class="custom-control-label">Selesai</label>
                        </div>
                        <div class="custom-control custom-radio d-inline">
                          <input class="custom-control-input custom-control-input-danger" type="radio" id="radio4" name="waktuAkhir2">
                          <label for="radio4" class="custom-control-label">Input Waktu</label>
                        </div>

                        <div>
                          <input type="text" class="form-control mt-2" name="waktuAkhirInput" value="Selesai" disabled id="selesai2">
                          <input type="text" class="form-control clockTest mt-2" name="setWaktuAkhir" id="waktuAkhirInput2">
                        </div>
            </div>

            <div class="form-group">
              <label for="namaBidang" class="col-form-label">Lokasi :</label>
              <input type="text" class="form-control" name="lokasi" id="lokasi2">
            </div>
            <div class="form-group">
              <label for="namaBidang" class="col-form-label">Pilih Bidang :</label>
              <div id="bidangHtml2">
                
              </div>
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
$("#selesai").show();
$("#waktuAkhirInput").hide();

$( document ).ready(function() {

var clipboard = new ClipboardJS('.copyed');


$('.clockTest').clockpicker({
  autoclose: true,
  placement:'bottom',
  align:'left',
  donetext:'Done', 
  // vibrate:true   
});

$('input[type=radio][name=waktuAkhir]').change(function() {
    if (this.value == 'selesai') {
         $("#selesai").show();
         $("#waktuAkhirInput").hide();
    }else{
         $("#selesai").hide();
         $("#waktuAkhirInput").show(); 
    }
    
});

$('input[type=radio][name=waktuAkhir2]').change(function() {
    if (this.value == 'selesai') {
         $("#selesai2").show();
         $("#waktuAkhirInput2").hide();
    }else{
         $("#selesai2").hide();
         $("#waktuAkhirInput2").show(); 
    }
    
});

showModal = function (){
  getBidang();
  $('#modalTambah').modal('show');
}

function getBidang() {
   $.ajax({
        url: base_url()+'C_event/getBidang',
        type: "get",
        dataType: 'json',
        success: function (res) {
        var html = '';
        for(let i = 0; i < res.length; i++){     

         html += `<div class="custom-control custom-checkbox">`;
            html += `<input class="custom-control-input bidangDicentang custom-control-input-success" type="checkbox" id="`+res[i].id_slug+`" name="bidang[]"   value="`+res[i].id_slug+`">`;
             html +=   `<label for="`+res[i].id_slug+`" class="custom-control-label">`+res[i].nama_bidang+`</label>
              </div>`;
        }
         $("#bidangHtml").html(html);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
           error('Error', 'Ada yang Error Silahkan Hubungi Developer')
        }
    });
}

function getBidang2(id_bidang) {
   var bidangArry = id_bidang.split(",");
   $.ajax({
        url: base_url()+'C_event/getBidang',
        type: "get",
        dataType: 'json',
        success: function (res) {
        var html = '';
        for(let i = 0; i < res.length; i++){  
        var ceking = bidangArry.includes(res[i].id_slug);

        var implemen = (ceking) ? 'checked' : '';

         html += `<div class="custom-control custom-checkbox">`;
            html += `<input class="custom-control-input bidangDicentang custom-control-input-success"  type="checkbox" id="`+res[i].id_slug+`2" name="bidang[]"   value="`+res[i].id_slug+`" `+implemen+`>`;
             html +=   `<label for="`+res[i].id_slug+`2" class="custom-control-label">`+res[i].nama_bidang+`</label>
              </div>`;
        }
         $("#bidangHtml2").html(html);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
           error('Error', 'Ada yang Error Silahkan Hubungi Developer')
        }
    });
}


 $('#tglEvnt').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd'
});
$('#tglEvnt2').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd'
});

// Proses Tambah Data
save = function (){
  
    $.ajax({
        url: base_url()+'C_event/save',
        type: "post",
        data: $("#formTambah").serialize(),
        success: function (res) {
       
        reset();
        success('SUCCESS', 'Data Disimpan');
        $('#modalTambah').modal('hide');
        dataTabel.ajax.reload();
        
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
           error('Error', 'Ada yang Error Silahkan Hubungi Developer')
        }
    });

}

saveEdit = function(){

  $.ajax({
        url: base_url()+'C_event/update',
        type: "post",
        data: $("#formEdit").serialize(),
        success: function (res) {

        success('SUCCESS', 'Data Berhasil Disimpan');
        $('#modalEdit').modal('hide');
        dataTabel.ajax.reload();
        
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
        url: base_url()+'C_event/delete',
        type: "post",
        dataType: 'json',
        data: {id_slug:slg_id} ,
      success: function (res) {
      if(res.code == 200){
        dataTabel.ajax.reload();
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
        url: base_url()+'C_event/getById',
        type: "post",
        dataType: 'json',
        data: {slug_id:slg_id},
        success: function (res) {
        console.log(res);
        // $('#edit').val(res.id_sender);
        // $('#slg_edit').val(res.id_slug);
        $('#namaEvent2').val(res.name_event);
        $('#idx').val(res.idx);
        $('#tglEvnt2').val(res.date_event);
        $('#clockTest2').val(res.date_start);
        $('#waktuAkhirInput2').val(res.date_finish);
        $('#lokasi2').val(res.location);
        getBidang2(res.slug_bidang);
        if (res.date_finish != 'selesai') {
          $('#radio4').prop('checked', true);
          $("#selesai2").hide();
          $("#waktuAkhirInput2").show();
        }else{
          $('#radio4').prop('checked', false);
           $('#radio3').prop('checked', true);
        }
        $('#modalEdit').modal('show');
         
        
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
           error('Error', 'Ada yang Error Silahkan Hubungi Developer')
        }
});

}

instance = new dtsel.DTS('input[name="dateTimePicker"]');

function reset(){
  $('#namaEvent').val('');
  $('#tglEvnt').val('');
  $('#clockTest').val('');
  $('#waktuAkhirInput').val('');
  $('#lokasi').val('');

}

});
</script>

