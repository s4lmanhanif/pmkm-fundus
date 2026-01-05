<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

require_once('config.php');

// Handle login
if (isset($_POST['login'])) {
    $user = isset($_POST['username']) ? trim($_POST['username']) : '';
    $pass = isset($_POST['password']) ? $_POST['password'] : '';
    // Simple hardcoded credentials – change as needed
    if ($user === 'admin' && $pass === 'admin') {
        $_SESSION['username'] = $user;
        $_SESSION['password'] = $pass;
    } else {
        $loginError = 'Invalid username or password';
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: cari_pasien.php');
    exit;
}

// If not logged in, show login form
if (!isset($_SESSION['username'])) {
    require_once('head.php');
?>
<div class="login-box">
    <h2>🔐 Login</h2>
    <?php if (!empty($loginError)) echo "<p style='color:#e74c3c;text-align:center;'>$loginError</p>"; ?>
    <form method="post" action="cari_pasien.php">
        <label>Username</label>
        <input type="text" name="username" value="admin">
        <label>Password</label>
        <input type="password" name="password" value="admin">
        <button type="submit" name="login" class="button_blue" style="width:100%;padding:14px;font-size:16px;margin-top:10px;">Login</button>
    </form>
    <p style="text-align:center;color:#888;margin-top:20px;font-size:13px;"><em>Default: admin / admin</em></p>
</div>
<?php
    require_once('footer.php');
    exit;
}

require_once('head.php');
?>
<div style="text-align:right; margin-bottom:15px;"><a href="?logout=1" class="logout-link">Logout</a></div>
<script>
$(document).ready(function() {
    $('#motherName').autocomplete({
        source: "search.php",
        minLength: 1
    });
    $('#biodata_ibu').hide();
    $('#input_pasien_baru').hide();
});

var dataIbu = 0;
function showHideDataIbu() {
    if (dataIbu == 0) { $('#biodata_ibu').show(300); dataIbu = 1; }
    else { $('#biodata_ibu').hide(300); dataIbu = 0; }
}

var inputDataIbu = 0;
function showHideInputDataIbu() {
    if (inputDataIbu == 0) { $('#input_pasien_baru').show(150); inputDataIbu = 1; }
    else { $('#input_pasien_baru').hide(150); inputDataIbu = 0; }
}
</script>

<?php
$tow = 0;
$motherID = 0;
$motherHeight = 0;
$motherWeight = 0;
$motherParity = 0;
$motherEtnis = 71.5;
$embrioID = 0;
$embrioSex = -1;
$embrioEDD = '';
$measurementHeight = array();
$measurementDate = array();
$measurementRealDate = array();

if (isset($_POST['cariPasienButton'])) {
    $motherName = mysqli_real_escape_string($con, $_POST['motherName']);
    $result = mysqli_query($con, "SELECT * FROM mother WHERE mother_name='$motherName'");
    while ($row = mysqli_fetch_assoc($result)) {
        $motherID = $row['mother_id'];
        $motherName = $row['mother_name'];
        $motherAddr = $row['mother_address'];
        $motherHeight = $row['mother_height'];
        $motherWeight = $row['mother_weight'];
        $motherEtniss = $row['mother_etnis'];
        $motherParity = $row['mother_parity'];

        echo "<script>
$(document).ready(function() {
    $('#mother_name').val('" . addslashes($motherName) . "');
    $('#mother_id').val('$motherID');
    $('#pengukuran_mother_id').val('$motherID');
    $('#mother_address').html('" . addslashes($motherAddr) . "');
    $('#mother_height').val('$motherHeight');
    $('#mother_weight').val('$motherWeight');
    $('#etnis_$motherEtniss').attr('selected', 'selected');
    if ($motherParity == 0) $('#parity_0').attr('selected','selected');
    else if ($motherParity == 1) $('#parity_1').attr('selected','selected');
    else if ($motherParity == 2) $('#parity_2').attr('selected','selected');
    else $('#parity_3').attr('selected','selected');
});
</script>";

        switch ($motherEtniss) {
            case 0: $motherEtnis = -206.4; break;
            case 1: $motherEtnis = -156.8; break;
            case 2: $motherEtnis = -125.7; break;
            case 3: $motherEtnis = -166.0; break;
            case 4: $motherEtnis = -63.7; break;
            case 5: $motherEtnis = -90.0; break;
            case 6: $motherEtnis = 64.0; break;
            case 7: $motherEtnis = 71.5; break;
            default: $motherEtnis = -60; break;
        }
    }

    $result = mysqli_query($con, "SELECT * FROM embrio WHERE embrio_mother_id='$motherID'");
    while ($row = mysqli_fetch_assoc($result)) {
        $embrioID = $row['embrio_id'];
        $embrioSex = $row['embrio_sex'];
        $embrioEDD = $row['embrio_edd'];
    }

    echo "<script>
$(document).ready(function() {
    $('#mother_edd').val('$embrioEDD');
    $('#embrio_id').val('$embrioID');
    if ($embrioSex == 0) $('#sex_female').attr('selected','selected');
    else if ($embrioSex == 1) $('#sex_male').attr('selected','selected');
    else $('#sex_unknown').attr('selected','selected');
});
</script>";

    // load measurements
    $result = mysqli_query($con, "SELECT * FROM measurement WHERE measurement_embrio_id='$embrioID' ORDER BY measurement_date");
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $measurementHeight[] = $row['measurement_height'];
        $measurementDate[] = $i;
        $measurementRealDate[] = $row['measurement_date'];
        $i++;
    }
}

if (isset($_POST['submitData'])) {
    $motherName = mysqli_real_escape_string($con, $_POST['input_mother_name']);
    $motherAddr = mysqli_real_escape_string($con, $_POST['input_mother_address']);
    $motherWeight = floatval($_POST['input_mother_weight']);
    $motherHeight = floatval($_POST['input_mother_height']);
    $motherEtnisInput = intval($_POST['input_mother_etnis']);
    $motherPar = intval($_POST['input_mother_parity']);
    $embrioEDD = mysqli_real_escape_string($con, $_POST['input_mother_edd']);
    $embrioSex = intval($_POST['input_kelamin']);

    $sql = "INSERT INTO mother(mother_name, mother_address, mother_etnis, mother_parity, mother_weight, mother_height)
            VALUES('$motherName','$motherAddr','$motherEtnisInput','$motherPar','$motherWeight','$motherHeight')";
    mysqli_query($con, $sql) or die("Error inserting mother");
    $id = mysqli_insert_id($con);

    $sql1 = "INSERT INTO embrio(embrio_mother_id, embrio_edd, embrio_sex) VALUES('$id','$embrioEDD','$embrioSex')";
    mysqli_query($con, $sql1) or die("Error inserting embrio");

    echo "<p style='color:green;'>Data berhasil disimpan</p>";
}
?>

<div id="saving_notification" style="display:none;">Data tersimpan!</div>

<!-- Button to show new patient form -->
<p><a class="button_green" onclick="showHideInputDataIbu();" style="cursor:pointer;"> + Tambah Pasien Baru</a></p>

<!-- Form untuk Input Pasien Baru -->
<div id="input_pasien_baru" class="card">
    <div class="card-header">📋 Form Pasien Baru</div>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table border="0" style="width:100%;">
            <tr><td style="width:120px;padding:8px 0;"><strong>Nama</strong></td><td><input type="text" name="input_mother_name" style="width:100%;"/></td></tr>
            <tr><td style="padding:8px 0;"><strong>Alamat</strong></td><td><textarea name="input_mother_address" rows="3" style="width:100%;"></textarea></td></tr>
            <tr><td style="padding:8px 0;"><strong>EDD</strong></td><td><input type="date" name="input_mother_edd"/></td></tr>
            <tr><td style="padding:8px 0;"><strong>Etnis</strong></td><td>
                <select name="input_mother_etnis" style="width:200px;">
                    <option value="0">Indian</option>
                    <option value="1">Pakistani</option>
                    <option value="2">Bangladeshi</option>
                    <option value="3">African Caribbean</option>
                    <option value="4">African (sub Sahara)</option>
                    <option value="5">Middle East</option>
                    <option value="6">Far East Asian</option>
                    <option value="7" selected>South East Asia</option>
                    <option value="8">Other</option>
                </select>
            </td></tr>
            <tr><td style="padding:8px 0;"><strong>Tinggi</strong></td><td><input type="text" name="input_mother_height" style="width:80px;"/> cm</td></tr>
            <tr><td style="padding:8px 0;"><strong>Berat</strong></td><td><input type="text" name="input_mother_weight" style="width:80px;"/> kg</td></tr>
            <tr><td style="padding:8px 0;"><strong>Parity</strong></td><td>
                <select name="input_mother_parity">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3+</option>
                </select>
            </td></tr>
            <tr><td style="padding:8px 0;"><strong>Kelamin Janin</strong></td><td>
                <select name="input_kelamin">
                    <option value="-1">Belum diketahui</option>
                    <option value="1">Laki-laki</option>
                    <option value="0">Perempuan</option>
                </select>
            </td></tr>
            <tr><td></td><td style="padding-top:15px;"><input type="submit" name="submitData" value="💾 Simpan Data"/></td></tr>
        </table>
    </form>
</div>

<div id="form_container" class="clearfix">
    <div class="form40">
        <div class="card">
            <div class="card-header">Cari Pasien</div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="margin-bottom:15px;">
                <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    <input type="text" name="motherName" id="motherName" placeholder="Ketik nama pasien..." style="flex:1; min-width:180px;" value="<?php if(isset($_POST['motherName'])) echo htmlspecialchars($_POST['motherName']);?>"/>
                    <input type="submit" name="cariPasienButton" value="Cari">
                    <span class="edit-link" onclick="showHideDataIbu();"> Edit Data</span>
                </div>
            </form>

            <div id="biodata_ibu" class="card" style="background:#f8f9ff; margin-top:15px;">
                <div class="formTitle"> Data Ibu</div>
                <form id="edit_mother_form" method="post">
                    <input type="hidden" name="mother_id" id="mother_id" value=""/>
                    <input type="hidden" name="embrio_id" id="embrio_id" value=""/>
                    <table border="0" style="width:100%;">
                        <tr><td style="width:110px;padding:6px 0;"><strong>Nama</strong></td><td><input type="text" name="mother_name" id="mother_name" style="width:100%;"/></td></tr>
                        <tr><td style="padding:6px 0;"><strong>Alamat</strong></td><td><textarea name="mother_address" id="mother_address" rows="2" style="width:100%;"></textarea></td></tr>
                        <tr><td style="padding:6px 0;"><strong>EDD</strong></td><td><input type="date" name="mother_edd" id="mother_edd"/></td></tr>
                        <tr><td style="padding:6px 0;"><strong>Etnis</strong></td><td>
                            <select name="mother_etnis" id="mother_etnis" style="width:180px;">
                                <option id="etnis_0" value="0">Indian</option>
                                <option id="etnis_1" value="1">Pakistani</option>
                                <option id="etnis_2" value="2">Bangladeshi</option>
                                <option id="etnis_3" value="3">African Caribbean</option>
                                <option id="etnis_4" value="4">African (sub Sahara)</option>
                                <option id="etnis_5" value="5">Middle East</option>
                                <option id="etnis_6" value="6">Far East Asian</option>
                                <option id="etnis_7" value="7">South East Asia</option>
                                <option id="etnis_8" value="8">Other</option>
                            </select>
                        </td></tr>
                        <tr><td style="padding:6px 0;"><strong>Tinggi</strong></td><td><input type="text" name="mother_height" id="mother_height" style="width:70px;"/> cm</td></tr>
                        <tr><td style="padding:6px 0;"><strong>Berat</strong></td><td><input type="text" name="mother_weight" id="mother_weight" style="width:70px;"/> kg</td></tr>
                        <tr><td style="padding:6px 0;"><strong>Parity</strong></td><td>
                            <select name="mother_parity" id="mother_parity">
                                <option id="parity_0" value="0">0</option>
                                <option id="parity_1" value="1">1</option>
                                <option id="parity_2" value="2">2</option>
                                <option id="parity_3" value="3">3+</option>
                            </select>
                        </td></tr>
                        <tr><td style="padding:6px 0;"><strong>Kelamin Janin</strong></td><td>
                            <select name="kelamin" id="kelamin">
                                <option id="sex_unknown" value="-1">Belum diketahui</option>
                                <option id="sex_male" value="1">Laki-laki</option>
                                <option id="sex_female" value="0">Perempuan</option>
                            </select>
                        </td></tr>
                        <tr><td></td><td style="padding-top:10px;"><a onclick="editDataPasien();" class="button_blue" style="cursor:pointer;">💾 Update Data</a></td></tr>
                    </table>
                </form>
            </div>
        </div>

        <div class="card" style="margin-top:20px;">
            <div class="card-header"> Input Pengukuran</div>
            <form id="pengukuranJaninForm">
                <div style="display:flex;flex-wrap:wrap;gap:15px;align-items:flex-end;">
                    <div>
                        <label style="display:block;margin-bottom:5px;font-weight:500;">Tanggal</label>
                        <input type="date" name="pengukuran_tanggal" id="pengukuran_tanggal" value="<?php echo date('Y-m-d');?>">
                    </div>
                    <div>
                        <label style="display:block;margin-bottom:5px;font-weight:500;">Tinggi Fundus (cm)</label>
                        <input type="text" name="pengukuran_tinggi" id="pengukuran_tinggi" value="" style="width:80px;" placeholder="0">
                    </div>
                    <input type="hidden" name="pengukuran_mother_id" id="pengukuran_mother_id">
                    <a href="javascript:simpanHasilPengukuran();" class="button_green" style="cursor:pointer;">Simpan</a>
                </div>
            </form>
        </div>

        <div class="card" style="margin-top:20px;">
            <div class="card-header"> Riwayat Pengukuran</div>
            <table id="tabel_janin">
                <tr><th style="width:50px;">#</th><th>Tanggal</th><th>Tinggi Fundus</th></tr>
                <?php
                if ($motherID && $embrioID) {
                    $result = mysqli_query($con, "SELECT * FROM measurement WHERE measurement_embrio_id='$embrioID' ORDER BY measurement_date");
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td style='text-align:center;'><strong>$i</strong></td>";
                        echo "<td id='date_".$row['measurement_date']."'>".$row['measurement_date']."</td>";
                        echo "<td id='height_".$row['measurement_date']."'><strong>".$row['measurement_height']." cm</strong></td>";
                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='3' style='text-align:center;color:#888;padding:20px;'>Belum ada data pengukuran</td></tr>";
                }
                ?>
                <tr id="tabelHasilPengukuran"></tr>
            </table>
        </div>
    </div>

    <div class="form56">
        <div class="card">
            <div class="card-header"> Grafik Pertumbuhan Janin</div>
            <div class="chart-container">
        <?php
        // Build chart
        $kelamin = 0;
        if ($embrioSex == 0) $kelamin = -48.9;
        elseif ($embrioSex == 1) $kelamin = 48.9;

        $const = 3455.6;
        $tinggi_populasi = 163;
        $berat_populasi = 64;
        $etnis = $motherEtnis;
        $std = 10;

        $par = 0;
        switch ($motherParity) {
            case 1: $par = 111.0; break;
            case 2: $par = 154.8; break;
            case 3: $par = 151.3; break;
        }

        $tow = $const + ($motherHeight - $tinggi_populasi)*6.7 + ($motherWeight - $berat_populasi)*9.173 + $etnis + $par + $kelamin;

        $tanggal = urlencode(serialize($measurementDate));
        $realdate = urlencode(serialize($measurementRealDate));
        $stinggi = urlencode(serialize($measurementHeight));
        $cacheBust = time(); // Prevent browser caching

        if ($motherID) {
            echo "<img src='make.php?const=$const&edd=$embrioEDD&std=$std&tow=$tow&realdate=$realdate&tanggal=$tanggal&tinggi=$stinggi&t=$cacheBust' style='max-width:100%;'/>";
        } else {
            echo "<div style='text-align:center;padding:100px 20px;'>
                    <div style='font-size:60px;margin-bottom:20px;'>📊</div>
                    <p style='color:#888;font-size:16px;'>Silakan cari pasien untuk melihat grafik pertumbuhan janin</p>
                  </div>";
        }
        ?>
            </div>
        </div>
    </div>
</div>
<div style="clear:both"><br></div>

<script>
function simpanHasilPengukuran() {
    var tanggal = $('#pengukuran_tanggal').val();
    var tinggi = $('#pengukuran_tinggi').val();
    var motherID = $('#pengukuran_mother_id').val();

    if (!tanggal || !tinggi || !motherID) {
        alert('Pilih pasien dan isi semua field.');
        return;
    }

    $.get('make_table_janin.php', {tinggi: tinggi, tanggal: tanggal, motherID: motherID}, function(data) {
        if (data === 'xxx') {
            $('#height_'+tanggal).text(tinggi);
        } else if (data !== 'error') {
            $('#tabel_janin').append(data);
        }
        location.reload();
    });
}

function editDataPasien() {
    var params = {
        mother_id: $('#mother_id').val(),
        embrio_id: $('#embrio_id').val(),
        mother_name: $('#mother_name').val(),
        mother_address: $('#mother_address').val(),
        mother_weight: $('#mother_weight').val(),
        mother_height: $('#mother_height').val(),
        mother_etnis: $('#mother_etnis').val(),
        mother_parity: $('#mother_parity').val(),
        mother_edd: $('#mother_edd').val(),
        kelamin: $('#kelamin').val()
    };
    $.get('edit_data_pasien.php', params, function(data) {
        if (data === 'oke') {
            showHideDataIbu();
            $('#saving_notification').fadeIn(300).delay(800).fadeOut(400);
        }
    });
}
</script>

<?php
require_once('footer.php');
mysqli_close($con);
?>
