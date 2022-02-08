
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $tittle; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Pace -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/pace/themes/black/pace-theme-flash.css">
  <!-- iziToast -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/iziToast/css/iziToast.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/sweetalert/tools/sweetAlert.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- iziToast -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/iziToast/css/iziToast.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/sweetalert/tools/sweetAlert.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Fav Icon -->
  <link rel="shortcut icon" type="image/jpg" href="<?php echo base_url(); ?>assets/logo/pu1.jpg">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
  <style type="text/css">
    .text-tabel {
      font-size: 120%;
      font-family: Arial, sans-serif;
      color: #45678d;
    }

    .text-atas {
      font-size: 100%;
      color: #45678d;
      font-family: 'Trebuchet MS', sans-serif;
      font-weight: bold;
    }

    .tinggi-tabel {
      height: 400%;
      overflow-y: auto;
    }

    .borderless td, .borderless th {
    border: none;
    }

    .text-lvl {
      font-size:  120%;
      
    }
    .textHanjay {
      font-size:  95%;
      font-family:  serif;
      color: black;
    }

    .note-insert.btn-group>.btn:not(:first-child):not(:last-child):not(.dropdown-toggle) {
    display:none;}

    .note-insert.btn-group>.btn:last-child:not(:first-child), .btn-group>.dropdown-toggle:not(:first-child) {
    display:none;}


  </style>
  <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
  <script type="text/javascript">
    function base_url(){
      return '<?php echo base_url(); ?>';
    }
  </script>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container" >
      <table>
        <tr>
          <th rowspan="2" width="10%"><img height="50px" width="50px" src="<?php echo base_url();?>assets/logo/pu1.jpg" alt="AdminLTE Logo"></th>
          <th rowspan="2">&nbsp;</th>
          <th>
            <span class="brand-text text-atas"><i><?php echo $dataEvent->name_event; ?></i></span>
          </th>
        </tr>
        <tr>
          <th>
            <span class="brand-text text-tabel">Pusat Fasilitasi Infrastruktur Daerah</span>
          </th>
        </tr>
      </table>
     <!--  <a href="<?php echo base_url(); ?>assets/index3.html" class="navbar-brand">
        <img src="<?php echo base_url(); ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a> -->

     <!--  <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->

      

    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color:#ede7f6;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0"> Dashboard <small>Verifikator</small></h1> -->
          </div><!-- /.col -->
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Top Navigation</li>
            </ol>
          </div> --><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-8">

            <div class="card card-primary card-outline">
              <div class="card-body">
                <div class="alert alert-light" id="infor-event" role="alert">
                  <table>
                    <tr>
                      <th class="textHanjay">Nama </th>
                      <th></th>
                      <th class="textHanjay">:</th>
                      <th></th>
                      <th class="textHanjay"><?php echo $dataEvent->name_event; ?></th>
                    </tr>
                    <tr>
                      <th class="textHanjay">Tanggal</th>
                      <th></th>
                      <th class="textHanjay">:</th>
                      <th></th>
                      <th class="textHanjay"><?php echo $dataEvent->date_event; ?></th>
                    </tr>
                    <tr>
                      <th class="textHanjay">Waktu</th>
                      <th></th>
                      <th class="textHanjay">:</th>
                      <th></th>
                      <th class="textHanjay"><?php echo $dataEvent->date_start; ?> sd <?php echo $dataEvent->date_finish; ?></th>
                    </tr>
                    <tr>
                      <th class="textHanjay">Lokasi</th>
                      <th></th>
                      <th class="textHanjay">:</th>
                      <th></th>
                      <th class="textHanjay"><?php echo $dataEvent->location; ?></th>
                    </tr>
                  </table>
                </div>
                <div id="formID">
                <div class="form-group">
                    <label for="name">Nama :</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Input Nama.">
                  </div>
                  <div class="form-group">
                    <label for="jabatan">Jabatan :</label>
                    <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Input Jabatan.">
                  </div>
                  <div class="form-group">
                    <label for="instansi">Instansi :</label>
                    <input type="text" class="form-control" name="instansi" id="instansi" placeholder="Input Instansi.">
                    <input type="hidden" name="slug_event" id="slug_event" value="<?php echo $dataEvent->idx; ?>">
                  </div>

               <div class="form-group ">
                  <label>Pilih Bidang :</label>
                  <div class="text-center">
                  <select class="form-control text-center" name="bidang" id="bidang" style="width: 100%;">
                    <option value="0" selected="selected" disabled>===Pilih Bidang===</option>
                    <?php foreach ($dataBidang as $key) { ?>
                      <option value="<?php echo $key->id_slug; ?>"><?php echo $key->nama_bidang; ?></option>
                    <?php } ?>
                  </select>
                  </div>
               </div>
              <div class="form-group ">
                  <label>Pilih Provinsi:</label>
                  <div class="text-center">
                  <select class="form-control select2 text-center" name="provisni" id="provinsi" style="width: 100%;">
                    <option value="0" selected="selected" disabled>===Pilih Provinsi===</option>
                    <?php foreach ($dataProvinsi as $key ) {?>
                    <option value="<?php echo $key->id_slug; ?>"><?php echo $key->name; ?></option>
                    <?php } ?>
                  </select>
                  </div>
            </div>
            <div class="form-group ">
                  <label>Pilih Kab/Kota:</label>
                  <div class="text-center">
                  <select class="form-control select2 text-center" name="kota" id="kota" style="width: 100%;">
                    <option value="0" selected="selected" disabled>===Pilih Kab/Kota===</option>
                    
                  </select>
                  </div>
            </div>
            <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Input Email.">
            </div>
            <div class="form-group">
                    <label for="tlp">No Telfon/WA :</label>
                    <input type="number" class="form-control" name="tlp" id="tlp" placeholder="Input Telfon/WA.">
                    <p style="color: #800000; font-size: 15px;"><i>*Harap Mengisikan Nomor Telfon yange telah Terdaftar dengan Whatsapp</i></p>
            </div>
                  <button class="btn btn-sm btn-success" style="float: right"; onclick="saveForm();"><din id="normalForm"><i class="fas fa-cloud-upload-alt"></i> <b>SUBMIT</b></din>
                 
                  </button>

                </div>
                <div id="content2">
                  <div class="text-center">
                    <img src="<?php echo base_url(); ?>assets/logo/centang2.png" height="150px">
                    <h4><b>Success</b></h4>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->



</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- gasparesganga -->
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<!-- izi toast -->
<script src="<?php echo base_url();?>assets/iziToast/js/iziToast.min.js"></script>
<script src="<?php echo base_url();?>assets/iziToast/cutomJs.js"></script>

<script type="text/javascript">

  $.LoadingOverlaySetup({
    background      : "rgba(0, 0, 0, 0.5)",
    image           : "<?php echo base_url(); ?>assets/logo/logo.png",
    imageAnimation  : "1.5s fadein",
    imageColor      : "#ffcc00"
  });

 

$( document ).ready(function() {
  $("#content2").hide();
  // $("#normalForm").hide();
  
  $('.select2').select2();

  $('#provinsi, #provinsiEdit').change(function(){ 
    var value = $(this).val();
    let option = `<option value="0" disabled selected>=== Pilih Kab/Kota ===</option>`;
    $.ajax({
        url: base_url()+'C_formulir/getKab',
        type: "post",
        dataType: 'json',
        data: {slug_id:value},
        success: function (res) {

        for(let i = 0; i < res.length; i++){
          
            option += `<option value="`+res[i].idx+`">`+res[i].city_name+`</option>`
        }

        $("#kota,#kotaEdit").html(option);
        
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
           error('Error', 'Ada yang Error Silahkan Hubungi Developer')
        }
    });

                $('#keuangan1,#keuangan2,#keuangan3,#keuangan4,#keuangan5,#keuangan6,#keuangan7,#keuangan8,#keuangan9,#keuangan10,#keuangan11,#keuangan12').val('') 
                $('#progres1').val('')

});


  saveForm = function(){
    let name = $('#nama').val();
    let jabatan = $('#jabatan').val();
    let instansi = $('#instansi').val();
    let email = $('#email').val();
    let tlp = $('#tlp').val();
    let bidang = $('#bidang option:selected').val();
    let provinsi = $('#provinsi option:selected').val();
    let kota = $('#kota option:selected').val();
    let slug_event = $('#slug_event').val();


    if ( bidang == 0 || provinsi == 0 || kota == 0 || name.length == 0 || jabatan.length == 0 || instansi.length == 0 ) {

      info('Info', 'Silakan Lengkapi Form Terlebih Dahulu.');

    }else{
      
      if( tlp.length < 11){
        info('Info', 'Silakan isikan nomor telfon yang valid.');
        return;
      }
      if( email.indexOf('@') <= 0 || email.lengt < 5 ){
        info('Info', 'Silahkan isikan Email yang Valid.');
        return;
      }


      $.ajax({
        url: base_url()+'c_formulir/saveForm',
        type: "post",
        beforeSend:$.LoadingOverlay("show"),
        data: {name:name,jabatan:jabatan,instansi:instansi,email:email,tlp:tlp,bidang:bidang,provinsi:provinsi,kota:kota, slug_event:slug_event},
        success: function (res) {

        setTimeout(function() { 
        $.LoadingOverlay("hide");
        $("#formID").hide();
        $("#infor-event").hide();
        $("#content2").show();
        }, 2000);
        
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
           error('Error', 'Ada yang Error Silahkan Hubungi Developer')
           $("#formID").hide();
        }
    });

    }
  }



});


</script>
</body>
</html>
