<?php
$post_id = get_the_ID();
$category = get_the_terms($post_id, 'category');
$icon_lively = get_field('icon_lively_service', $post_id);
?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <div class="bt-post--icon-lively">
      <?php if (!empty($icon_lively['url'])) { ?>
        <img src="<?php echo $icon_lively['url'] ?>" />
      <?php } ?>
    </div>
    <div class="bt-post--infor">
      <?php echo chambeshi_post_title_render();
      ?>
      <div class="bt-post--excerpt">
        <?php echo get_the_excerpt(); ?>
      </div>
      <ul class="bt-post--listinfo">
        <?php
        if (have_rows('list_info_service', $post_id)) :
          while (have_rows('list_info_service', $post_id)) : the_row();
            $item_text = get_sub_field('item_text');
            if ($item_text) {
              echo '<li>' . esc_html($item_text) . '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="#4F6A35">
<path d="M20.8141 10.352L14.3974 3.9353C14.2245 3.76832 13.993 3.67592 13.7526 3.67801C13.5123 3.6801 13.2824 3.77651 13.1124 3.94646C12.9425 4.11642 12.8461 4.34633 12.844 4.58668C12.8419 4.82703 12.9343 5.05858 13.1013 5.23146L17.9532 10.0834H1.83268C1.58957 10.0834 1.35641 10.18 1.1845 10.3519C1.01259 10.5238 0.916016 10.7569 0.916016 11C0.916016 11.2432 1.01259 11.4763 1.1845 11.6482C1.35641 11.8201 1.58957 11.9167 1.83268 11.9167H17.9532L13.1013 16.7686C13.0137 16.8532 12.9439 16.9543 12.8958 17.0662C12.8478 17.178 12.8225 17.2983 12.8215 17.42C12.8204 17.5417 12.8436 17.6624 12.8897 17.7751C12.9358 17.8877 13.0038 17.9901 13.0899 18.0762C13.176 18.1622 13.2783 18.2303 13.391 18.2764C13.5036 18.3225 13.6243 18.3457 13.746 18.3446C13.8678 18.3436 13.988 18.3183 14.0999 18.2702C14.2117 18.2222 14.3129 18.1523 14.3974 18.0648L20.8141 11.6481C20.9859 11.4762 21.0825 11.2431 21.0825 11C21.0825 10.757 20.9859 10.5239 20.8141 10.352Z" />
</svg></li>';
            }
          endwhile;
        endif;
        ?>
      </ul>
    </div>

  </div>
  <?php echo chambeshi_service_button_render('Explore More'); ?>
</article>