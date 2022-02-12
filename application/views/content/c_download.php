 
<br>
<style>
.fontSize {
  font-size: 15px;
}
</style>
    <section class="content ">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data File</h3>
                <a href="#" class="btn btn-success btn-sm" onclick="showModal();" style="float: right;"><i class="fas fa-plus"></i> <b>Tambah Data</b></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabelDownload" class="table table-bordered table-hover table-sm">
                  <thead>
                  <tr>
                    <th>Aksi</th>
                    <th>Nama File</th>
                    <th>Link</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Aksi</th>
                    <th>Nama File</th>
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
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data File</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formTambah">
                 <div class="form-group">
                    <label for="exampleInputFile">Pilih File</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="fileUpload" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
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





<script type="text/javascript">
$( document ).ready(function() {

  var clipboard = new ClipboardJS('.copyed');

showModal = function (){

  $('#modalTambah').modal('show');
}

// Proses Tambah Data
save = function (){
var form = $('#formTambah')[0];
  
if ($('#exampleInputFile').get(0).files.length === 0) {
  error('EROR', 'Silahkan masukan terlebih dahulu.!');
  return;
}


  $.ajax({
        url: base_url()+'C_download/do_upload',
        type: "post",
        dataType: 'json',
        data: new FormData(form),
        processData: false,
        contentType: false,
        success: function (res) {
        
        if(res.code == 200){
          $('#modalTambah').modal('hide');
          success('SUCCESS', res.massage);
          tDownload.ajax.reload();
          // reset($('#exampleInputFile'))
          $("#exampleInputFile").val('');
          $('#exampleInputFile').next('.custom-file-label').html('Choose File');
        }else{
          $('#modalTambah').modal('hide');
          error('SUCCESS', res.massage);
          tDownload.ajax.reload();
          $("#exampleInputFile").val('');
          $('#exampleInputFile').next('.custom-file-label').html('Choose File');
        }
         
        
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
           error('Error', 'Ada yang Error Silahkan Hubungi Developer')
        }
});

}

hapusData =  function(slug){
 
  Swal.fire({
    title: 'Anda yakin ingin menghapus file ini?',
    text: "Data yang telah dihapus tidak akan bisa dikembalikan",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya hapus!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: base_url()+'C_download/delete',
        type: "post",
        dataType: 'json',
        data: {slug:slug} ,
      success: function (res) {
      if(res.code == 200){
        tDownload.ajax.reload();
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

});
</script>

