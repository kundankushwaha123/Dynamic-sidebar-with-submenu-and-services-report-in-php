<?php
session_start();

if (isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
	header("Location: Dashboard.php");
	exit();
} else {
	// Nahi toh login page par bhejo
	header("Location: login.php");
	exit();
}
