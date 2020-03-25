<?php 

 $conn = mysqli_connect("localhost","root","","phpdasar2");

 function query($query){

 	global $conn;
 	$result = mysqli_query ($conn, $query);
 	$rows = [];
 	while ( $row = mysqli_fetch_assoc ($result)) {
 		$rows []= $row;
 	}

 	return $rows;
 }


 function tambah($data){
 	global $conn;
 	//ambil data dari tiap elemen form
    	$nama = htmlspecialchars($data["nama"]);
    	$nrp = htmlspecialchars($data["nrp"]);
    	$email = htmlspecialchars($data["email"]);
    	$jurusan = htmlspecialchars($data["jurusan"]);

    	//$gambar = htmlspecialchars($data["gambar"]);
      //upload gambar
      $gambar = upload();
      if (!$gambar) {
       return false;
      }

    	//query data
       $query = "INSERT INTO mahasiswa values ('','$nama','$nrp','$email','$jurusan','$gambar')";
    	mysqli_query($conn, $query);

    	return mysqli_affected_rows ($conn);
 }


 function hapus ($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id ");
    return mysqli_affected_rows($conn);
 }

 function ubah ($data){

    global $conn;


    //ambil data dari tiap elemen form
        $id = $data["id"];
        $nama = htmlspecialchars($data["nama"]);
        $nrp = htmlspecialchars($data["nrp"]);
        $email = htmlspecialchars($data["email"]);
        $jurusan = htmlspecialchars($data["jurusan"]);
        $gambarlama = ($data["gambarlama"]);

        //cek apakah user pilih gambar baru atau tidak
        if ($_FILES['gambar']['error'] === 4 ) {
            $gambar = $gambarlama;
        } else {
             $gambar = upload();
        }

       // $gambar = htmlspecialchars($data["gambar"]);


        //query data
       $query = "UPDATE mahasiswa SET 
                nama = '$nama',
                nrp = '$nrp',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
              WHERE id = $id  
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows ($conn);
 }


 function cari ($keyword){
    
    $query = "SELECT * FROM mahasiswa 
                 WHERE
               nama LIKE '$keyword%' OR 
               nrp LIKE '$keyword%' OR
               jurusan LIKE '$keyword%'
               ";


           return query($query);    
 }




   function upload (){

    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $eror = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah tidak ada gambar yang di upload
    if ($eror === 4) {
        echo "<script>
                 alert('pilih gambar terlebih dahulu');
               </script>  
            ";
            return false;
    }

    //cek apakah yg  diupload adalah gambar
    $ekstensigambarvalid = ['jpg','jpeg','png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));

    if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
      
      echo "<script>
                 alert('yg anda upload bukan gambar');
               </script>  
            ";
            return false;
    }


    //cek jika ukurannya terlalu besar lebih dari 1 MB
    if ($ukuranfile > 1000000) {
      echo "<script>
                 alert('ukuran gambar trlalu besar');
               </script>  
            ";
            return false;
    }

    //generate nama gambar baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    //lolos pengecekan, gambar siap diupload
    move_uploaded_file($tmpName, 'img' . $namafilebaru);
    return $namafilebaru;
   }


   function registrasi($data){
          global$conn;  //ambil koneksi conn
           
           //strtolower untuk membuat textnya kecil semua
          //stripcslahser itu user tidak bisa input slash /
          $username = strtolower(stripcslashes($data["username"]));
          //mysqli_real_escape_string itu untuk bisa menyimpan kutip ke db, jika user bikin pass nya pke kutip
          $password = mysqli_real_escape_string($conn, $data["password"]);
          $password2 = mysqli_real_escape_string($conn, $data["password2"]);


          //cek username yg di input sudah ada atau belum
          $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");
          if (mysqli_fetch_assoc($result)) {
             echo "
                      <script>
                          alert('username sudah terdaftar');
                      </script> 
                  ";
                  return false; //berhentikan proses
          }

          //cek apakah user menginput password yg sama dengan password kedua atau tidak
          if ($password !== $password2) {
               echo "
                       <script>
                         alert('konfirmasi password tidak sesuai')
                       </script>
                    ";
                    return false; //berhentikan proses jika password tidak sesuai
          }
          //return 1; //ini jika pass 1 dan pass 2 sama

          //enkripsi password
          $password = password_hash($password, PASSWORD_DEFAULT);

          //tambahkan user baru ke database
          mysqli_query($conn, "INSERT INTO user VALUES ('', '$username','$password')");
          return mysqli_affected_rows($conn);




   }
 ?>