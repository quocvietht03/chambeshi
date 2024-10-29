<?php
get_header();
get_template_part( 'framework/templates/site', 'titlebar');

?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss bt-elwg-project-grid--default">
		<div class="bt-container">
            <?php
                if( have_posts() ) {
                    ?>
                        <div class="bt-project-grid bt-image-effect">
                            <?php
                                while ( have_posts() ) : the_post();
                                    get_template_part( 'framework/templates/project-grid', 'style', array('image-size' => 'medium_large') );
                                endwhile;
                            ?>
                        </div>
                    <?php
                    chambeshi_paging_nav();
                } else {
                    get_template_part( 'framework/templates/post', 'none');
                }
            ?>
        </div>
	</div>
</main><!-- #main -->

<?php get_footer(); ?>
