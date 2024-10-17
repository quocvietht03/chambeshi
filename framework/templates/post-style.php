<?php
$post_id = get_the_ID();
$tags = get_the_terms($post_id, 'post_tag');
?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <?php echo chambeshi_post_cover_featured_render($args['image-size']); ?>
    <div class="bt-post--content">
      <?php echo chambeshi_post_publish_render(); ?>

      <div class="bt-post--infor">
        <div class="bt-post--info">
          <div class="bt-post--tags">
            <?php
              if (!empty($tags)) {
                echo  '<a href="' . get_tag_link($tags[0]->term_id) . '">' . $tags[0]->name . '</a>';
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