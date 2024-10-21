<?php
$post_id = get_the_ID();
$category = get_the_terms($post_id, 'category');

$icon_svg = get_field('icon_service', $post_id);
$icon_lively = get_field('icon_lively_service', $post_id);

$thumb = '';
if (!empty($icon_svg)) {
    $thumb = $icon_svg['url'];
} elseif( !empty($icon_lively) ) {
    $thumb = $icon_lively['url'];
}
?>
<article <?php post_class('bt-post'); ?>>

    <div class="bt-post--inner">
        <div class="bt-post--infor">
            <?php if (!empty($thumb) && 'svg' === pathinfo($thumb, PATHINFO_EXTENSION)) { ?>
                <div class="bt-post--icon-lively">
                    <?php echo file_get_contents($thumb); ?>
                </div>
            <?php } else { ?>
                <div class="bt-post--icon-lively">
                    <img src="<?php echo $thumb; ?>">
                </div>
            <?php } ?>

            <h3 class="bt-post--title">
                <a href="<?php echo get_the_permalink($post_id); ?>">
                    <?php echo get_the_title($post_id); ?>
                </a>
            </h3>

            <div class="bt-post--excerpt">
                <?php echo get_the_excerpt(); ?>
            </div>

            <div class="bt-post--button bt-button-hover-secondary">
                <a class="bt-post--icon" href="<?php echo get_the_permalink($post_id); ?>">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.8147 10.352L14.398 3.9353C14.2252 3.76832 13.9936 3.67592 13.7533 3.67801C13.5129 3.6801 13.283 3.77651 13.113 3.94646C12.9431 4.11642 12.8467 4.34633 12.8446 4.58668C12.8425 4.82703 12.9349 5.05858 13.1019 5.23146L17.9538 10.0834H1.83329C1.59018 10.0834 1.35702 10.18 1.18511 10.3519C1.0132 10.5238 0.916626 10.7569 0.916626 11C0.916626 11.2432 1.0132 11.4763 1.18511 11.6482C1.35702 11.8201 1.59018 11.9167 1.83329 11.9167H17.9538L13.1019 16.7686C13.0143 16.8532 12.9445 16.9543 12.8965 17.0662C12.8484 17.178 12.8231 17.2983 12.8221 17.42C12.821 17.5417 12.8442 17.6624 12.8903 17.7751C12.9364 17.8877 13.0044 17.9901 13.0905 18.0762C13.1766 18.1622 13.2789 18.2303 13.3916 18.2764C13.5042 18.3225 13.6249 18.3457 13.7467 18.3446C13.8684 18.3436 13.9887 18.3183 14.1005 18.2702C14.2123 18.2222 14.3135 18.1523 14.398 18.0648L20.8147 11.6481C20.9866 11.4762 21.0831 11.2431 21.0831 11C21.0831 10.757 20.9866 10.5239 20.8147 10.352Z"
                            fill="white" />
                    </svg>
                </a>
            </div>

        </div>

    </div>

</article>