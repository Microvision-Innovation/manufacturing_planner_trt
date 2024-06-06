 <?php
    echo theme_view('header');
    echo theme_view('topbar');
    echo theme_view('sitenav');
    echo isset($content) ? $content : Template::content();
    echo theme_view('footer');
?>