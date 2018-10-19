</div> <!-- CLOSE Page content -->

<footer class="footer">
    <div class="wrap">
        <?php dynamic_sidebar( 'Footer' ); ?>
    </div>
</footer>

<div id="page-overlay" class="overlay"></div>

<?php 
    global $version;
    if (!$version) 
    {
        ?>
            <!-- Debug post -->
                <div class="debug_vardump">
                    <?php var_dump($post) ?>
                </div>
        <?php
    }
?>

<?php
    wp_footer(); 
?>

</body>
</html>