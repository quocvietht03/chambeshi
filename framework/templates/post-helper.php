<?php
/* Count post view. */
if (!function_exists('chambeshi_set_count_view')) {
  function chambeshi_set_count_view()
  {
    $post_id = get_the_ID();

    if (is_single() && !empty($post_id) && !isset($_COOKIE['chambeshi_post_view_' . $post_id])) {
      $views = get_post_meta($post_id, '_post_count_views', true);
      $views = $views ? $views : 0;
      $views++;

      update_post_meta($post_id, '_post_count_views', $views);

      /* set cookie. */
      setcookie('chambeshi_post_view_' . $post_id, $post_id, time() * 20, '/');
    }
  }
}
add_action('wp', 'chambeshi_set_count_view');

/* Post count view */
if (!function_exists('chambeshi_get_count_view')) {
  function chambeshi_get_count_view()
  {
    $post_id = get_the_ID();
    $views = get_post_meta($post_id, '_post_count_views', true);

    $views = $views ? $views : 0;
    $label = $views > 1 ? esc_html__('Views', 'chambeshi') : esc_html__('View', 'chambeshi');
    return $views . ' ' . $label;
  }
}

/* Post Reading */
if (!function_exists('chambeshi_reading_time_render')) {
  function chambeshi_reading_time_render()
  {
    $content = get_the_content();
    $word_count = str_word_count(strip_tags($content));
    $readingtime = ceil($word_count / 200);

    return '<div class="bt-reading-time">' . $readingtime . ' min read' . '</div>';
  }
}

/* Single Post Title */
if (!function_exists('chambeshi_single_post_title_render')) {
  function chambeshi_single_post_title_render()
  {
    ob_start();
?>
    <h3 class="bt-post--title">
      <?php the_title(); ?>
    </h3>
  <?php

    return ob_get_clean();
  }
}

/* Post Title */
if (!function_exists('chambeshi_post_title_render')) {
  function chambeshi_post_title_render()
  {
    ob_start();
  ?>
    <h3 class="bt-post--title">
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>
    </h3>
    <?php

    return ob_get_clean();
  }
}

/* Post Featured */
if (!function_exists('chambeshi_post_featured_render')) {
  function chambeshi_post_featured_render($image_size = 'full')
  {
    ob_start();

    if (is_single()) {
    ?>
      <div class="bt-post--featured">
        <div class="bt-cover-image">
          <?php if (has_post_thumbnail()) {
            the_post_thumbnail($image_size);
          } ?>
        </div>
      </div>
    <?php
    } else {
    ?>
      <div class="bt-post--featured">
        <a href="<?php the_permalink(); ?>">
          <div class="bt-cover-image">
            <?php if (has_post_thumbnail()) {
              the_post_thumbnail($image_size);
            } ?>
          </div>
        </a>
      </div>
    <?php

    }

    return ob_get_clean();
  }
}

/* Post Cover Featured */
if (!function_exists('chambeshi_post_cover_featured_render')) {
  function chambeshi_post_cover_featured_render($image_size = 'full')
  {
    ob_start();
    ?>
    <div class="bt-post--featured">
      <a href="<?php the_permalink(); ?>">
        <div class="bt-cover-image">
          <?php
          if (has_post_thumbnail()) {
            the_post_thumbnail($image_size);
          }
          ?>
        </div>
      </a>
    </div>
  <?php

    return ob_get_clean();
  }
}

/* Post Publish */
if (!function_exists('chambeshi_post_publish_render')) {
  function chambeshi_post_publish_render()
  {
    ob_start();

  ?>
    <div class="bt-post--publish">
      <div class="bt-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M8 14.5C8.55228 14.5 9 14.0523 9 13.5C9 12.9477 8.55228 12.5 8 12.5C7.44772 12.5 7 12.9477 7 13.5C7 14.0523 7.44772 14.5 8 14.5Z" fill="#4F6A35" />
          <path d="M8 18.5C8.55228 18.5 9 18.0523 9 17.5C9 16.9477 8.55228 16.5 8 16.5C7.44772 16.5 7 16.9477 7 17.5C7 18.0523 7.44772 18.5 8 18.5Z" fill="#4F6A35" />
          <path d="M12 14.5C12.5523 14.5 13 14.0523 13 13.5C13 12.9477 12.5523 12.5 12 12.5C11.4477 12.5 11 12.9477 11 13.5C11 14.0523 11.4477 14.5 12 14.5Z" fill="#4F6A35" />
          <path d="M12 18.5C12.5523 18.5 13 18.0523 13 17.5C13 16.9477 12.5523 16.5 12 16.5C11.4477 16.5 11 16.9477 11 17.5C11 18.0523 11.4477 18.5 12 18.5Z" fill="#4F6A35" />
          <path d="M16 14.5C16.5523 14.5 17 14.0523 17 13.5C17 12.9477 16.5523 12.5 16 12.5C15.4477 12.5 15 12.9477 15 13.5C15 14.0523 15.4477 14.5 16 14.5Z" fill="#4F6A35" />
          <path d="M16 18.5C16.5523 18.5 17 18.0523 17 17.5C17 16.9477 16.5523 16.5 16 16.5C15.4477 16.5 15 16.9477 15 17.5C15 18.0523 15.4477 18.5 16 18.5Z" fill="#4F6A35" />
          <path fill-rule="evenodd" clip-rule="evenodd" d="M1.25 19.5V6.5C1.25 5.505 1.645 4.552 2.348 3.848C3.052 3.145 4.005 2.75 5 2.75H8.25V5.5C8.25 5.914 8.586 6.25 9 6.25C9.414 6.25 9.75 5.914 9.75 5.5V2.75H16.25V5.5C16.25 5.914 16.586 6.25 17 6.25C17.414 6.25 17.75 5.914 17.75 5.5V2.75H19C19.995 2.75 20.948 3.145 21.652 3.848C22.355 4.552 22.75 5.505 22.75 6.5V19.5C22.75 20.495 22.355 21.448 21.652 22.152C20.948 22.855 19.995 23.25 19 23.25H5C4.005 23.25 3.052 22.855 2.348 22.152C1.645 21.448 1.25 20.495 1.25 19.5ZM2.75 9.75V19.5C2.75 20.097 2.987 20.669 3.409 21.091C3.831 21.513 4.403 21.75 5 21.75H19C19.597 21.75 20.169 21.513 20.591 21.091C21.013 20.669 21.25 20.097 21.25 19.5V9.75H2.75Z" fill="#4F6A35" />
          <path fill-rule="evenodd" clip-rule="evenodd" d="M15.25 1.5C15.25 1.086 15.586 0.75 16 0.75C16.414 0.75 16.75 1.086 16.75 1.5V5.5C16.75 5.914 16.414 6.25 16 6.25C15.586 6.25 15.25 5.914 15.25 5.5V1.5Z" fill="#4F6A35" />
          <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25 1.5C7.25 1.086 7.586 0.75 8 0.75C8.414 0.75 8.75 1.086 8.75 1.5V5.5C8.75 5.914 8.414 6.25 8 6.25C7.586 6.25 7.25 5.914 7.25 5.5V1.5Z" fill="#4F6A35" />
        </svg>
      </div>
      <div class="bt-date">
        <span><?php echo get_the_date('d'); ?></span>
        <span><?php echo get_the_date('M, Y'); ?></span>
      </div>
    </div>
  <?php

    return ob_get_clean();
  }
}
if (!function_exists('chambeshi_post_publish_render_style2')) {
  function chambeshi_post_publish_render_style2()
  {
    ob_start();

  ?>
    <div class="bt-post--publish">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M8 14.5C8.55228 14.5 9 14.0523 9 13.5C9 12.9477 8.55228 12.5 8 12.5C7.44772 12.5 7 12.9477 7 13.5C7 14.0523 7.44772 14.5 8 14.5Z" fill="#4F6A35" />
        <path d="M8 18.5C8.55228 18.5 9 18.0523 9 17.5C9 16.9477 8.55228 16.5 8 16.5C7.44772 16.5 7 16.9477 7 17.5C7 18.0523 7.44772 18.5 8 18.5Z" fill="#4F6A35" />
        <path d="M12 14.5C12.5523 14.5 13 14.0523 13 13.5C13 12.9477 12.5523 12.5 12 12.5C11.4477 12.5 11 12.9477 11 13.5C11 14.0523 11.4477 14.5 12 14.5Z" fill="#4F6A35" />
        <path d="M12 18.5C12.5523 18.5 13 18.0523 13 17.5C13 16.9477 12.5523 16.5 12 16.5C11.4477 16.5 11 16.9477 11 17.5C11 18.0523 11.4477 18.5 12 18.5Z" fill="#4F6A35" />
        <path d="M16 14.5C16.5523 14.5 17 14.0523 17 13.5C17 12.9477 16.5523 12.5 16 12.5C15.4477 12.5 15 12.9477 15 13.5C15 14.0523 15.4477 14.5 16 14.5Z" fill="#4F6A35" />
        <path d="M16 18.5C16.5523 18.5 17 18.0523 17 17.5C17 16.9477 16.5523 16.5 16 16.5C15.4477 16.5 15 16.9477 15 17.5C15 18.0523 15.4477 18.5 16 18.5Z" fill="#4F6A35" />
        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.25 19.5V6.5C1.25 5.505 1.645 4.552 2.348 3.848C3.052 3.145 4.005 2.75 5 2.75H8.25V5.5C8.25 5.914 8.586 6.25 9 6.25C9.414 6.25 9.75 5.914 9.75 5.5V2.75H16.25V5.5C16.25 5.914 16.586 6.25 17 6.25C17.414 6.25 17.75 5.914 17.75 5.5V2.75H19C19.995 2.75 20.948 3.145 21.652 3.848C22.355 4.552 22.75 5.505 22.75 6.5V19.5C22.75 20.495 22.355 21.448 21.652 22.152C20.948 22.855 19.995 23.25 19 23.25H5C4.005 23.25 3.052 22.855 2.348 22.152C1.645 21.448 1.25 20.495 1.25 19.5ZM2.75 9.75V19.5C2.75 20.097 2.987 20.669 3.409 21.091C3.831 21.513 4.403 21.75 5 21.75H19C19.597 21.75 20.169 21.513 20.591 21.091C21.013 20.669 21.25 20.097 21.25 19.5V9.75H2.75Z" fill="#4F6A35" />
        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.25 1.5C15.25 1.086 15.586 0.75 16 0.75C16.414 0.75 16.75 1.086 16.75 1.5V5.5C16.75 5.914 16.414 6.25 16 6.25C15.586 6.25 15.25 5.914 15.25 5.5V1.5Z" fill="#4F6A35" />
        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25 1.5C7.25 1.086 7.586 0.75 8 0.75C8.414 0.75 8.75 1.086 8.75 1.5V5.5C8.75 5.914 8.414 6.25 8 6.25C7.586 6.25 7.25 5.914 7.25 5.5V1.5Z" fill="#4F6A35" />
      </svg>
      <?php echo get_the_date(get_option('date_format')); ?>
    </div>
  <?php

    return ob_get_clean();
  }
}
/* Post Short Meta */
if (!function_exists('chambeshi_post_short_meta_render')) {
  function chambeshi_post_short_meta_render()
  {
    ob_start();

  ?>
    <div class="bt-post--meta">
      <?php
      the_terms(get_the_ID(), 'category', '<div class="bt-post-cat">', ', ', '</div>');
      echo chambeshi_reading_time_render();
      ?>
    </div>
  <?php

    return ob_get_clean();
  }
}

/* Post Meta */
if (!function_exists('chambeshi_post_meta_render')) {
  function chambeshi_post_meta_render()
  {
    ob_start();
    $author_id = get_the_author_meta('ID');
    if (function_exists('get_field')) {
      $avatar = get_field('avatar', 'user_' . $author_id);
    } else {
      $avatar = array();
    }
  ?>
    <ul class="bt-post--meta">
      <li class="bt-meta bt-meta--author">
        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
          <div class="bt-avatar-author">
            <?php if (!empty($avatar)) {
              echo '<img src="' . esc_url($avatar['url']) . '" alt="' . esc_attr($avatar['title']) . '" />';
            } else {
              echo get_avatar($author_id, 150);
            } ?>
          </div>
          <?php echo '<span>' . esc_html__('By', 'chambeshi') . '</span> ' . get_the_author(); ?>
        </a>
      </li>
      <li class="bt-meta bt-meta--view">
        <a href="<?php echo get_the_permalink(); ?>">
          <?php echo chambeshi_reading_time_render(); ?>
        </a>
      </li>
      <li class="bt-meta bt-meta--comment">
        <a href="<?php comments_link(); ?>">
          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
            <path d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16V352c0 8.8 7.2 16 16 16h96zm48 124l-.2 .2-5.1 3.8-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3V474.7v-6.4V468v-4V416H112 64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H448c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H309.3L208 492z" />
          </svg>
          <?php comments_number(esc_html__('0 Comments', 'chambeshi'), esc_html__('1 Comment', 'chambeshi'), esc_html__('% Comments', 'chambeshi')); ?>
        </a>
      </li>
    </ul>
    <?php
    return ob_get_clean();
  }
}

/* Post Category */
if (!function_exists('chambeshi_post_category_render')) {
  function chambeshi_post_category_render()
  {
    $post_id = get_the_ID();
    $categorys = get_the_terms($post_id, 'category');
    if ($categorys && !is_wp_error($categorys)) {
    ?>
      <div class="bt-post--category">
        <?php
        foreach ($categorys as $category) {
          echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
        }
        ?>
      </div>
    <?php
    }
  }
}

/* Post Content */
if (!function_exists('chambeshi_post_content_render')) {
  function chambeshi_post_content_render()
  {

    ob_start();

    if (is_single()) {
    ?>
      <div class="bt-post--content">
        <?php
        the_content();
        wp_link_pages(array(
          'before' => '<div class="page-links">' . esc_html__('Pages:', 'chambeshi'),
          'after' => '</div>',
        ));
        ?>
      </div>
    <?php
    } else {
    ?>
      <div class="bt-post--excerpt">
        <?php echo get_the_excerpt(); ?>
      </div>
    <?php
    }

    return ob_get_clean();
  }
}

/* Post tag */
if (!function_exists('chambeshi_tags_render')) {
  function chambeshi_tags_render()
  {
    ob_start();
    if (has_tag()) {
    ?>
      <div class="bt-post-tags">
        <svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M5.65527 3.85714C5.65527 3.06473 5.01911 2.42857 4.2267 2.42857C3.43429 2.42857 2.79813 3.06473 2.79813 3.85714C2.79813 4.64955 3.43429 5.28571 4.2267 5.28571C5.01911 5.28571 5.65527 4.64955 5.65527 3.85714ZM17.5638 10.2857C17.5638 10.6652 17.4075 11.0335 17.1508 11.2902L11.6709 16.7812C11.403 17.0379 11.0347 17.1942 10.6553 17.1942C10.2758 17.1942 9.90751 17.0379 9.65081 16.7812L1.6709 8.79018C1.1017 8.23214 0.655273 7.14955 0.655273 6.35714V1.71429C0.655273 0.933035 1.30259 0.285713 2.08384 0.285713H6.7267C7.51911 0.285713 8.6017 0.732143 9.1709 1.30134L17.1508 9.27009C17.4075 9.53795 17.5638 9.90625 17.5638 10.2857ZM21.8495 10.2857C21.8495 10.6652 21.6932 11.0335 21.4365 11.2902L15.9566 16.7812C15.6888 17.0379 15.3205 17.1942 14.941 17.1942C14.3606 17.1942 14.0705 16.9263 13.691 16.5357L18.9365 11.2902C19.1932 11.0335 19.3495 10.6652 19.3495 10.2857C19.3495 9.90625 19.1932 9.53795 18.9365 9.27009L10.9566 1.30134C10.3874 0.732143 9.30483 0.285713 8.51242 0.285713H11.0124C11.8048 0.285713 12.8874 0.732143 13.4566 1.30134L21.4365 9.27009C21.6932 9.53795 21.8495 9.90625 21.8495 10.2857Z" fill="#C2A74E" />
        </svg>

        <?php
        if (has_tag()) {
          the_tags('', '|', '');
        }
        ?>
      </div>
    <?php
    }
    return ob_get_clean();
  }
}

/* Post share */
if (!function_exists('chambeshi_share_render')) {
  function chambeshi_share_render()
  {

    $social_item = array();
    $social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-linkedin" data-toggle="tooltip" title="' . esc_attr__('Linkedin', 'chambeshi') . '" href="https://www.linkedin.com/shareArticle?url=' . get_the_permalink() . '">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                            <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
                          </svg>
                        </a>
                      </li>';
    $social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-facebook" data-toggle="tooltip" title="' . esc_attr__('Facebook', 'chambeshi') . '" href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                            <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
                          </svg>
                        </a>
                      </li>';

    $social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-google-plus" data-toggle="tooltip" title="' . esc_attr__('Google Plus', 'chambeshi') . '" href="https://plus.google.com/share?url=' . get_the_permalink() . '">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 488 512">
                            <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/>
                          </svg>
                        </a>
                      </li>';
    $social_item[] = '<li>
                      <a target="_blank" data-btIcon="fa fa-twitter" data-toggle="tooltip" title="' . esc_attr__('Twitter', 'chambeshi') . '" href="https://twitter.com/share?url=' . get_the_permalink() . '">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                          <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                        </svg>
                      </a>
                    </li>';


    ob_start();
    if (is_singular('post') && has_tag()) { ?>
      <div class="bt-post-share">
        <?php if (!empty($social_item)) {
          echo '<span>' . esc_html__('Share: ', 'chambeshi') . '</span><ul>' . implode(' ', $social_item) . '</ul>';
        } ?>
      </div>

    <?php } elseif (!empty($social_item)) { ?>

      <div class="bt-post-share">
        <span><?php echo esc_html__('Share: ', 'chambeshi'); ?></span>
        <ul><?php echo implode(' ', $social_item); ?></ul>
      </div>
    <?php }

    return ob_get_clean();
  }
}

/* Post Button */
if (!function_exists('chambeshi_post_button_render')) {
  function chambeshi_post_button_render($text)
  { ?>
    <div class="bt-post--button">
      <a href="<?php echo esc_url(get_permalink()) ?>">
        <span> <?php echo esc_html($text) ?> </span>
        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
          <path d="M19.8686 9.88137L13.7436 3.75637C13.5786 3.59698 13.3576 3.50878 13.1281 3.51078C12.8987 3.51277 12.6793 3.60479 12.517 3.76702C12.3548 3.92926 12.2628 4.14872 12.2608 4.37814C12.2588 4.60756 12.347 4.82859 12.5064 4.99362L17.1378 9.62499H1.75C1.51794 9.62499 1.29538 9.71718 1.13128 9.88127C0.967187 10.0454 0.875 10.2679 0.875 10.5C0.875 10.7321 0.967187 10.9546 1.13128 11.1187C1.29538 11.2828 1.51794 11.375 1.75 11.375H17.1378L12.5064 16.0064C12.4228 16.0871 12.3561 16.1836 12.3103 16.2904C12.2644 16.3971 12.2403 16.512 12.2393 16.6281C12.2383 16.7443 12.2604 16.8595 12.3044 16.9671C12.3484 17.0746 12.4134 17.1723 12.4955 17.2545C12.5777 17.3366 12.6754 17.4016 12.7829 17.4456C12.8905 17.4896 13.0057 17.5117 13.1219 17.5107C13.238 17.5097 13.3529 17.4856 13.4596 17.4397C13.5664 17.3938 13.6629 17.3272 13.7436 17.2436L19.8686 11.1186C20.0327 10.9545 20.1248 10.732 20.1248 10.5C20.1248 10.268 20.0327 10.0455 19.8686 9.88137Z" fill="#4F6A35" />
        </svg>
      </a>
    </div>
  <?php }
}
/* Service Button */
if (!function_exists('chambeshi_service_button_render')) {
  function chambeshi_service_button_render($text)
  { ?>
    <div class="bt-post--button bt-button-hover-secondary">
      <a href="<?php echo esc_url(get_permalink()) ?>">
        <span> <?php echo esc_html($text) ?> </span>
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="#FFE17F">
          <g clip-path="url(#clip0_23_10128)">
            <path d="M10.9999 0C4.92482 0 0 4.92482 0 10.9999C0 17.075 4.92482 22.0001 10.9999 22.0001C17.075 22.0001 22.0001 17.075 22.0001 10.9999C21.9932 4.92764 17.0724 0.00684812 10.9999 0ZM10.9999 20.8999C5.53229 20.8999 1.09993 16.4676 1.09993 10.9999C1.09993 5.53229 5.53229 1.09993 10.9999 1.09993C16.4676 1.09993 20.8999 5.53229 20.8999 10.9999C20.8937 16.465 16.465 20.8937 10.9999 20.8999Z" />
            <path d="M9.71117 6.73596C9.48236 6.53596 9.13492 6.55932 8.93492 6.78793C8.73511 7.01674 8.75848 7.36418 8.98708 7.56419L12.9139 10.9999L8.98688 14.4359C8.75807 14.6359 8.73491 14.9833 8.93471 15.212C9.13472 15.4408 9.48216 15.4641 9.71097 15.2641L14.1109 11.4141C14.2303 11.3097 14.2988 11.1587 14.2988 10.9999C14.2988 10.8412 14.2303 10.6904 14.1109 10.5858L9.71117 6.73596Z" />
          </g>
          <defs>
            <clipPath id="clip0_23_10128">
              <rect width="22" height="22" fill="white" />
            </clipPath>
          </defs>
        </svg>
      </a>
    </div>
  <?php }
}
/* Project Button */
if (!function_exists('chambeshi_project_button_render')) {
  function chambeshi_project_button_render()
  { ?>
    <a href="<?php echo esc_url(get_permalink()) ?>" class="bt-post--button">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="white">
        <path d="M20.8141 10.3519L14.3974 3.93525C14.2245 3.76827 13.993 3.67588 13.7526 3.67797C13.5123 3.68006 13.2824 3.77646 13.1124 3.94642C12.9425 4.11638 12.8461 4.34629 12.844 4.58663C12.8419 4.82698 12.9343 5.05853 13.1013 5.23142L17.9532 10.0833H1.83268C1.58957 10.0833 1.35641 10.1799 1.1845 10.3518C1.01259 10.5237 0.916016 10.7569 0.916016 11C0.916016 11.2431 1.01259 11.4763 1.1845 11.6482C1.35641 11.8201 1.58957 11.9167 1.83268 11.9167H17.9532L13.1013 16.7686C13.0137 16.8531 12.9439 16.9543 12.8958 17.0661C12.8478 17.178 12.8225 17.2983 12.8215 17.42C12.8204 17.5417 12.8436 17.6624 12.8897 17.775C12.9358 17.8877 13.0038 17.99 13.0899 18.0761C13.176 18.1622 13.2783 18.2302 13.391 18.2763C13.5036 18.3224 13.6243 18.3456 13.746 18.3446C13.8678 18.3435 13.988 18.3182 14.0999 18.2702C14.2117 18.2221 14.3129 18.1523 14.3974 18.0648L20.8141 11.6481C20.9859 11.4762 21.0825 11.2431 21.0825 11C21.0825 10.7569 20.9859 10.5238 20.8141 10.3519Z" />
      </svg>
    </a>
  <?php }
}
/* Author Icon */
if (!function_exists('chambeshi_author_icon_render')) {
  function chambeshi_author_icon_render()
  { ?>
    <div class="bt-post-author-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
        <path d="M6.66634 5.83333C6.66634 7.67428 8.15876 9.16667 9.99967 9.16667C11.8406 9.16667 13.333 7.67428 13.333 5.83333C13.333 3.99238 11.8406 2.5 9.99967 2.5C8.15876 2.5 6.66634 3.99238 6.66634 5.83333Z" stroke="#C2A74E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M9.99967 11.6667C13.2213 11.6667 15.833 14.2784 15.833 17.5001H4.16634C4.16634 14.2784 6.77801 11.6667 9.99967 11.6667Z" stroke="#C2A74E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      <h4 class="bt-post-author-icon--name"> <?php echo esc_html__('By', 'chambeshi') . ' ' . get_the_author(); ?> </h4>
    </div>
  <?php }
}
/* Author with avatar */
if (!function_exists('chambeshi_author_w_avatar')) {
  function chambeshi_author_w_avatar()
  {
    $author_id = get_the_author_meta('ID');
    if (function_exists('get_field')) {
      $avatar = get_field('avatar', 'user_' . $author_id);
    } else {
      $avatar = array();
    }
  ?>
    <div class="bt-post-author-w-avatar">
      <div class="bt-post-author-w-avatar--thumbnail">
        <?php
        if (!empty($avatar)) {
          echo '<img src="' . esc_url($avatar['url']) . '" alt="' . esc_attr($avatar['title']) . '" />';
        } else {
          echo get_avatar($author_id, 150);
        }
        ?>
      </div>

      <h4 class="bt-post-author-w-avatar--name"> <span><?php echo esc_html__('By ', 'chambeshi') ?></span> <?php the_author(); ?> </h4>
    </div>
  <?php }
}
if (!function_exists('chambeshi_author_w_avatar_style2')) {
  function chambeshi_author_w_avatar_style2()
  {
    $author_id = get_the_author_meta('ID');
    if (function_exists('get_field')) {
      $avatar = get_field('avatar', 'user_' . $author_id);
    } else {
      $avatar = array();
    }
  ?>
    <div class="bt-post-author-w-avatar">
      <div class="bt-post-author-w-avatar--thumbnail">
        <?php
        if (!empty($avatar)) {
          echo '<img src="' . esc_url($avatar['url']) . '" alt="' . esc_attr($avatar['title']) . '" />';
        } else {
          echo get_avatar($author_id, 150);
        }
        ?>
      </div>

      <h4 class="bt-post-author-w-avatar--name"> <span><?php echo esc_html__('Posted by ', 'chambeshi') ?></span> <?php the_author(); ?> </h4>
    </div>
  <?php }
}
/* Author */
if (!function_exists('chambeshi_author_render')) {
  function chambeshi_author_render()
  {
    $author_id = get_the_author_meta('ID');
    $desc = get_the_author_meta('description');

    if (function_exists('get_field')) {
      $avatar = get_field('avatar', 'user_' . $author_id);
      $job = get_field('job', 'user_' . $author_id);
      $socials = get_field('socials', 'user_' . $author_id);
    } else {
      $avatar = array();
      $job = '';
      $socials = array();
    }

    ob_start();
  ?>
    <div class="bt-post-author">
      <div class="bt-post-author--avatar">
        <?php
        if (!empty($avatar)) {
          echo '<img src="' . esc_url($avatar['url']) . '" alt="' . esc_attr($avatar['title']) . '" />';
        } else {
          echo get_avatar($author_id, 150);
        }
        ?>
      </div>
      <div class="bt-post-author--info">
        <h4 class="bt-post-author--name">
          <span class="bt-name">
            <?php the_author(); ?>
          </span>
          <?php
          if (!empty($job)) {
            echo '<span class="bt-label">' . $job . '</span>';
          }
          ?>
        </h4>
        <?php
        if (!empty($desc)) {
          echo '<div class="bt-post-author--desc">' . $desc . '</div>';
        }

        if (!empty($socials)) {
        ?>
          <div class="bt-post-author--socials">
            <?php
            foreach ($socials as $item) {
              if ($item['social'] == 'facebook') {
                echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                          <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
                        </svg>
                      </a>';
              }

              if ($item['social'] == 'linkedin') {
                echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                          <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
                        </svg>
                      </a>';
              }

              if ($item['social'] == 'twitter') {
                echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                          <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                        </svg>
                      </a>';
              }

              if ($item['social'] == 'google') {
                echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
                          <path d="M386.061 228.496c1.834 9.692 3.143 19.384 3.143 31.956C389.204 370.205 315.599 448 204.8 448c-106.084 0-192-85.915-192-192s85.916-192 192-192c51.864 0 95.083 18.859 128.611 50.292l-52.126 50.03c-14.145-13.621-39.028-29.599-76.485-29.599-65.484 0-118.92 54.221-118.92 121.277 0 67.056 53.436 121.277 118.92 121.277 75.961 0 104.513-54.745 108.965-82.773H204.8v-66.009h181.261zm185.406 6.437V179.2h-56.001v55.733h-55.733v56.001h55.733v55.733h56.001v-55.733H627.2v-56.001h-55.733z"/>
                        </svg>
                      </a>';
              }
            }
            ?>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
    <?php
    return ob_get_clean();
  }
}


/* Related posts */
if (!function_exists('chambeshi_related_posts')) {
  function chambeshi_related_posts()
  {
    $post_id = get_the_ID();
    $cat_ids = array();
    $categories = get_the_category($post_id);

    if (!empty($categories) && !is_wp_error($categories)) {
      foreach ($categories as $category) {
        array_push($cat_ids, $category->term_id);
      }
    }

    $current_post_type = get_post_type($post_id);

    $query_args = array(
      'category__in'   => $cat_ids,
      'post_type'      => $current_post_type,
      'post__not_in'    => array($post_id),
      'posts_per_page'  => 2,
    );

    $list_posts = new WP_Query($query_args);

    ob_start();

    if ($list_posts->have_posts()) {
    ?>
      <div class="bt-related-posts">
        <div class="bt-related-posts--heading">
          <h4 class="bt-sub"><?php esc_html_e('From The Blog', 'chambeshi'); ?></h4>
          <h2 class="bt-head"><?php esc_html_e('Related News ', 'chambeshi'); ?><span><?php esc_html_e('& Articles', 'chambeshi'); ?></span></h2>
        </div>
        <div class="bt-related-posts--list bt-image-effect">
          <?php
          while ($list_posts->have_posts()) : $list_posts->the_post();
            get_template_part('framework/templates/post', 'related');
          endwhile;
          wp_reset_postdata();
          ?>
        </div>
      </div>
    <?php
    }
    return ob_get_clean();
  }
}

//Comment Field Order
function chambeshi_comment_fields_custom_order($fields)
{
  $comment_field = $fields['comment'];
  $author_field = $fields['author'];
  $email_field = $fields['email'];
  $cookies_field = $fields['cookies'];
  unset($fields['comment']);
  unset($fields['author']);
  unset($fields['email']);
  unset($fields['url']);
  unset($fields['cookies']);
  // the order of fields is the order below, change it as needed:
  $fields['author'] = $author_field;
  $fields['email'] = $email_field;
  $fields['comment'] = $comment_field;
  // done ordering, now return the fields:
  return $fields;
}
add_filter('comment_form_fields', 'chambeshi_comment_fields_custom_order');

/* Custom comment list */
if (!function_exists('chambeshi_custom_comment')) {
  function chambeshi_custom_comment($comment, $args, $depth)
  {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }
    ?>
    <<?php echo esc_html($tag); ?> <?php comment_class(empty($args['has_children']) ? 'bt-comment-item clearfix' : 'bt-comment-item parent clearfix') ?> id="comment-<?php comment_ID() ?>">
      <div class="bt-comment">
        <div class="bt-avatar">
          <?php
          if (function_exists('get_field')) {
            $avatar = get_field('avatar', 'user_' . $comment->user_id);
          } else {
            $avatar = array();
          }
          if (!empty($avatar)) {
            echo '<img src="' . esc_url($avatar['url']) . '" alt="' . esc_attr($avatar['title']) . '" />';
          } else {
            if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']);
          }


          ?>
        </div>
        <div class="bt-content">
          <h5 class="bt-name">
            <?php echo get_comment_author(get_comment_ID()); ?>
          </h5>
          <div class="bt-date">
            <?php echo get_comment_date(); ?>
          </div>
          <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'chambeshi'); ?></em>
          <?php endif; ?>
          <div class="bt-text">
            <?php comment_text(); ?>
          </div>
          <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
        </div>
      </div>
  <?php
  }
}
