<?php
$post_id = get_the_ID();
$category = get_the_terms($post_id, 'project_categories');
?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <?php echo chambeshi_post_cover_featured_render($args['image-size']); ?>
    <div class="bt-post--content">
      <?php
      if (!empty($category)) {
        echo '<div class="bt-post--category">';
        echo  '<a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->name . '</a>';
        echo '</div>';
      }
      ?>
      <?php
      echo chambeshi_post_title_render();
      echo chambeshi_project_button_render(); ?>
    </div>
  </div>
</article>