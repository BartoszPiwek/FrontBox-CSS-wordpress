<?php get_header();

include("template-parts/navigation.php");

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post(); 
        ?>

            <main class="main">
                <section class="section">
                    <div class="wysiwyg">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Culpa dignissimos vel ab officia eum voluptas aut magni autem qui ratione. Quidem ab iure sed quae architecto! Impedit saepe eius eveniet.
                        <?php the_content(); ?>
                    </div>
                </section>
            </main>

        <?php
    }
}

get_footer(); ?>