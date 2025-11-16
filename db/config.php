<?php

$conn = mysqli_connect("localhost", "root", "", "assessment_database");
if (!$conn) {
    die("Connection Failed:" . mysqli_connect_error());
}
