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

<h2>The assignments:</h2>
<ul>
    <?php
        $data = wpas_get_view_data();
        foreach($data["assignments"] as $assignment){
            ?>
            <li><a href="<?php echo get_permalink($assignment->ID);?>"><?php echo $assignment->post_title; ?></a></li>
            
            <?php
        }
    
    ?>
</ul>

<h2>The Projects:</h2>
<?php
if ( $data["projects"]->have_posts() ) {
	echo '<ul>';
	while ( $data["projects"]->have_posts() ) {
        $data["projects"]->the_post();
            ?>
            <li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
            
            <?php
        }
    wp_reset_postdata();
}
    ?>
</ul>

<?php get_footer();?>