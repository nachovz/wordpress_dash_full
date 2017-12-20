<?php get_header();?>

<?php

global $post;

setup_postdata( $post );

//INCLUDE THE CATEGORY and TAGS

?>

<h1><?php the_title();?></h1>

<p>
    <?php the_content();?>
</p>

<?php get_footer();?>