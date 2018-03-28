<?php get_header();

include("template-parts/navigation.php");

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post(); 
        ?>

            <main class="main">
                <section class="section">
                    <div class="wysiwyg">
                        <?php the_content(); ?>
                    </div>
                </section>
            </main>

        <?php
    }
}
        

get_footer(); ?>