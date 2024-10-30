<?php

$posts_per_page = 3;
$sub_heading = '';
$heading = '';
$bottom_text = '';
if (function_exists('get_field')) {
    $project_related_posts = get_field('project_related_posts', 'option');

    $sub_heading = $project_related_posts['sub_heading'];
    $heading = $project_related_posts['heading'];
    $bottom_text = $project_related_posts['bottom_text'];

    $posts_per_page = !empty($project_related_posts['number_posts']) ? $project_related_posts['number_posts'] : 3;
}

$category_ids = [];
$categories = get_the_terms(get_the_ID(), 'project_categories');
if ( !empty($categories) ) {
    foreach ($categories as $category) {
        $category_ids[] = $category->term_id;
    }
}

$query_project = new WP_Query(array(
    'post_type' => 'project',
    'posts_per_page' => $posts_per_page,
    'post_status' => 'publish',
    'post__not_in' => array(get_the_ID()),
    'tax_query' => array(
        array(
            'taxonomy' => 'project_categories',
            'field' => 'term_id',
            'terms' => $category_ids,
        ),
    )
));

if ($query_project->have_posts()) {
    echo '<div class="bt-related-section">';

    if ( !empty($sub_heading) ) {
        echo '<div class="bt-subheading"><span>'. $sub_heading .'</span></div>';
    }

    if ( !empty($heading) ) {
        echo '<div class="bt-heading">'.$heading.'</div>';
    }

    ?>
    <div class="bt-elwg-project-grid--default">
        <?php
        if ($query_project->have_posts()) {
            ?>
            <div class="bt-project-grid">
                <?php
                while ($query_project->have_posts()):
                    $query_project->the_post();
                    get_template_part('framework/templates/project-grid', 'style', array('image-size' => 'full'));
                endwhile;
                ?>
            </div>
            <?php
        }
        ?>
    </div>
    <?php

    if ( !empty($bottom_text) ) {
        echo '<div class="bt-bottom-text">'.$bottom_text.'</div>';
    }

    echo '</div>';
    wp_reset_postdata();
}

?>