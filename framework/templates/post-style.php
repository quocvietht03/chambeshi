<?php
$post_id = get_the_ID();
$category = get_the_terms($post_id, 'category');
?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <?php echo chambeshi_post_cover_featured_render($args['image-size']); ?>
    <div class="bt-post--content">
      <?php echo chambeshi_post_publish_render(); ?>

      <div class="bt-post--infor">
        <div class="bt-post--info">
          <div class="bt-post--category">
            <?php
            if (!empty($category)) {
              echo  '<a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->name . '</a>';
            }
            ?>
          </div>
          <?php echo chambeshi_reading_time_render(); ?>
        </div>
        <?php echo chambeshi_post_title_render();
        echo chambeshi_author_w_avatar();
        ?>
      </div>
    </div>
  </div>
</article>