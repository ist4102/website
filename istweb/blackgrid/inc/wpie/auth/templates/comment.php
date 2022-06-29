<?php
global $cherry_comment_user;
$args = array(
  'user_id' => $cherry_comment_user->ID
);
$comments = get_comments($args);
?>
<div class="user-comments p-sm-6 p-3">
  <?php foreach ($comments as $key => $comment): ?>
    <div class="media mb-3">
      <img class="rounded-circle mr-3" src="<?php echo cherry_get_avatar_url($cherry_comment_user->ID) ?>" width="48"
           height="48" alt="">
      <div class="media-body">
        <h4><?php echo $comment->comment_author; ?></h4>
        <p><?php comment_text($comment->comment_ID) ?></p>
        <div>
                    <span class="text-gray-600">
                        <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . '前'; ?>
                        评价于
                    </span>
          <a class="text-success ml-auto" href="<?php the_permalink($comment->comment_post_ID) ?>">
            <?php echo get_the_title($comment->comment_post_ID) ?>
          </a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

