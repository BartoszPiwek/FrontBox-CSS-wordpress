<footer class="footer">
    <div class="wrap">
        <?php dynamic_sidebar( 'Footer' ); ?>
    </div>
</footer>

<div id="js_overlay" class="overlay"></div>

<?php 

if (!$version) {
    ?>
        <div class="debug_vardump">
            <?php var_dump($post) ?>
        </div>  
    <?php
}

wp_footer(); 

?>

</body>
</html>