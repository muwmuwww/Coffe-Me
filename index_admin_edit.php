<?php
session_start();
if (empty($_SESSION['username'])) {
	header("location:login.php?message=belum_login");
}
if ($_SESSION['level'] != "admin") {
	die("Anda Bukan Admin");
}

?>