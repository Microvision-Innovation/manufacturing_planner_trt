<?php

Assets::add_css(array( 'lib/fontawesome-free/css/all.min.css','lib/ionicons/css/ionicons.min.css','lib/typicons.font/typicons.css','lib/select2/css/select2.min.css','css/azia.css'));

Assets::add_js(array('lib/jquery/jquery.min.js','lib/bootstrap/js/bootstrap.bundle.min.js','lib/jquery.maskedinput/jquery.maskedinput.js','lib/select2/js/select2.min.js','lib/parsleyjs/parsley.min.js','js/azia.js','ajax_req.js'));


?>

<!--
Author: Edwin Ombego
-->

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="TRT Manufacturing Planner">
    <meta name="author" content="Edwin Ombego, ombego@gmail.com">

    <title>TRT Manufacturing Planner</title>

    <!-- css files -->
    <link rel="icon" href="<?php echo Template::theme_url('images/favicon.ico');?>" type="image/x-icon" />
    <?php echo Assets::css(); ?>


</head>
<body class="az-body">


