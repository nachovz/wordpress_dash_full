<?php 
    get_header();
?>
<div class="container">
    <div class="jumbotron">
      <h1>This Is Wordpress</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="row">
            <?php
            global $post;
            $args = array();//array( 'posts_per_page' => 5, 'offset'=> 1, 'category' => 1 );
            
            $myposts = get_posts( $args );
            foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
                <div class="col-md-6 col-lg-4">
                	<div class="card">
                      <img class="card-img-top" src="..." alt="Card image cap">
                      <div class="card-block">
                        <h4 class="card-title"><?php the_title(); ?></h4>
                        <p class="card-text"><?php the_content();?></p>
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read more</a>
                      </div>
                    </div>
                </div>
            <?php endforeach; 
            wp_reset_postdata();?>
            </div>
            <div class="jumbotron">
                <h1>Courses</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <?php
                        global $post;
                        $argsC = array(
                            'post_type' => 'course'
                            );
                        
                        $mycourses = get_posts( $argsC );
                        foreach ( $mycourses as $post ) : setup_postdata( $post ); ?>
                            <div class="col-md-4">
                            	<div class="card">
                                  <img class="card-img-top" src="..." alt="Card image cap">
                                  <div class="card-block">
                                    <h4 class="card-title"><?php the_title(); ?></h4>
                                    <p class="card-text"><?php the_content();?></p>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read more</a>
                                  </div>
                                </div>
                            </div>
                        <?php endforeach; 
                        wp_reset_postdata();?>
                    </div>
                </div>
            </div>
       </div>
        <div class="col-sm-12 col-md-4">
            <div class="row">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div> 
</div>

<?php 
    get_footer();
?>