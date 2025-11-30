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
        <li><a href="#"><i class="fa fa-edit"></i> Data Pasien</a></li>
        <li class="active">Data Pasien Lama</li>
      </ol>
    </section>

    <!-- Main content -->
<section class="content">
<form>
<div class="container" style="background-color: #f8f8f8;width: 30%; margin-top: 40px">

  <img src="{{$asset('img/makarafk.png')}}" style="width: 180px;height: 180px; margin-top: -35px;z-index: 5;margin-left: 30%">
<br>
<p style="margin-left: 50px;margin-top: 20px;">
    <label class="" style="float:left; padding-bottom: 2px;">
    Nama:
  </label>
 
</p>
<br>
<p>
  <br>
<p>
   <!-- <input class="logininput form-control " name="email" id = "email" type="text" > -->   
   <input class="logininput  w3-input " name="email"  type="text" style="width: 80%;margin-left:50px;
   ">
</p>
<br>
<p style="margin-left: 50px;margin-top: 30px;">
    <label class="" style="float:left; padding-bottom: 2px;">
    NIK:
  </label>
 
</p>
<br>
<p>
  <br>
<p>
   <!-- <input class="logininput form-control " name="email" id = "email" type="text" > -->   
   <input class="logininput  w3-input " name="email"  type="text" style="width: 80%;margin-left:50px;
   ">
</p>
<br>
<br>
<p >
            <label style="margin-left: 50px; margin-top: 20px">
              Kelahiran <label style="color:#ff0000;font-weight: bold; font-size: 16px;">*</label>
          </label>
            
            <select class="w3-input logininput" style="text-transform;width: 80%;margin-left:50px;
   margin-top:10px; margin-bottom:30px; " name="agama" required value="" >
            <option value="">=Parity=</option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3+</option>
            
            </select>
          </p>
<button class="Rectangle-4" id="masuk" type="submit" style="margin-top: 30px;
  margin-left: 50px;
  font-weight: 500;
  font-style: normal;
  font-stretch: normal;
  line-height: normal;
  letter-spacing: normal;
  color: #213f7b;
">MASUK </button>
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
