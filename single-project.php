<?php
/*
 * Single Project
 */

get_header();
get_template_part('framework/templates/site', 'titlebar');

$bottom_content = '';
$id_elementor = '';
if ( function_exists('get_field') ) {
    $bottom_content = get_field('bottom_content', get_the_ID() );

    $id_elementor = get_field('project_templates_elementor', 'option');
}
?>

<main id="project-main" class="bt-project-main">
    <div class="bt-main-content-ss">
        <div class="bt-container">
            <div class="bt-project-post-row">
                <div class="bt-project-post-col">
                    <?php
                    while (have_posts()):
                        the_post();
                        ?>

                        <div class="bt-featured-image">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('full');
                            }
                            ?>
                        </div>

                        <div class="bt-main-content">
                            <div class="col-left">
                                <?php the_content(); ?>
                            </div>
                            <div class="col-right">
                                <div class="sticky-box">
                                    <div class="sticky-box--author">
                                        <div class="avatar">
                                            <?php
                                            $author_id = get_the_author_meta('ID');

                                            if (function_exists('get_field')) {
                                                $avatar = get_field('avatar', 'user_' . $author_id);
                                                $job = get_field('job', 'user_' . $author_id);
                                                $socials = get_field('socials', 'user_' . $author_id);
                                            } else {
                                                $avatar = array();
                                                $job = '';
                                                $socials = array();
                                            }

                                            if (!empty($avatar)) {
                                                echo '<img src="' . esc_url($avatar['url']) . '" alt="' . esc_attr($avatar['title']) . '" />';
                                            } else {
                                                echo get_avatar($author_id, 150);
                                            }
                                            ?>
                                        </div>
                                        <div class="name">
                                            <span>Author:</span>
                                            <?php the_author(); ?>
                                        </div>
                                    </div>
                                    
                                    <?php get_template_part('framework/templates/project', 'meta'); ?>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <?php if ( !empty($bottom_content) ) {
                            echo '<div class="bt-bottom-content">'. $bottom_content .'</div>';
                        } ?>

                        <?php

                        get_template_part('framework/templates/project', 'related');

                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php 
    if (!empty( $id_elementor)) {
        foreach ($id_elementor as $key => $e) {
            $id_template = $e->ID;
            echo do_shortcode('[elementor-template id="' . $id_template . '"]');   
        }
    }
    ?>

</main><!-- #main -->

<?php get_footer(); ?>