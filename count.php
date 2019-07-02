  <html>
  <body>
  <button onclick="myFunction()">Show images</button>
  

  <div id="myDIV">
     <?php 
    include 'config.php';
	$nRows = $pdo->query('SELECT COUNT(*) FROM picture')->fetchColumn(); 
	echo "There is a total of: " . $nRows . " images on this site"; 
	?>
  </div>


<script>
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
  </body>
  </html>





