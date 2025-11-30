   @include('header')
   <?php 
$asset = config('constants.asset');
?>
  <style type="text/css">
    .Rectangle-3 {

    width: 350px;

    height: 400px;
    position: flex;
    top: 50%;
    left: 50%;
    
    margin: auto;
    border-radius: 6px;

    box-shadow: 0 2px 8px 0 rgba(170, 170, 170, 0.5);

    background-color: #ffffff;

  }
  .Rectangle-4{

    width:300px;
    height: 50px;
    border-radius: 4px;
   border-color: #ffffff;
    background-color:#009900;
  
  }
  .Rectangle-5 {
   width:300px;
    height: 50px;
    border-radius: 4px;   
    /*border-color: red;*/
    background-color:#213f7b;
      

  }

  @media screen and (max-width: 750px) {
    .Rectangle-3   {
      width: 100%;
      margin-top: 0;
    }
  }

  @media screen and (max-width: 700px) {
    .Rectangle-4 ,  .Rectangle-5  {
      width: 80%;
      margin-top: 0;
    }
  }
  .modal-dialog {

      margin: 5px auto;
      transform: translate(40%,-80%);

      vertical-align: middle;

  }

  /*//removing extra padding from the body*/
  .modal-body {

     width: 400px;
    height: 480px;
    border-radius: 10px;
    background-color: #ffffff;
      position: relative;
      padding: 0 15px;
  }

  /*// Add padding to your footer*/
  .modal .modal-footer {
      border-top: none;
      padding: 10px;
  }

  /*change height of textarea*/
  textarea.form-control {
      height: 100px !important;
  }
  .labelT{
    font-size: 11px;
    font-weight: 300;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.45;
    letter-spacing: normal;
    color: rgba(0, 0, 0, 0.87);
  }
  .labelSK{
    width:95%;
    font-size: 12px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5;
    letter-spacing: normal;
    color: #1e1e1e;
  }
  /* width */
  ::-webkit-scrollbar {
    width: 5px;
  }

  /* Track */
  ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey; 
    border-radius: 10px;
  }
   
  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #a52b1d;; 
    border-radius: 10px;
  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #b30000; 
  }

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
 /* bottom: 0;
  right: 15px;*/
  border: 3px solid #f1f1f1;
  width:380px;
    height: 50px;
    border-radius: 4px;
   /* background-color: #213f7b;*/
  
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}


/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #213f7b;
    border-radius: 4px;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 350px;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
  </style>
  <section></section>
 <section></section>
  <section style="margin-top: 30px;">

  <div class="container" style="background-color: #f8f8f8;">
    <div class="Rectangle-3 text-center ">
          <img src="{{$asset('img/makarafk.png')}}" style="float: center;width: 180px;height: 180px; margin-top: -35px;z-index: 5;">

  <br>
  <br>



<a href="anggotaDN" style="margin-top: 60px;
  font-size: 15px;
  font-weight: bold;
  font-style: normal;
  font-stretch: normal;
  line-height: normal;
  letter-spacing: normal;
  color: #ffffff;">
<button class="Rectangle-4" type="submit" >
DATA PASIEN BARU</button> </a>
<br>
<br>

<a href="anggotaLN" style="margin-top: 60px;
  font-size: 15px;
  font-weight: bold;
  font-style: normal;
  font-stretch: normal;
  line-height: normal;
  letter-spacing: normal;
  color: #ffffff;">
<button class="Rectangle-4" type="submit" >UBAH DATA PASIEN</button></a>
<br>
<br>

<a  href="ubahdata" style="margin-top: 60px;
  font-size: 15px;
  font-weight: bold;
  font-style: normal;
  font-stretch: normal;
  line-height: normal;
  letter-spacing: normal;
  color: #ffffff;"><button class="Rectangle-5" type="submit" style="margin-left: -5px;">
PENCARIAN</button></a>

    </div>

  </div>

 
  </section>
  <section></section>
  @include('footer')
