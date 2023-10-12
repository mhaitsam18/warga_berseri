<!DOCTYPE html>
<html>
<head>
	<title>Show Data Iuran</title>
</head>
<body>
		<?php 

			foreach ($iuran as $iuran_warga) {
				echo $iuran_warga->nik;
				echo $iuran_warga->nama;
				echo $iuran_warga->status_iuran;
			}

		 ?>
</body>
</html>