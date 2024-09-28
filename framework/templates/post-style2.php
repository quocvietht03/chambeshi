<?php
$post_id = get_the_ID();
$category = get_the_terms($post_id, 'category');

?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <div class="bt-post--image-wrap">
      <?php echo chambeshi_post_cover_featured_render($args['image-size']); ?>
    </div>
    <div class="bt-post--content">
      <?php echo chambeshi_author_w_avatar();
      echo chambeshi_post_title_render();
      ?>
      <div class="bt-post--excerpt">
        <?php echo get_the_excerpt(); ?>
      </div>
      <?php
      echo chambeshi_post_publish_render_style2();
      ?>
    </div>

  </div>
</article>