<?php
 
    Assets::add_js(array('js/libs/modernizr.js') );

    // Core stylesheets do not remove -->    
    Assets::add_css( array('css/bootstrap.min.css', 'css/font-awesome.min.css','css/AdminLTE.css'));
    
    //main css
    Assets::add_css(array('css/main.css'));
    
    //plugin stylesheets
   // Assets::add_css(array('plugins/jquery.qtip.css','plugins/tipuesearch.css','plugins/fullcalendar.css','plugins/uniform.default.css'));
    
     
    $inline  = '$(".dropdown-toggle").dropdown();';
    $inline .= '$(".tooltips").tooltip();';

   // Assets::add_js( $inline, 'inline' );
  echo Assets::css();
?>


<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Vehicle Registry | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">





	
	