<?php 
$asset = config('constants.asset');
?>
<!DOCTYPE html>
<html>
<head>
  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content=""> -->
<meta name="csrf-token" content="{{csrf_token() }}">
  <title>SITINDUS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <!-- <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
   --><!-- Font Awesome -->
<link rel="stylesheet" href="{{$asset('css/font-awesome/css/font-awesome.min.css')}}">

<link href = "{{$asset('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" />

<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
   <!-- Ionicons -->
  <link rel="stylesheet" href="{{$asset('css/Ionicons/css/ionicons.min.css')}}">

  <link rel="stylesheet" href="{{$asset('css/main.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{$asset('css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{$asset('css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{$asset('js/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{$asset('js/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{$asset('js/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{$asset('js/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{$asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<script src="{{$asset('js/jquery.min.js')}}"></script>

<script src="{{$asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- jQuery 3 --><!-- 
<script src="bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<script src="{{$asset('js/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Morris.js charts -->
<script src="{{$asset('js/raphael/raphael.min.js')}}"></script>
<script src="{{$asset('js/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{$asset('js/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{$asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{$asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{$asset('js/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{$asset('js/moment/min/moment.min.js')}}"></script>
<script src="{{$asset('js/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{$asset('js/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{$asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{$asset('js/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{$asset('js/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{$asset('js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{$asset('js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{$asset('js/demo.js')}}"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>T</b>FU</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Tinggi</b>FUndus</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
     <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li>
  <a href="#" ><img src="{{$asset('img/exit.png')}}" class="user-image" style="width: 25px; height: 25px;" alt="User Image">
              <span class="hidden-xs">Logout</span>
            
            </a>


          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    
     <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{$asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
          
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
         <li class=" treeview">
        <a href="/">    

            <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
            <!-- <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span> -->
          </a>
         <!--  <ul class="treeview-menu">
          <li>  <a href=""><i class="fa fa-circle-o"></i>Nasional</a>
          </li>         
          </ul> -->
      </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Data Pasien</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/datapasienbaru"><i class="fa fa-circle-o"></i> Input Data Pasien Baru </a></li>
            <li><a href="/datapasienlama"><i class="fa fa-circle-o"></i>Input Data Pasien Lama</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i> <span>Lihat Grafik Tinggi Fundus</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Lahiran</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Data</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Data</a></li>
          </ul>
        </li>
       
       

       
      </ul>
    </section>
    
    <!-- /.sidebar -->
  </aside>