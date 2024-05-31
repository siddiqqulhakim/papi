<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME     : index.php
AUTHOR       : CAHYA DSN
CREATED DATE : 2017-04-09
UPDATED DATE : 2021-06-02
DEMO SITE    : https://psycho.cahyadsn.com/papi
SOURCE CODE  : https://github.com/cahyadsn/papi
================================================================================
This program is free software; you can redistribute it and/or modify it under the
terms of the MIT License.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

See the MIT License for more details

copyright (c) 2017-2021 by cahya dsn; cahyadsn@gmail.com
================================================================================ */
session_start();
include 'inc/config.php';
$c=isset($_SESSION['c'])?$_SESSION['c']:(isset($_GET['c'])?$_GET['c']:'indigo');
$page=isset($_SESSION['page'])?$_SESSION['page']:0;
$num_perpage=5;
$_SESSION['author'] = 'cahyadsn';
$_SESSION['ver']    = sha1(rand());
$version    = '0.4';                  //<-- version number
header('Expires: '.date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
if(!isset($_SESSION['papi_id_data'])){
	$sql="SELECT * FROM papi_questions_v4 ORDER BY rand()";
	$result=$db->query($sql);
	$data=array();
	while($row=$result->fetch_object()) 
        $data[]=$row;
	$_SESSION['papi_id_data']=$data;
}else{
	$data=$_SESSION['papi_id_data'];
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>PAPIKostick Test</title>
	<meta charset="utf-8" />
    <meta http-equiv="expires" content="<?php echo date('r');?>" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="content-language" content="en" />
	<meta name="author" content="Cahya DSN" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
	<meta name="keywords" content="Psikotest, PAPI kostick, test, psychology" />
	<meta name="description" content="PAPI Kostick Test v1.0 Personality and Preference Inventory Test using PHP and MySQL by Cahya DSN" />
	<meta name="robots" content="index, follow" />
	<link rel="shortcut icon" href="<?php echo _ASSET;?>img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo _ASSET;?>css/w3/w3.css">
	<link rel="stylesheet" href="<?php echo _ASSET;?>css/w3/w3-theme-<?php echo $c;?>.css" media="all" id="papi_css">
	<?php if(defined('_ISONLINE') && _ISONLINE):?>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<?php endif;?>
	<style>body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif} td.incomplete {color:red !important;}</style>
	<script src="<?php echo _ASSET;?>js/jquery.min.php"></script>
  </head>
  <body>
  <div class="w3-top">
  <div class="w3-bar w3-theme-d5">
    <span class="w3-bar-item"># PAPI KOSTICK TEST v<?php echo $version;?></span>
    <a href="#" class="w3-bar-item w3-button">Home</a>
		<div class="w3-dropdown-hover">
		  <button class="w3-button">Themes</button>
		  <div class="w3-dropdown-content w3-white w3-card-4" id="theme">
				<?php
				$color=array("black","brown","pink","orange","amber","lime","green","teal","purple","indigo","blue","cyan");
				foreach($color as $c){
					echo "<a href='#' class='w3-bar-item w3-button w3-{$c} color' data-value='{$c}'> </a>";
				}
				?>	
			</div>
		</div>
	</div>
</div>  
<div class="w3-container">
   <form action='process.php' method='post' id='papi'>
	<input type="hidden" id="page" value="0">
    <div class="w3-card-4">
      <div class='w3-container w3-theme-l2'>
        <h2>&nbsp;</h2>
        <h2>PAPI Kostick Test</h1>
      </div>
      <div class=" w3-container" id='intro'>
        <div class='w3-row'>
           <div class="w3-col s12">
            <p>PAPI (<i>Personality and Preference Inventory</i>) adalah <i>personality assessment</i> atau alat tes penilaian kepribadian terkemuka yang digunakan oleh para profesional HR (<i>Human Resource</i>) dan manajer terkait untuk mengevaluasi perilaku dan gaya kerja individu pada semua tingkatan. <i>Personality and Preference Inventory</i> (PAPI) dibuat oleh Guru Besar Psikologi Industri dari Massachusetts, Amerika, yang bernama Dr. Max Martin Kostick pada awal tahun 1960-an. Versi Swedia lebih dulu diperkenalkan di awal 1980-an dan versi ini diperkenalkan pada tahun 1997 dengan versi <i>ipsatif</i> (PAPI-I) dan <i>normatif</i> (PAPI-N). Versi <i>ipsatif</i>, PAPI-I, dirancang untuk digunakan untuk pengembangan pribadi, sedangkan versi <i>normatif</i>, PAPI-N, yang dimaksudkan untuk digunakan untuk perbandingan dan seleksi. Dasar pemikiran untuk desain dan formulasi PAPI didasarkan pada penelitian dan teori kepribadian “<i>needs-press</i>” oleh Murray (1938)</p>
          </div>
          <div class="w3-col s12">
              <div class="w3-container  w3-padding">
              <h3>Personal Info</h3>
                <label>Name <sup>*</sup></label>
                <input class="w3-input w3-border w3-round" type="text" id='name' name='name' required>
                <label>Email <sup>*</sup></label>
                <input class="w3-input w3-border w3-round" type="email" id='email' name='email' required>
            <h6>&nbsp;</h6>    
            <p><b>note</b> : isi nama dengan Nama Lengkap, dan email dengan alamat email yang valid untuk pengiriman hasil test. Test HANYA bisa dilakukan satu kali, pastikan data yang Anda masukkan sudah tepat dan benar </p>
            <h6>&nbsp;</h6>
            <input type='button' id="btn1" value='next' class='w3-button w3-round-large w3-theme-d1 w3-right w3-margin-8'/>
              </div>
           </div>
        </div>
      </div>
      <div class='w3-container' id="instruct" style="display:none">
        <div class="w3-row">      
          <div class="w3-col s12">
            Berikut ini ada 90 nomor isian. Masing-masing nomor memiliki dua pernyataan (Pernyataan 1 & 2). Pilihlah salah satu pernyataan yang paling sesuai dengan diri Anda dengan men-check pada isian pada kolom yang sudah disediakan (Kolom Pilihan).
            Anda <b>HARUS</b> memilih salah satu yang dominan serta mengisi semua nomor.
          </div>
        </div>
		  <h6>&nbsp;</h6>
        </div>   
		<div class="w3-row" id="test" style="display:none">
			<table class="w3-table w3-striped">
			  <thead>
				<tr class="w3-theme-d3">
				  <th>No</th>
				  <th>Pilihan</th>
				  <th>Pernyataan</th>
				</tr>
			  </thead>
			  <tbody id='p0'>
				<?php
				$no=0;
				foreach($data as $d){
				  $c=rand()%2;
				  echo "
					<tr style='border-top:solid 1px #999;'>
					  <td rowspan='2' style='width:30px !important;'>".++$no."</td>
					  <td style='padding-left:16px !important;width:30px !important;' class='incomplete'><input type='radio' name='d[{$d->id}]' value='{$d->value1}' class='w3-radio' ".(isset($_GET['auto'])?($c==0?'checked ':''):'')."required /></td>
					  <td class='right'>{$d->question1}</td>
					</tr>
					<tr>					
					  <td><input type='radio' name='d[{$d->id}]' value='{$d->value2}' class='w3-radio' ".(isset($_GET['auto'])?($c==1?'checked ':''):'')."required /></td>
					  <td>{$d->question2}</td>
					</tr>
					   ";
				  if($no%$num_perpage==0) {
					echo "</tbody><tbody style='display:none' id='p".round($no/$num_perpage)."'>";
				  }
				}
				?>
			  </tbody>
			</table>
			<h6>&nbsp;</h6>
		</div>
    <footer class="w3-container w3-theme-l1" id='nav' style='display:none;'>
        <div class="w3-row">
		  <div class="w3-col s2 w3-padding">
			<button class="w3-button w3-round-large w3-theme-d1 w3-margin-8 w3-disabled" id="btn_kembali" disabled>Kembali</button>
			<button class="w3-button w3-round-large w3-theme-d1 w3-margin-8" id="btn_lanjut">Lanjut</button>
          </div>
          <div class="w3-col s10 w3-padding">
            <input type='submit' value='kirim' id='btn_kirim' class='w3-button w3-round-large w3-theme-d1 w3-right w3-margin-8 w3-disabled' disabled/>
		  </div>
		</div>       
	</footer>
    </div>	
	</form>
</div>
<h2>&nbsp;</h2>	
<div class="w3-bottom">
	<div class="w3-bar w3-theme-d4 w3-center">
		Papikostick Test v<?php echo $version;?> copyright &copy; 2017<?php echo (date('Y')>2017?date('-Y'):'');?> by <a href='mailto:cahyadsn@gmail.com'>cahya dsn</a><br />
	</div>
</div>
<div id="warning" class="w3-modal">
  <div class="w3-modal-content">
    <header class="w3-container w3-red"> 
      <span onclick="document.getElementById('warning').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
      <h2>Warning</h2>
    </header>
    <div class="w3-container">
      <p id='msg'></p>
    </div>
    <footer class="w3-container w3-border-top w3-padding-16 w3-light-grey">
      <a href='#' onclick="document.getElementById('warning').style.display='none'" class="w3-button w3-grey">close</a>
    </footer>
  </div>
</div>
<script src="<?php echo _ASSET;?>js/papi.v4.php?v=<?php echo md5(filemtime(_ASSET.'js/papi.v4.php'));?>"></script>     
</body>
</html>