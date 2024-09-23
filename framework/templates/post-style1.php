<?php
$post_id = get_the_ID();
$category = get_the_terms($post_id, 'category');

?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <div class="bt-post--image-wrap">
      <?php echo chambeshi_post_cover_featured_render($args['image-size']); ?>
      <div class="bt-post--category">
        <?php
        if (!empty($category)) {
          echo  '<a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->name . '</a>';
        }
        ?>
      </div>
    </div>
    <div class="bt-post--content">
      <?php echo chambeshi_author_w_avatar_style2();
      echo chambeshi_post_title_render();
      echo chambeshi_post_publish_render_style2();
      ?>
      <div class="bt-post--line-ellipse">
        <svg xmlns="http://www.w3.org/2000/svg" width="438" height="2" viewBox="0 0 438 2" fill="none">
          <path d="M219 2C339.95 2 438 1.55228 438 1C438 0.447715 339.95 0 219 0C98.0496 0 0 0.447715 0 1C0 1.55228 98.0496 2 219 2Z" fill="#D5D5D5" />
        </svg>
      </div>
      <?php
      echo chambeshi_post_button_render('Read More');
      ?>
    </div>

  </div>
</article>