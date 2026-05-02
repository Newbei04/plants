<?php
require_once 'qrlib.php';

$path = 'images/';
$file = $path . uniqid() . ".png";

$text = "somthing";

QRcode::png($text, $file, 'L', 10);

echo "<img src='" . $file . "'>";
?>


<video id="camera"></video>
<div id="qrcode"></div>
<input type="text" id="pass">

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<!-- <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> -->
<script type="text/javascript" src="https://rawcdn.githack.com/schmich/instascan-builds/master/instascan.min.js"></script>


<script type="text/javascript">
  let scanner = new Instascan.Scanner({
    video: document.getElementById("camera")
  });

  let resultado = document.getElementById("qrcode");
  let pass = document.getElementById("pass");
  scanner.addListener("scan", function(content) {
    resultado.innerText = content;
    pass.value = content;
    $.ajax({
      url: 'insert.php',
      type: 'POST',
      data: {
        qrcode: $('#pass').val(),
      },
      success: function() {

      }
    })
    scanner.stop();
  });
  Instascan.Camera.getCameras()
    .then(function(cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        resultado.innerText = "No cameras found.";
      }
    })
    .catch(function(e) {
      resultado.innerText = e;
    });
</script>