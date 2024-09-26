<?php
$post_id = get_the_ID();
$category = get_the_terms($post_id, 'category');
$icon_lively = get_field('icon_lively_service', $post_id);
?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
  <?php echo chambeshi_post_cover_featured_render($args['image-size']); ?>
    <div class="bt-post--infor">
      <div class="bt-post--icon-lively">
        <img src="<?php echo $icon_lively['url'] ?>" />
      </div>
      <?php echo chambeshi_post_title_render();
      ?>
      <div class="bt-post--excerpt">
        <?php echo get_the_excerpt(); ?>
      </div>
      <?php echo chambeshi_service_button_render('Explore More'); ?>
    </div>

  </div>

</article>