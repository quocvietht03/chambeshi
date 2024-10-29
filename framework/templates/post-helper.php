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
          <path
            d="M8 14.5C8.55228 14.5 9 14.0523 9 13.5C9 12.9477 8.55228 12.5 8 12.5C7.44772 12.5 7 12.9477 7 13.5C7 14.0523 7.44772 14.5 8 14.5Z"
            fill="#4F6A35" />
          <path
            d="M8 18.5C8.55228 18.5 9 18.0523 9 17.5C9 16.9477 8.55228 16.5 8 16.5C7.44772 16.5 7 16.9477 7 17.5C7 18.0523 7.44772 18.5 8 18.5Z"
            fill="#4F6A35" />
          <path
            d="M12 14.5C12.5523 14.5 13 14.0523 13 13.5C13 12.9477 12.5523 12.5 12 12.5C11.4477 12.5 11 12.9477 11 13.5C11 14.0523 11.4477 14.5 12 14.5Z"
            fill="#4F6A35" />
          <path
            d="M12 18.5C12.5523 18.5 13 18.0523 13 17.5C13 16.9477 12.5523 16.5 12 16.5C11.4477 16.5 11 16.9477 11 17.5C11 18.0523 11.4477 18.5 12 18.5Z"
            fill="#4F6A35" />
          <path
            d="M16 14.5C16.5523 14.5 17 14.0523 17 13.5C17 12.9477 16.5523 12.5 16 12.5C15.4477 12.5 15 12.9477 15 13.5C15 14.0523 15.4477 14.5 16 14.5Z"
            fill="#4F6A35" />
          <path
            d="M16 18.5C16.5523 18.5 17 18.0523 17 17.5C17 16.9477 16.5523 16.5 16 16.5C15.4477 16.5 15 16.9477 15 17.5C15 18.0523 15.4477 18.5 16 18.5Z"
            fill="#4F6A35" />
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M1.25 19.5V6.5C1.25 5.505 1.645 4.552 2.348 3.848C3.052 3.145 4.005 2.75 5 2.75H8.25V5.5C8.25 5.914 8.586 6.25 9 6.25C9.414 6.25 9.75 5.914 9.75 5.5V2.75H16.25V5.5C16.25 5.914 16.586 6.25 17 6.25C17.414 6.25 17.75 5.914 17.75 5.5V2.75H19C19.995 2.75 20.948 3.145 21.652 3.848C22.355 4.552 22.75 5.505 22.75 6.5V19.5C22.75 20.495 22.355 21.448 21.652 22.152C20.948 22.855 19.995 23.25 19 23.25H5C4.005 23.25 3.052 22.855 2.348 22.152C1.645 21.448 1.25 20.495 1.25 19.5ZM2.75 9.75V19.5C2.75 20.097 2.987 20.669 3.409 21.091C3.831 21.513 4.403 21.75 5 21.75H19C19.597 21.75 20.169 21.513 20.591 21.091C21.013 20.669 21.25 20.097 21.25 19.5V9.75H2.75Z"
            fill="#4F6A35" />
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M15.25 1.5C15.25 1.086 15.586 0.75 16 0.75C16.414 0.75 16.75 1.086 16.75 1.5V5.5C16.75 5.914 16.414 6.25 16 6.25C15.586 6.25 15.25 5.914 15.25 5.5V1.5Z"
            fill="#4F6A35" />
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M7.25 1.5C7.25 1.086 7.586 0.75 8 0.75C8.414 0.75 8.75 1.086 8.75 1.5V5.5C8.75 5.914 8.414 6.25 8 6.25C7.586 6.25 7.25 5.914 7.25 5.5V1.5Z"
            fill="#4F6A35" />
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
        <path
          d="M8 14.5C8.55228 14.5 9 14.0523 9 13.5C9 12.9477 8.55228 12.5 8 12.5C7.44772 12.5 7 12.9477 7 13.5C7 14.0523 7.44772 14.5 8 14.5Z"
          fill="#4F6A35" />
        <path
          d="M8 18.5C8.55228 18.5 9 18.0523 9 17.5C9 16.9477 8.55228 16.5 8 16.5C7.44772 16.5 7 16.9477 7 17.5C7 18.0523 7.44772 18.5 8 18.5Z"
          fill="#4F6A35" />
        <path
          d="M12 14.5C12.5523 14.5 13 14.0523 13 13.5C13 12.9477 12.5523 12.5 12 12.5C11.4477 12.5 11 12.9477 11 13.5C11 14.0523 11.4477 14.5 12 14.5Z"
          fill="#4F6A35" />
        <path
          d="M12 18.5C12.5523 18.5 13 18.0523 13 17.5C13 16.9477 12.5523 16.5 12 16.5C11.4477 16.5 11 16.9477 11 17.5C11 18.0523 11.4477 18.5 12 18.5Z"
          fill="#4F6A35" />
        <path
          d="M16 14.5C16.5523 14.5 17 14.0523 17 13.5C17 12.9477 16.5523 12.5 16 12.5C15.4477 12.5 15 12.9477 15 13.5C15 14.0523 15.4477 14.5 16 14.5Z"
          fill="#4F6A35" />
        <path
          d="M16 18.5C16.5523 18.5 17 18.0523 17 17.5C17 16.9477 16.5523 16.5 16 16.5C15.4477 16.5 15 16.9477 15 17.5C15 18.0523 15.4477 18.5 16 18.5Z"
          fill="#4F6A35" />
        <path fill-rule="evenodd" clip-rule="evenodd"
          d="M1.25 19.5V6.5C1.25 5.505 1.645 4.552 2.348 3.848C3.052 3.145 4.005 2.75 5 2.75H8.25V5.5C8.25 5.914 8.586 6.25 9 6.25C9.414 6.25 9.75 5.914 9.75 5.5V2.75H16.25V5.5C16.25 5.914 16.586 6.25 17 6.25C17.414 6.25 17.75 5.914 17.75 5.5V2.75H19C19.995 2.75 20.948 3.145 21.652 3.848C22.355 4.552 22.75 5.505 22.75 6.5V19.5C22.75 20.495 22.355 21.448 21.652 22.152C20.948 22.855 19.995 23.25 19 23.25H5C4.005 23.25 3.052 22.855 2.348 22.152C1.645 21.448 1.25 20.495 1.25 19.5ZM2.75 9.75V19.5C2.75 20.097 2.987 20.669 3.409 21.091C3.831 21.513 4.403 21.75 5 21.75H19C19.597 21.75 20.169 21.513 20.591 21.091C21.013 20.669 21.25 20.097 21.25 19.5V9.75H2.75Z"
          fill="#4F6A35" />
        <path fill-rule="evenodd" clip-rule="evenodd"
          d="M15.25 1.5C15.25 1.086 15.586 0.75 16 0.75C16.414 0.75 16.75 1.086 16.75 1.5V5.5C16.75 5.914 16.414 6.25 16 6.25C15.586 6.25 15.25 5.914 15.25 5.5V1.5Z"
          fill="#4F6A35" />
        <path fill-rule="evenodd" clip-rule="evenodd"
          d="M7.25 1.5C7.25 1.086 7.586 0.75 8 0.75C8.414 0.75 8.75 1.086 8.75 1.5V5.5C8.75 5.914 8.414 6.25 8 6.25C7.586 6.25 7.25 5.914 7.25 5.5V1.5Z"
          fill="#4F6A35" />
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
            <path
              d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16V352c0 8.8 7.2 16 16 16h96zm48 124l-.2 .2-5.1 3.8-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3V474.7v-6.4V468v-4V416H112 64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H448c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H309.3L208 492z" />
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
        <span><?php echo esc_html__('Tags:', 'chambeshi'); ?></span>
        <?php
        if (has_tag()) {
          the_tags('', '', '');
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
                      <a target="_blank" data-btIcon="fa fa-facebook" data-toggle="tooltip" title="' . esc_attr__('Facebook', 'chambeshi') . '" href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                          <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
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
    $social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-linkedin" data-toggle="tooltip" title="' . esc_attr__('Linkedin', 'chambeshi') . '" href="https://www.linkedin.com/shareArticle?url=' . get_the_permalink() . '">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                            <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
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
          <path
            d="M19.8686 9.88137L13.7436 3.75637C13.5786 3.59698 13.3576 3.50878 13.1281 3.51078C12.8987 3.51277 12.6793 3.60479 12.517 3.76702C12.3548 3.92926 12.2628 4.14872 12.2608 4.37814C12.2588 4.60756 12.347 4.82859 12.5064 4.99362L17.1378 9.62499H1.75C1.51794 9.62499 1.29538 9.71718 1.13128 9.88127C0.967187 10.0454 0.875 10.2679 0.875 10.5C0.875 10.7321 0.967187 10.9546 1.13128 11.1187C1.29538 11.2828 1.51794 11.375 1.75 11.375H17.1378L12.5064 16.0064C12.4228 16.0871 12.3561 16.1836 12.3103 16.2904C12.2644 16.3971 12.2403 16.512 12.2393 16.6281C12.2383 16.7443 12.2604 16.8595 12.3044 16.9671C12.3484 17.0746 12.4134 17.1723 12.4955 17.2545C12.5777 17.3366 12.6754 17.4016 12.7829 17.4456C12.8905 17.4896 13.0057 17.5117 13.1219 17.5107C13.238 17.5097 13.3529 17.4856 13.4596 17.4397C13.5664 17.3938 13.6629 17.3272 13.7436 17.2436L19.8686 11.1186C20.0327 10.9545 20.1248 10.732 20.1248 10.5C20.1248 10.268 20.0327 10.0455 19.8686 9.88137Z"
            fill="#4F6A35" />
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
            <path
              d="M10.9999 0C4.92482 0 0 4.92482 0 10.9999C0 17.075 4.92482 22.0001 10.9999 22.0001C17.075 22.0001 22.0001 17.075 22.0001 10.9999C21.9932 4.92764 17.0724 0.00684812 10.9999 0ZM10.9999 20.8999C5.53229 20.8999 1.09993 16.4676 1.09993 10.9999C1.09993 5.53229 5.53229 1.09993 10.9999 1.09993C16.4676 1.09993 20.8999 5.53229 20.8999 10.9999C20.8937 16.465 16.465 20.8937 10.9999 20.8999Z" />
            <path
              d="M9.71117 6.73596C9.48236 6.53596 9.13492 6.55932 8.93492 6.78793C8.73511 7.01674 8.75848 7.36418 8.98708 7.56419L12.9139 10.9999L8.98688 14.4359C8.75807 14.6359 8.73491 14.9833 8.93471 15.212C9.13472 15.4408 9.48216 15.4641 9.71097 15.2641L14.1109 11.4141C14.2303 11.3097 14.2988 11.1587 14.2988 10.9999C14.2988 10.8412 14.2303 10.6904 14.1109 10.5858L9.71117 6.73596Z" />
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
        <path
          d="M20.8141 10.3519L14.3974 3.93525C14.2245 3.76827 13.993 3.67588 13.7526 3.67797C13.5123 3.68006 13.2824 3.77646 13.1124 3.94642C12.9425 4.11638 12.8461 4.34629 12.844 4.58663C12.8419 4.82698 12.9343 5.05853 13.1013 5.23142L17.9532 10.0833H1.83268C1.58957 10.0833 1.35641 10.1799 1.1845 10.3518C1.01259 10.5237 0.916016 10.7569 0.916016 11C0.916016 11.2431 1.01259 11.4763 1.1845 11.6482C1.35641 11.8201 1.58957 11.9167 1.83268 11.9167H17.9532L13.1013 16.7686C13.0137 16.8531 12.9439 16.9543 12.8958 17.0661C12.8478 17.178 12.8225 17.2983 12.8215 17.42C12.8204 17.5417 12.8436 17.6624 12.8897 17.775C12.9358 17.8877 13.0038 17.99 13.0899 18.0761C13.176 18.1622 13.2783 18.2302 13.391 18.2763C13.5036 18.3224 13.6243 18.3456 13.746 18.3446C13.8678 18.3435 13.988 18.3182 14.0999 18.2702C14.2117 18.2221 14.3129 18.1523 14.3974 18.0648L20.8141 11.6481C20.9859 11.4762 21.0825 11.2431 21.0825 11C21.0825 10.7569 20.9859 10.5238 20.8141 10.3519Z" />
      </svg>
    </a>
  <?php }
}
/* Author Icon */
if (!function_exists('chambeshi_author_icon_render')) {
  function chambeshi_author_icon_render()
  { ?>
    <div class="bt-post-author-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
        <g clip-path="url(#clip0_23_6567)">
          <path d="M5.31106 7.61845C5.49458 7.93356 5.73005 8.23481 6.01745 8.48759C6.30139 8.74037 6.63727 8.94466 6.99393 9.06932C7.39907 9.21822 7.78689 9.22514 8.04659 9.1732C8.30629 9.10395 8.44826 8.99314 8.42056 8.83386C8.37208 8.53607 7.90116 8.35601 7.37483 8.0963C6.89351 7.86084 6.54724 7.44532 6.31871 6.93976C6.08671 6.43421 5.96897 5.85248 5.90318 5.26035C5.87548 5.02143 5.86163 4.77904 5.85817 4.53665C5.8547 4.41546 5.8547 4.29426 5.85817 4.17653L5.86509 3.99993L5.87894 3.7991L5.90664 3.45283C5.91011 3.33509 5.9482 3.23121 5.96551 3.11694L5.99668 2.95073L6.04862 2.79491C6.08671 2.69103 6.10748 2.58023 6.16288 2.4902C6.33602 2.09545 6.61303 1.76649 6.97316 1.53449C7.32981 1.29556 7.7765 1.16052 8.22665 1.1155C8.63179 1.13974 9.04385 1.22977 9.39704 1.3856C9.7537 1.54142 10.055 1.7561 10.28 2.02966C10.5086 2.30321 10.6609 2.63909 10.7648 3.00614C10.7925 3.19312 10.8479 3.32817 10.8618 3.59133L10.8964 3.94453C10.9033 4.0311 10.9102 4.14537 10.9137 4.24925C10.9379 5.108 10.841 6.00137 10.5224 6.72508C10.4428 6.90514 10.3493 7.07135 10.2419 7.2237C10.1346 7.3726 10.0134 7.50072 9.87836 7.61499C9.60827 7.82621 9.27931 7.97511 8.92265 8.02012C8.89495 8.02359 8.86379 8.03398 8.82916 8.05129C8.79453 8.0686 8.76683 8.09284 8.71489 8.11708C8.6214 8.1621 8.53483 8.2175 8.49674 8.26251C8.34092 8.43565 8.56599 8.58108 8.88456 8.6538C9.14773 8.71613 9.44552 8.71613 9.75024 8.66072C10.0584 8.60532 10.3701 8.46335 10.6505 8.26251C11.2184 7.85392 11.6097 7.19254 11.8209 6.52078C12.0772 5.70358 12.1637 4.87253 12.1499 4.0311C12.1499 3.93068 12.1395 3.80256 12.1326 3.71253L12.1118 3.4182C12.1118 3.23814 12.0529 2.9819 12.0114 2.75682C11.9941 2.63909 11.9525 2.53175 11.9179 2.42094C11.8798 2.31014 11.8486 2.20279 11.8036 2.09199C11.6963 1.88076 11.6062 1.66261 11.4573 1.4687C11.1873 1.07049 10.8167 0.72422 10.3943 0.492219C9.97531 0.256756 9.51824 0.10786 9.06116 0.0455311C8.83262 0.0109041 8.60062 -0.00294671 8.37555 0.000515993C8.13316 0.00397869 7.90808 0.0316803 7.67954 0.0766953C7.22593 0.166725 6.77232 0.336398 6.37065 0.603025C5.96205 0.845414 5.58461 1.17437 5.31799 1.57951C4.88169 2.21318 4.69816 2.94727 4.64276 3.63635L4.62891 3.76793L4.62198 3.83372C4.61852 3.86835 4.62545 3.78871 4.62545 3.79563V3.7991V3.80256V3.80948L4.62198 3.8268L4.61852 3.86489C4.6116 3.95492 4.60467 4.03802 4.60121 4.12459C4.59428 4.29426 4.59082 4.46047 4.59082 4.62668C4.59428 4.96256 4.61852 5.29498 4.667 5.63086C4.76049 6.30263 4.94402 6.98478 5.31106 7.61845Z" fill="#4F6A35" />
          <path d="M15.7926 13.259C15.7857 13.0616 15.7683 12.8538 15.7406 12.6426C15.6818 12.2202 15.5571 11.7631 15.2801 11.3337C15.0031 10.9043 14.546 10.565 14.0785 10.4092L14.0716 10.4057C14.0578 10.4022 14.0405 10.3953 14.0266 10.3919C13.2475 10.191 12.4822 9.85168 11.7759 9.4327C11.6062 9.33574 11.2841 9.27341 11.1595 9.29073C11.1006 9.30111 11.0591 9.32189 11.0383 9.35652C11.0175 9.39114 11.0175 9.43616 11.0314 9.4881C11.0625 9.59544 11.1664 9.73741 11.3119 9.88284C11.9178 10.5061 12.7523 11.0705 13.7669 11.4237L13.7357 11.4133C14.1443 11.6073 14.3902 11.9328 14.5079 12.4002C14.6049 12.7499 14.6118 13.1655 14.6049 13.5879C14.598 13.7957 14.5841 14.0104 14.5633 14.2112C14.5529 14.3116 14.5391 14.412 14.5183 14.5021C14.5148 14.5159 14.5148 14.5263 14.5114 14.5367C14.4941 14.5471 14.4768 14.554 14.4629 14.5609C14.3833 14.599 14.3071 14.6406 14.2274 14.6752C14.0682 14.7514 13.9019 14.8172 13.7392 14.8864C13.4068 15.018 13.0674 15.1357 12.7212 15.2362C12.0321 15.4405 11.3222 15.5893 10.6055 15.6863C10.4289 15.7175 10.2453 15.7279 10.0653 15.7486C9.88522 15.7729 9.70516 15.7833 9.5251 15.7936C9.34504 15.804 9.16498 15.8213 8.98145 15.8213L8.45166 15.8352C8.07423 15.8283 7.68641 15.8283 7.34014 15.804L7.07351 15.7902L6.80342 15.7659C6.62336 15.7486 6.43983 15.7382 6.25977 15.7105C6.03124 15.6655 5.8027 15.6274 5.57762 15.5686L5.23828 15.4889L4.9024 15.3954C4.4384 15.2639 3.98132 15.115 3.53809 14.9314C3.31648 14.8414 3.09833 14.7445 2.88711 14.644C2.78323 14.5921 2.67588 14.5402 2.57546 14.4847C2.55815 14.4744 2.5443 14.4674 2.52699 14.457C2.52006 14.4051 2.51314 14.3532 2.50621 14.2978C2.4889 14.1419 2.48197 13.9723 2.47505 13.8026C2.46466 13.4702 2.47851 13.117 2.51314 12.8227C2.55123 12.5214 2.63087 12.2617 2.7486 12.0713C2.86979 11.8843 3.02215 11.7562 3.24723 11.6627L3.19529 11.6765C3.82896 11.4965 4.42454 11.2437 4.9855 10.9459C5.79924 10.5131 6.34634 9.94171 6.10742 9.7201C5.89273 9.51926 5.29022 9.68201 4.50072 10.0179C3.98132 10.2395 3.4446 10.4161 2.90442 10.5338C2.89749 10.5338 2.89057 10.5373 2.88364 10.5408L2.86287 10.5477C2.55469 10.6481 2.24651 10.8178 1.99719 11.0602C1.74788 11.2991 1.57128 11.5969 1.45355 11.8912C1.33582 12.189 1.27349 12.4868 1.23886 12.7742C1.22155 12.9196 1.21116 13.0581 1.20424 13.1966L1.19731 13.394L1.19385 13.491V13.6052C1.19731 13.8372 1.20424 14.0692 1.22847 14.3082C1.23886 14.4293 1.25271 14.5471 1.27695 14.6787C1.30119 14.8102 1.32543 14.9384 1.39122 15.1115L1.39468 15.1184C1.43624 15.2223 1.50549 15.3123 1.60937 15.3747C1.68901 15.4231 1.74788 15.4578 1.81367 15.4924C1.87946 15.5305 1.94179 15.5616 2.00758 15.5963C2.1357 15.6655 2.26728 15.7209 2.3954 15.7833C2.65511 15.8975 2.91827 16.0049 3.1849 16.1018C3.71469 16.2923 4.25487 16.4516 4.80198 16.5693C5.07553 16.6351 5.34908 16.6766 5.6261 16.732C5.90312 16.7667 6.17667 16.8186 6.45715 16.8428C6.73416 16.8705 7.01118 16.8982 7.29512 16.9086L7.71757 16.9294L8.12271 16.9329C8.10193 16.9225 8.08115 16.9086 8.06038 16.8982C8.08115 16.9086 8.10193 16.9225 8.12271 16.9329C8.72868 17.0021 9.33465 17.009 9.94755 16.9917C10.557 16.9571 11.1733 16.8982 11.7828 16.777C12.3922 16.6593 12.9947 16.5035 13.5868 16.2957C13.8812 16.1919 14.1755 16.0776 14.4664 15.946C14.6118 15.8837 14.7538 15.811 14.8992 15.7382C14.9719 15.7002 15.0412 15.6655 15.1139 15.624C15.1901 15.5824 15.2524 15.5478 15.3459 15.4889L15.3563 15.482C15.4705 15.4093 15.564 15.3019 15.6125 15.1634C15.7233 14.8553 15.7406 14.6579 15.7649 14.4467C15.7857 14.2389 15.796 14.0415 15.803 13.8442C15.8064 13.7472 15.8064 13.6502 15.8064 13.5464L15.7926 13.259Z" fill="#4F6A35" />
        </g>
        <defs>
          <clipPath id="clip0_23_6567">
            <rect width="17" height="17" fill="white" />
          </clipPath>
        </defs>
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

      <h4 class="bt-post-author-w-avatar--name"> <span><?php echo esc_html__('By ', 'chambeshi') ?></span>
        <?php the_author(); ?> </h4>
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

      <h4 class="bt-post-author-w-avatar--name"> <span><?php echo esc_html__('Posted by ', 'chambeshi') ?></span>
        <?php the_author(); ?> </h4>
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
/* CTA - Free Consultation */
if (!function_exists('chambeshi_cta_free_consultation')) {
  function chambeshi_cta_free_consultation()
  {
    ob_start();
    if (function_exists('get_field')) {
      $site_information = get_field('site_information', 'options');

      if (!empty($site_information) && isset($site_information['get_free_consultation_cta'])) {
        $consultation_cta = $site_information['get_free_consultation_cta'];
        $background_image = !empty($consultation_cta['background_image']) ? $consultation_cta['background_image'] : '';
        $heading = !empty($consultation_cta['heading']) ? $consultation_cta['heading'] : '';
        $description = !empty($consultation_cta['description']) ? $consultation_cta['description'] : '';
        $button = !empty($consultation_cta['button']) ? $consultation_cta['button'] : '';

    ?>
        <div class="bt-cta-free-consultation">
          <div class="bt-consultation" <?php echo !empty($background_image) ? 'style="background-image: url(' . esc_url($background_image) . ')"' : ''; ?>>
            <div class="bt-consultation--infor">
              <?php if (!empty($heading)): ?>
                <h3 class="bt-consultation--title"><?php echo esc_html($heading); ?></h3>
              <?php endif; ?>

              <?php if (!empty($description)): ?>
                <p class="bt-consultation--des"><?php echo esc_html($description); ?></p>
              <?php endif; ?>
            </div>
            <div class="bt-consultation--button">
              <?php if (!empty($button)): ?>
                <a href="<?php echo esc_url($button['url']); ?>"><span><?php echo esc_html($button['title']); ?></span></a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php
      }
    }
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
      'category__in' => $cat_ids,
      'post_type' => $current_post_type,
      'post__not_in' => array($post_id),
      'posts_per_page' => 2,
    );

    $list_posts = new WP_Query($query_args);

    ob_start();

    if ($list_posts->have_posts()) {
      ?>
      <div class="bt-related-posts">
        <div class="bt-related-posts--heading">
          <h2 class="bt-head"><?php esc_html_e('Related Blog ', 'chambeshi'); ?></h2>
          <span><?php esc_html_e('News & Articals', 'chambeshi'); ?></span>
        </div>
        <div class="bt-related-posts--list bt-image-effect">
          <?php
          while ($list_posts->have_posts()):
            $list_posts->the_post();
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
    <<?php echo esc_html($tag); ?>
      <?php comment_class(empty($args['has_children']) ? 'bt-comment-item clearfix' : 'bt-comment-item parent clearfix') ?>
      id="comment-<?php comment_ID() ?>">
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
            if ($args['avatar_size'] != 0)
              echo get_avatar($comment, $args['avatar_size']);
          }


          ?>
        </div>
        <div class="bt-content">
          <h5 class="bt-name">
            <?php echo get_comment_author(get_comment_ID()); ?>
          </h5>
          <div class="bt-date">
            <?php echo get_comment_date('F j, Y \a\t g:i a'); ?>
          </div>
          <?php if ($comment->comment_approved == '0'): ?>
            <em
              class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'chambeshi'); ?></em>
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

  if (!function_exists('chambeshi_shortcode_featured_project')) {
    function chambeshi_shortcode_featured_project()
    {
      $project_ID = get_the_ID();
      $featured = get_field('featured', $project_ID);

      ob_start();
      if (!empty($featured)) {
      ?>
        <div class="bt-post--counter">
          <?php
          foreach ($featured as $item) {
          ?>
            <div class="bt-counter">
              <h3 class="bt-head"><?php echo esc_attr($item['top_label']) ?></h3>
              <div class="bt-number-wrapper">
                <span class="bt-before-number"><?php echo esc_attr($item['before_number']) ?></span>
                <span class="bt-number"
                  data-count="<?php echo esc_attr($item['number']) ?>"><?php echo esc_attr(number_format($item['number'])) ?></span>
                <span class="bt-affter-number"><?php echo esc_attr($item['after_number']) ?></span>
              </div>
              <h3 class="bt-head-bottom"><?php echo esc_attr($item['bottom_label']) ?></h3>
            </div>
          <?php
          }
          ?>
        </div>
  <?php
      }
      return ob_get_clean();
    }
    add_shortcode('featured_project', 'chambeshi_shortcode_featured_project');
  }
