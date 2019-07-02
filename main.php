<html>
<body>
	<head>
	<link rel="stylesheet" type="text/css" href="stilistika.css">
	</head>
<ul class="no-bullets">
  <li><button type='button' onclick='main.php'>Home</button></li>

  <div align="right">
  <?php
  session_start();
  #$_SESSION["user"] = "";
  #$_SESSION["loggedin"] = false;

  if(isset($_SESSION["loggedin"]) == false) {
  echo "<li><button type='button' onclick='login()''>Login</button></li>";
  echo "<li><button type='button' onclick='register()''>Register</button></li>";}
  if(isset($_SESSION["loggedin"])) {
  	echo "<li><button type='button' onclick='management()'>Management</button></li>";
  	echo "<li><button type='button' onclick='myAccount()'>My Account</button></li>";
  	echo "<li><a href ='logout.php'>Logout</a></li>";
  }
  ?>

</div>
</ul>
<div id="para" align="right">
</div> 

<!-- Scripts that are used to display all the tabs from ther right on the screen without refreshing the page -->

<script>
function login() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("para").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "loginfield.php", true);
  xhttp.send();
}
</script>

<script>
function register() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("para").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "register.php", true);
  xhttp.send();
}
</script>

<script>
function management() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("para").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "management.php", true);
  xhttp.send();
}
</script>

<script> 
function myAccount(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("para").innerHTML = this.responseTextt
		}
	};
	xhttp.open("POST", "myAccount.php", true);
	xhttp.send()
}
</script>

</body>
</html>
