<?php
    $install_url = 'http'.((empty($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off')?'':'s') .'://'. $_SERVER['SERVER_NAME'] .'/public/';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome to Vision Payroll Web-ERP</title>
        <base target="_blank">
        <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.min.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap-responsive.min.css" media="screen" />
        <style>
            body {
                font-family:sans-serif;
            }
            #intro {
                width:700px;
                margin-left:-390px;
                position:fixed;
                left:50%;
                top:60px;
                padding:10px 30px;
            }
            h1 {
                text-align:center;
            }
            .continue {
                padding:10px 0;
                text-align:center;
            }
        </style>
    </head>
    <body>
        <div id="intro" class="well">
            <h2>Welcome to Vision Payroll Web-ERP v2.1</h2>
            <p>Business is changing. It is becoming more dynamic and geographically dispersed. The traditional communication tools are being displaced. Information is required to be available 24x7 conveniently across phones, tablets, laptops and computers.<br> This is a modern business system that has adapted to the new environment. <br> Some things have changed since the last version, specifically pertaining to the system design and developement. Some of the new features in  <strong>Vision Payroll Web-ERP v2.1</strong> include.</p>
            <p>New Features:</p>
            <ol>
                <li>Object oriented development </li>
                <li>New Responsive design accesible across different devices <strong>mobile responsive</strong></li>
				<li>Enhanced security for your data with eight level encription</li>
				<li>Improved user interface design and navigation</li>
				<li>Improved user management and email support</li>
				<li>P9 KRA form and report submission added</li>
				<li>Flexible modular development framework</li>
            </ol>
            
			<p>
			
			<em>Please Note:</em> 
			Since this is a developmental release there <em>will</em> be bugs. If you uncover any please submitt your detailed bug report <a href="mailto:info@microvision.co.ke">here</a>.
			<br>Microvision Software Technologies holds the copyright to Vision webERP software.</p>
            
            <p><em>"Thankyou for choosing Vision Payroll Web-ERP, we endevor to make this the best payroll web-ERP project experience."</em> ~ Microvision Software Technologies</p>
            <div class="continue">
                <a class="btn btn-primary" href="public">Continue &raquo;</a>
            </div>
        </div>

        <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="public/assets/js/jquery-1.7.2.min.js"><\/script>')</script>

        <!-- This would be a good place to use a CDN version of jQueryUI if needed -->
        <script type="text/javascript" src="public/assets/js/bootstrap.min.js" ></script>
    </body>
</html>