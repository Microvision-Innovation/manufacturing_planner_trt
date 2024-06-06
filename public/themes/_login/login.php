<?php echo theme_view('_header');
 ?>
 
    <?php
       die;
        echo isset($content) ? $content : Template::content();
    ?>

<?php echo theme_view('_footer'); ?>