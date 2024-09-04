<?php
$avatar = get_field('avatar');
$job = get_field('job');
$desc = get_field('description');

?>
<article <?php post_class('bt-post'); ?>>


  <div class="bt-post--inner">
    <div class="bt-post--quote-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="114" height="114" viewBox="0 0 114 114" fill="none">
        <path d="M42.75 14.25H10.6875C4.79406 14.25 0 19.0441 0 24.9375V57C0 62.8934 4.79406 67.6875 10.6875 67.6875H25.068L19.6598 95.5073C19.4563 96.5528 19.7312 97.633 20.4078 98.4541C21.0845 99.2751 22.0917 99.75 23.1562 99.75H34.6979C37.7959 99.75 40.5495 97.7235 41.4871 94.7889L51.858 70.1889C51.9172 70.048 51.9676 69.9036 52.0076 69.7575C52.9574 66.3446 53.4375 62.8151 53.4375 59.2683V24.9375C53.4375 19.0441 48.6434 14.25 42.75 14.25Z" fill="black" fill-opacity="0.07" />
        <path d="M103.312 14.25H71.25C65.3566 14.25 60.5625 19.0441 60.5625 24.9375V57C60.5625 62.8934 65.3566 67.6875 71.25 67.6875H85.6322L80.2224 95.5073C80.0171 96.5528 80.2919 97.633 80.9704 98.4541C81.6453 99.2751 82.6542 99.75 83.7188 99.75H95.2621C98.3619 99.75 101.114 97.7235 102.05 94.7872L112.42 70.1889C112.48 70.048 112.528 69.9036 112.57 69.7575C113.52 66.3411 114 62.8117 114 59.2683V24.9375C114 19.0441 109.206 14.25 103.312 14.25Z" fill="black" fill-opacity="0.07" />
      </svg>
    </div>
    <?php
    if (!empty($desc)) {
      echo '<div class="bt-post--desc">' . $desc . '</div>';
    }
    ?>
  </div>
  <div class="bt-post--infor">
    <div class="bt-post--avatar">
      <?php
      if (!empty($avatar)) {
        echo '<img src="' . esc_url($avatar['url']) . '" alt="' . esc_attr($avatar['title']) . '" />';
      }
      ?>
    </div>
    <div class="bt-post--title-wrap">
      <h3 class="bt-post--title">
        <?php the_title(); ?>
      </h3>
      <?php
      if (!empty($job)) {
        echo '<div class="bt-post--job">' . $job . '</div>';
      }
      ?>
    </div>
  </div>
</article>