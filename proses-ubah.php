 <!-- Aplikasi CRUD
 ************************************************
 * Developer    : Indra Styawantoro
 * Company      : Indra Studio
 * Release Date : 1 Maret 2016
 * Website      : http://www.indrasatya.com, http://www.kulikoding.net
 * E-mail       : indra.setyawantoro@gmail.com
 * Phone        : +62-856-6991-9769
 * BBM          : 7679B9D9
 -->
 
<?php
// Panggil koneksi database
require_once "config/database.php";

if (isset($_POST['simpan'])) {
	if (isset($_POST['nis'])) {
		// ambil data hasil submit dari form
		$nis           = $_POST['nis'];
		$nama          = trim($_POST['nama']);
		$tempat_lahir  = trim($_POST['tempat_lahir']);

		$tanggal       = $_POST['tanggal_lahir'];
		$tgl           = explode('-',$tanggal);
		$tanggal_lahir = $tgl[2]."-".$tgl[1]."-".$tgl[0];

		$jenis_kelamin = $_POST['jenis_kelamin'];
		$agama         = $_POST['agama'];
		$alamat        = trim($_POST['alamat']);
		$no_telepon    = $_POST['no_telepon'];

		try {
			// sql statement untuk mengubah data pada tabel is_siswa
	        $query = "UPDATE is_siswa SET nama 			= :nama,
										tempat_lahir 	= :tempat_lahir,
										tanggal_lahir 	= :tanggal_lahir,
										jenis_kelamin 	= :jenis_kelamin,
										agama 			= :agama,
										alamat 			= :alamat,
										no_telepon 		= :no_telepon
								  WHERE nis 			= :nis";
	        // membuat prepared statements
	        $stmt = $pdo->prepare($query);

	        // mengikat parameter
			$stmt->bindParam(':nis', $nis);
			$stmt->bindParam(':nama', $nama);
			$stmt->bindParam(':tempat_lahir', $tempat_lahir);
			$stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
			$stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
			$stmt->bindParam(':agama', $agama);
			$stmt->bindParam(':alamat', $alamat);
			$stmt->bindParam(':no_telepon', $no_telepon);

			// eksekusi query
	        $stmt->execute();

	        // jika berhasil tampilkan pesan berhasil update data
			header('location: index.php?alert=3');

			// tutup koneksi database
	        $pdo = null;
		} catch (PDOException $e) {
			// tampilkan pesan kesalahan
	        echo "ada kesalahan : ".$e->getMessage();
		}
	}
}				
?>