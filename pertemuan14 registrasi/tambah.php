
<?php 

    //koneksi dulu
    //$conn = mysqli_connect("localhost","root","","phpdasar2");
    require 'function.php';

    //cek apakh tombol submit sudah ditekan apa belum
    if (isset($_POST["submit"])) {
    	//var_dump($_POST);

    	//ambil data dari tiap elemen form

      //var_dump($_POST);
      //var_dump($_FILES);  die;

    	


    	//cek keberhasilan data disimpan atau tidak
        if (tambah ($_POST) > 0) {
        	echo "
                    <script> 
                            alert('data berhasil disimpan');
                            document.location.href = 'index.php';
                    </script>
        	     ";
        } else {
        	echo " <script> 
                            alert('data gagal disimpan');
                            document.location.href = 'index.php';
                    </script>
                  ";
        	
        }

    }

 ?>
<!DOCTYPE html>
<html>
<head>
	<title> Tambah data</title>
</head>
<body>

  <h1> Tambah Data Mahasiswa</h1>

  <form action="" method="post" enctype="multipart/form-data">
  	<ul>
  		<li>
  			<label for="nama"> Nama :</label>
  		    <input type="text" name="nama" id="nama" required> 
  		</li>
  		<li>
  			<label for="nrp"> NRP :</label>
  		    <input type="text" name="nrp" id="nrp" required> 
  		</li>
  		
  		<li>
  			<label for="email"> Email :</label>
  		    <input type="text" name="email" id="email" required> 
  		</li>
  		<li>
  			<label for="jurusan"> Jurusan :</label>
  		    <input type="text" name="jurusan" id="jurusan" required> 
  		</li>
  		<li>
  			<label for="gambar"> Gambar :</label>
  		    <input type="file" name="gambar" id="gambar" required> 
  		</li>
  		<li>
  			<button type="submit" name="submit"> Tambah </button>
  		</li>
  	</ul>
  	
  </form>
</body>
</html>