<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <title><?php wp_title(); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php wp_head(); ?>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top topnav justify-content-between mainNav" role="navigation">
        	<!-- Main logo -->
            <a href="#" class="navbar-brand" href="<?php echo home_url(); ?>">
				<?php bloginfo('name'); ?>
        	</a>
          	<!-- Collect the nav links, forms, and other content for toggling -->
          	<div class="navbar-collapse collapse" id="collapsingNavbar">
        		<?php
        		wp_nav_menu( array(
        		    'menu'       => 'main',
        		    'container'         => '',
            		'container_class'   => '',
            		'container_id'      => '',
        			'menu_class' => 'navbar-nav',
        			'walker' => new wp_bootstrap_navwalker())
        		);
        		?>
        		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar" aria-controls="collapsingNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
          	</div><!-- /.navbar-collapse -->
        </nav>