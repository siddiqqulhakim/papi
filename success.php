<?php
include 'inc/config.php';
?>
<html>

<head>
  <title>Geekhunter PAPIKostick Test <?php echo $version; ?> [Bahasa Indonesia]</title>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo _ASSET; ?>img/favicon.ico" type="image/x-icon">
</head>
<style>
  body {
    text-align: center;
    padding: 40px 0;
    background: #EBF0F5;
  }

  h1 {
    color: #88B04B;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-weight: 900;
    font-size: 40px;
    margin-bottom: 10px;
  }

  p {
    color: #404F5E;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-size: 20px;
    margin: 0;
  }

  i {
    color: #9ABC66;
    font-size: 100px;
    line-height: 200px;
    margin-left: -15px;
  }

  .card {
    background: white;
    padding: 60px;
    border-radius: 4px;
    box-shadow: 0 2px 3px #C8D0D8;
    display: inline-block;
    margin: 0 auto;
  }
</style>

<body>
  <div class="card">
    <img src="<?php echo _ASSET; ?>img/GeekHunterLogoGreen.png"> <br /><br />
    <p>Terima kasih atas kesediaan dan partisipasinya dalam mengerjakan PAPIKostick Test. <br />Hasilnya sudah dikirimkan ke email kamu dan juga diteruskan ke team Geekhunter. <br />May the force be with you!</p> <br /><br />
    <a href="index.php" class="w3-bar-item w3-button">Klik disini untuk kembali...</a>
  </div>
</body>

</html>