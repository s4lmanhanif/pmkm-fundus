<?php 
$asset = config('constants.asset');
?>

 @include('header')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Input
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-edit"></i> Data Pasien </a></li>
        <li class="active">Input Data Pasien Baru</li>
      </ol>
    </section>

<section style="margin-top:50px"></section>
    <!-- Main content -->
    <section class="content">
    <form method="post" enctype="multipart/form-data" action="" autocomplete="on"> 
    {{csrf_field()}}

<div class="container" style="background-color: #ffff;width: 80%; margin: auto;  padding:20px 30px;">
  <div class="row">
    
    <div class="col-md-6 col-sm-12 col-xs-12">
    <h2 class="judulvisimisi" style="font-weight: bold; margin: 50px 0;">DATA PASIEN</h2>   
    </div>
    <div class="col-md-6 col-sm-+12 col-xs-12">
    <img src="{{$asset('img/makarafk.png')}}" style="float: right;width: 120px;height: 120px;margin-top: -45px;">
    </div>
  </div>


<br>
<div class="row" >
<div class="col-md-4">

          <p class="form-group" >
           <label class="title control-label" >
             
           Nomor Induk Kependudukan (NIK)
          </label>

            <div class="form-group" >
          <input class="w3-input title2" name="nik1" id = "nik1" type="text" value="" style="margin: 7px 0;" readonly>
          </div>
          </p>  
          <p class="form-group">
          <label class="title control-label ">
          Nama Lengkap
          </label>
            <div class="form-group">
          <input class="w3-input title2" name="nam1a" type="text" value="" readonly>  
          </div>        
          </p>
          <p class="form-group">
            <label class="title control-label ">
            Tempat Lahir <label style="color:#ff0000;font-weight: bold; font-size: 16px;">*</label>
          </label>
            
            <div class="form-group">
         
          <input class="w3-input title2"  name="tempatLahir" type="text" value="" id="inKabupaten">
          
           <div type="text" id="kabupKota"  required >                                            
             
            </div>
          
            </div>
          </p>
           <p>
          <label class="title control-label " >
          Tanggal Lahir Ibu</label> 
         
           <div class='input-group date' id='datetimepicker' style="width:100%;left: 1%; margin-top: 10px ">
              <input type='text' class="form-control" name="tanggalLahir" value="" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>


          </p>
        
         
</div>
<div class="col-md-4">
 <p class="form-group">
            <label class="title control-label ">
            Berat Badan Ibu (Kg) <label style="color:#ff0000;font-weight: bold; font-size: 16px;">*</label>
          </label>
            
            <div class="form-group">
         
          <input class="w3-input title2"  name="tempatLahir" type="text" value="" id="inKabupaten">
          
           <div type="text" id="kabupKota"  required >                                            
             
            </div>
          
            </div>
          </p>
        <p class="form-group">
            <label class="title control-label ">
            Tinggi Badan Ibu (Cm) <label style="color:#ff0000;font-weight: bold; font-size: 16px;">*</label>
          </label>
            
            <div class="form-group">
         
          <input class="w3-input title2"  name="tempatLahir" type="text" value="" id="inKabupaten">
          
           <div type="text" id="kabupKota"  required >                                            
             
            </div>
          
            </div>
          </p>
          <p class="form-group">
            <label class="title control-label ">
           EDD <label style="color:#ff0000;font-weight: bold; font-size: 16px;">*</label>
          </label>
            
            <div class="form-group">
         
          <input class="w3-input title2"  name="tempatLahir" type="text" value="" id="inKabupaten">
          
           <div type="text" id="kabupKota"  required >                                            
             
            </div>
          
            </div>
          </p>
  
</div>
<div class="col-md-4">
 <p class="form-group">
            <label class="title control-label ">
           STD <label style="color:#ff0000;font-weight: bold; font-size: 16px;">*</label>
          </label>
            
            <div class="form-group">
         
          <input class="w3-input title2"  name="tempatLahir" type="text" value="" id="inKabupaten">
          
           <div type="text" id="kabupKota"  required >                                            
             
            </div>
          
            </div>
          </p>
          <p class="form-group">
            <label class="title control-label ">
              Etnis <label style="color:#ff0000;font-weight: bold; font-size: 16px;">*</label>
          </label>

            <div class="form-group">
         
            <!-- <input class="w3-input" type="text"></p> -->
            <select class="w3-input title2" style="text-transform:" name="etnis" required value="" >
                  <option value="">=Pilihan=</option>
            <option id="etnis_0" value="0"> Indian </option>  <!-- -206.4 -->
              <option id="etnis_1" value="1"> Pakistani </option> <!-- -156.8 -->
              <option id="etnis_2" value="2"> Bangladeshi </option> <!-- -125.7 -->
              <option id="etnis_3" value="3"> African Caribbean </option> <!-- -116 -->
              <option id="etnis_4" value="4"> African (sub Sahara) </option> <!-- -63.7 -->
              <option id="etnis_5" value="5"> Middle East (inc North Africa) </option> <!-- -90 -->
              <option id="etnis_6" value="6"> Far East Asian (eg China, Japan) </option> <!-- 64 -->
              <option id="etnis_7" value="7"> South East Asia (eg Thailand, Indonesia, Philippines) </option> <!-- 71.5 -->
              <option id="etnis_8" value="8"> Other </option> <!-- -60 -->
            
            </select> 
          </div>
          </p>
           <p class="form-group">
            <label class="title control-label ">
              Kelahiran <label style="color:#ff0000;font-weight: bold; font-size: 16px;">*</label>
          </label>
            
            <div class="form-group">
            <select class="w3-input title2" style="text-transform:" name="agama" required value="" >
            <option value="">=Parity=</option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3+</option>
            
            </select> 
          </div>
          </p>
           
</div>
</div>


</div>

<section style="padding:1rem 0;"></section>
<div class="container" style="background-color: #ffff;width:80%;margin: auto; padding:30px 30px;">
<h2 class="judulvisimisi" style="font-weight: bold; margin: 50px 0;">DATA JANIN</h2> 
<div class="col-md-4">
    <p>
          <label class="title control-label " >
          Tanggal Pemeriksaan</label> 
         
           <div class='input-group date' id='datetimepicker' style="width:100%;left: 1%; margin-top: 10px ">
              <input type='text' class="form-control" name="tanggalLahir" value="" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>


          </p>
           <p class="form-group">
            <label class="title control-label ">
              Jenis Kelamin Janin <label style="color:#ff0000;font-weight: bold; font-size: 16px;">*</label>
          </label>
            
            <div class="form-group">
            <select class="w3-input title2" style="text-transform:" name="agama" required value="" >
            <option value="">=Pilihan=</option>
            <option value="0">Belum Diketahui</option>
            <option value="1">Laki-Laki </option>
            <option value="2">Perempuan</option>
            
            
            </select> 
          </div>
          </p>
         <p class="form-group">
            <label class="title control-label ">
           EDD Janin<label style="color:#ff0000;font-weight: bold; font-size: 16px;margin-top:20px; ">*</label>
          </label>
            
            <div class="form-group">
         
          <input class="w3-input title2"  name="tempatLahir" type="text" value="" id="inKabupaten">
          
           <div type="text" id="kabupKota"  required >                                            
             
            </div>
          
            </div>
          </p>
        </div>
        <div class="col-md-4">
          <p class="form-group">
            <label class="title control-label ">
            Tinggi Fundus (Cm) <label style="color:#ff0000;font-weight: bold; font-size: 16px;">*</label>
          </label>
            
            <div class="form-group">
         
          <input class="w3-input title2"  name="tempatLahir" type="text" value="" id="inKabupaten">
          
           <div type="text" id="kabupKota"  required >                                            
             
            </div>
          
            </div>
          </p>
        </div>
</div>
<div class=" col-md-12 text-center row" style="margin: 20px 0;">
  <button class="kotak_partai btn btn-success text-center"  type="submit" 
          style="   
          float:center;
          position: relative;                     
          border-radius: 4px;  
          background-color:#3c8dbc;">   
          <p class="teksjudul " style="
          margin: 4px;width: 150px;
          font-size: 22px;font-weight: 500;
          font-style: normal;font-stretch: normal;
          line-height: normal;
          letter-spacing: normal;color: #ffffff;">Submit
          </p>
          </button> 
</div>
</form>
     
<section style="padding:5rem 0;"></section>
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

 @include('footer')


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
  
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
