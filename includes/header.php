<?php
$basePath = '/taskappolo/web/';
?>

<!DOCTYPE html>

<head>
    <title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Home :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />

    <!-- bootstrap-css -->
    <link rel="stylesheet" href="<?=$basePath?>css/bootstrap.min.css">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="<?=$basePath?>css/style.css" rel='stylesheet' type='text/css' />
    <link href="<?=$basePath?>css/style-responsive.css" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="<?=$basePath?>css/font.css" type="text/css" />
    <link href="<?=$basePath?>css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=$basePath?>css/morris.css" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="<?=$basePath?>css/monthly.css">
    <!-- //calendar -->

    <?php if (!empty($externalCss)) {
        echo $externalCss;
    }
    ?>
    <!-- //font-awesome icons -->
    <script src="<?=$basePath?>js/jquery2.0.3.min.js"></script>
    <script src="<?=$basePath?>js/raphael-min.js"></script>
    <script src="<?=$basePath?>js/morris.js"></script>
</head>

<body>
    <section id="container">