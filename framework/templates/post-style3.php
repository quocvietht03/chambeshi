<?php
$post_id = get_the_ID();
$tags = get_the_terms($post_id, 'post_tag');

?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <div class="bt-post--image-wrap">
      <?php echo chambeshi_post_cover_featured_render($args['image-size']);
        if (!empty($tags)) {
          $first_tag = array_shift($tags);
          echo '<div class="bt-post--tags">';
          echo '<a href="' . get_tag_link($first_tag->term_id) . '">' . $first_tag->name . '</a>';
          echo '</div>';
        }
      ?>
      <?php echo chambeshi_author_w_avatar_style2(); ?>
    </div>
    <div class="bt-post--content">
      <?php
      echo chambeshi_post_title_render();
      ?>
      <div class="bt-post--excerpt">
        <?php echo get_the_excerpt(); ?>
      </div>
      <div class="bt-post--line-ellipse">
        <svg xmlns="http://www.w3.org/2000/svg" width="438" height="2" viewBox="0 0 438 2" fill="none">
          <path d="M219 2C339.95 2 438 1.55228 438 1C438 0.447715 339.95 0 219 0C98.0496 0 0 0.447715 0 1C0 1.55228 98.0496 2 219 2Z" fill="#D5D5D5" />
        </svg>
      </div>
      <div class="bt-post--infor">
        <?php
        echo chambeshi_post_publish_render_style2();
        echo chambeshi_post_button_render('Read More');
        ?>
      </div>

    </div>

  </div>
</article>