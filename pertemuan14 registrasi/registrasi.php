
<?php 

require 'function.php'; //panggil koneksi di file function.php

  if (isset($_POST["register"])) {  //jika tombol button registrasi di klik
  	   if (registrasi($_POST) > 0 ) {  //jalankan fungsi registrasi yg ada di file function.php
  	   	echo "
                 <script>
                 alert('user baru berhasil ditambahkan')
                 </script>
  	   	     ";
  	   } else {
  	   	  echo mysqli_error($conn);
  	   }
  }

 ?>
<!DOCTYPE html>
<html>
<head>
	<title> halaman registrasi</title>

	<style >
		label {
			display: block;
		}
	</style>
</head>
<body>

   <h1> Halaman Registrasi </h1>

   <form action="" method="post">
   	
   	<ul>
   		<li>
   			<label for="username"> Username : </label>
   			<input type="text" name="username" id="username">
   		</li>
   		<li>
   			<label for="password"> Password : </label>
   			<input type="Password" name="password" id="Password">
   		</li>
   		<li>
   			<label for="Password2"> Konfirmasi Password : </label>
   			<input type="Password" name="password2" id="Password2">
   		</li>
   		<li>
   			<button type="submit" name="register"> Register </button>
   		</li>
   	</ul>
   </form>
</body>
</html>