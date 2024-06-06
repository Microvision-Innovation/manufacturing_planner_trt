<?php
    echo theme_view('login_header');
    echo isset($content) ? $content : Template::content();
    echo theme_view('login_footer', array('show' => false));
?>