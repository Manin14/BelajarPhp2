
<?php 

    //koneksi dulu
    //$conn = mysqli_connect("localhost","root","","phpdasar2");
    require 'function.php';

    //ambil data id di url
    $id = $_GET["id"];

    //query data mahasiswa berdasarkan id
    $mhs = query ("SELECT * FROM mahasiswa WHERE id=$id") [0];

    //cek apakh tombol submit sudah ditekan apa belum
    if (isset($_POST["submit"])) {
    	//var_dump($_POST);

    	//ambil data dari tiap elemen form

    	


    	//cek keberhasilan data diubah atau tidak
        if (ubah ($_POST) > 0) {
        	echo "
                    <script> 
                            alert('data berhasil diubah');
                            document.location.href = 'index.php';
                    </script>
        	     ";
        } else {
        	echo " <script> 
                            alert('data gagal diubah');
                            document.location.href = 'index.php';
                    </script>
                  ";
        	
        }

    }

 ?>
<!DOCTYPE html>
<html>
<head>
	<title> Ubah data</title>
</head>
<body>

  <h1> Ubah Data Mahasiswa</h1>

  <form action="" method="post" enctype="multipart-data">

    <input type="hidden" name="id" value="<?php echo$mhs["id"]; ?>">

     <input type="hidden" name="gambarlama" value="<?php echo$mhs["gambar"]; ?>">
  	<ul>
  		<li>
  			<label for="nama"> Nama :</label>
  		    <input type="text" name="nama" id="nama" required value="<?php echo $mhs["nama"]; ?>"> 
  		</li>
  		<li>
  			<label for="nrp"> NRP :</label>
  		    <input type="text" name="nrp" id="nrp" required value="<?php echo $mhs["nrp"]; ?>"> 
  		</li>
  		
  		<li>
  			<label for="email"> Email :</label>
  		    <input type="text" name="email" id="email" required value="<?php echo $mhs["email"]; ?>"> 
  		</li>
  		<li>
  			<label for="jurusan"> Jurusan :</label>
  		    <input type="text" name="jurusan" id="jurusan" required value="<?php echo $mhs["jurusan"]; ?>"> 
  		</li>
  		<li>
  			<label for="gambar"> Gambar :</label> <br>
        <img src="img/<?= $mhs['gambar']; ?> " width="50" > <br>
  		    <input type="file" name="gambar" id="gambar" > 
  		</li>
  		<li>
  			<button type="submit" name="submit"> Ubah </button>
  		</li>
  	</ul>
  	
  </form>
</body>
</html>