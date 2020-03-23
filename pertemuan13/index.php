<?php 

		//koneksi dulu ke db
		 require 'function.php';

		 $msiswa = query ("SELECT * FROM mahasiswa ORDER BY id DESC");

		//ambil data dari tabel mahsiswa / query data
		//$result = mysqli_query($conn, "SELECT * FROM mahasiswa");
		//var_dump($result);
		//if ( !$result) { echo mysqli_eror($conn); }

		//ambil data dari objek result / fetch
		//mysqli_fetch_row()  //mengembalikan array numerik
		//mysqli_fetch_assoc() // mengembalikan aaray asosiativ
		//mysqli_fetch_array() //mengembalikan keduanya, numerik dan asosiativ , boros memori
		//mysqli_fetch_object() //

		//looping sebanyak data yang ada
		//while ($data = mysqli_fetch_assoc($result)) { var_dump($data); }

   //jika tombol cari di klik
		 if (isset($_POST["cari"])) {
		 	$msiswa = cari($_POST["keyword"]);
		 }
		
		
 ?>

<!DOCTYPE html>
<html>
<head>
	<title> data mahasiswa </title>
</head>
<body>

<h1> Daftar Mahasiswa </h1>


<a href="tambah.php"> Tambah Data </a>
<br><br/>

<form action="" method="post">
	<input type="text" name="keyword" size="40" autofocus="" placeholder="Masukan nama, nrp, atau jurusan" autocomplete="off">
	<button type="submit" name="cari"> Cari </button>
</form>

<br><br/>
<table border="1" cellpadding="10" cellspacing="0">

   <tr>
   	  <th> No.</th>
   	  <th> Aksi </th>
   	  <th> Gambar </th>
   	  <th> NRP</th>
   	  <th> Nama </th>
   	  <th> Email </th>
   	  <th> Jurusan</th>
   </tr>



<?php $i=1; ?>
<?php foreach ($msiswa as $row) : ?>
   <tr>
   	  <td> <?php echo $i; ?> </td>
		   	  <td>
		   	  	   <a href="ubah.php?id=<?= $row["id"]; ?>"> Ubah </a>  |
		   	  	   <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm(' Yakin '); ">  Hapus </a>
		   	  </td>
		   	  <td> <img src="img/<?php echo $row["gambar"] ?>" width="50"></td>
		   	  <td> <?php echo $row["nrp"]; ?></td>
		   	  <td> <?php echo $row["nama"]; ?> </td>
		   	  <td> <?php echo $row["email"]; ?> </td>
		   	  <td> <?php echo $row["jurusan"]; ?> </td>
   </tr>
   <?php $i++; ?>
<?php endforeach; ?>
   	
</table>

</body>
</html>