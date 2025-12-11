<?php
$action = isset($_POST['Submit']) ? $_POST['Submit'] : '';
$tow = 0;
$const = 3455.6;
$tinggi_populasi = 163;
$berat_populasi = 64;
$etnis = 56.4;
$std = 389;

if ($action == 'Submit')
{
  $const =$_POST['const'];
  $tinggi_populasi =$_POST['tinggi_populasi'];
  $berat_populasi =$_POST['berat_populasi'];
  $etnis =$_POST['etnis_populasi'];
  $nama=$_POST['nama'];
  $alamat =$_POST['alamat'];
  $std =$_POST['std'];
  //untuk individu
  $tinggi_idv = $_POST['tinggi_idv'];
  $berat_idv = $_POST['berat_idv'];
  $par =$_POST['par'];
  $kelamin = $_POST['kelamin'];
	
  $tow = $const + ($tinggi_idv-$tinggi_populasi)*6.7 + ($berat_idv-$berat_populasi)*9.173 + $etnis + $par + $kelamin;
  //print $const.'+'.($tinggi_idv-$tinggi_populasi)*6.7 + ($berat_idv-$berat_populasi)*9.173 +$etnis + $par + $kelamin;
}
?>

<form id="form1" name="form1" method="post" action="index.php">
  <table width="654" border="0">
    <tr>
      <th width="135" scope="row">Const</th>
      <td width="167"><label for="textfield"></label>
        <input name="const" type="text" id="textfield" value="3455.6" readonly="readonly" /></td>
      <td width="167">&nbsp;</td>
      <td width="167">&nbsp;</td>
    </tr>
    <tr>
      <th colspan="2" scope="row">Populasi</th>
      <td colspan="2" align="center"><strong>Individu</strong></td>
    </tr>
    <tr>
      <th scope="row">Tinggi</th>
      <td><input name="tinggi_populasi" type="text" id="textfield2" value="163" readonly="readonly" /></td>
      <td align="center"><strong>Tinggi</strong></td>
      <td align="left"><strong>
        <input type="text" name="tinggi_idv" id="textfield8" />
      </strong></td>
    </tr>
    <tr>
      <th scope="row">Berat</th>
      <td><input name="berat_populasi" type="text" id="textfield4" value="64" readonly="readonly" /></td>
      <td align="center"><strong>Berat</strong></td>
      <td align="left"><strong>
        <input type="text" name="berat_idv" id="textfield7" />
      </strong></td>
    </tr>
    <tr>
      <th scope="row">Etnis</th>
      <td><input name="etnis_populasi" type="text" id="textfield3" value="56.4" readonly="readonly" /></td>
      <th scope="row">Par</th>
      <td align="left"><select name="par" id="select2">
        <option value="0">0</option>
        <option value="101.9">1</option>
        <option value="133.7">2</option>
        <option value="140.2">3</option>
        <option value="162.7">4+</option>
      </select>
    </tr>
    <tr>
      <th scope="row">Std</th>
      <td><label for="std"></label>
      <input name="std" type="text" id="textfield6" value="389" readonly="readonly" /></td>
      <th scope="row">Kelamin</th>
      <td align="left"><label for="select"></label>
        <select name="kelamin" id="select">
          <option value="0">Belum diketahui</option>
          <option value="48.9">Laki</option>
          <option value="-48.9">Perempuan</option>
      </select></td>
    </tr>
    <tr>
      <th colspan="2" scope="row">Nama</th>
      <th colspan="2" align="left" scope="row"><label for="textfield10"></label>
      <input type="text" name="nama" id="textfield10" /></th>
    </tr>
    <tr>
      <th colspan="2" scope="row">Alamat</th>
      <th colspan="2" align="left" scope="row"><label for="textfield11"></label>
        <label for="textarea"></label>
      <textarea name="alamat" id="textarea" cols="45" rows="5"></textarea></th>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
      <th colspan="2" scope="row"><input type="submit" name="submit" id="button" value="Submit" /></th>
    </tr>
    <tr>
      <th scope="row">TOW</th>
      <td><label for="textfield9"></label>
      <input name="tow" type="text" id="textfield9" readonly="readonly" <?php printf("value=$tow");?> /></td>
      <th colspan="2" scope="row">&nbsp;</th>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<?php
if ($action == "Submit")
{
	printf ("<img src='make.php?const=$const&std=$std&tow=$tow' width='800' height='700' />");
}
?>