<?php
global $current_user;
wp_get_current_user();
global $cherry_comment_user;
$cherry_comment_user = $current_user;

$loginUser = $current_user->user_login;
$queryUser = $wp_query->query_vars['username'];
if ($loginUser != $queryUser) {
  wp_redirect(home_url());
}
get_header();
?>

<div class="container mt-sm-6">
  <div class="row no-gutters-xs">
    <div class="col-lg-3">
      <div class="user mb-4">
        <div class="user-basic">
          <div class="user-avatar-cover"
               style="background-image: url(<?php echo cherry_get_avatar_url($current_user->ID) ?>); ">
          </div>
          <div class="user-basic-info d-flex flex-column justify-content-center align-items-center">
            <div class="user-avatar mb-1">
              <img src="<?php echo cherry_get_avatar_url($current_user->ID); ?>" alt="">
              <form class="form-avatar" enctype="multipart/form-data">
                <input type="file" class="avatar" name="avatar" multiple="multiple"/>
                <input type="submit" class="form-avatar-submit hidden" name="submit" value="Upload!"/>
                <input type="hidden" class="user-id" name="userID"
                       value="<?php echo $current_user->ID; ?>">
              </form>
              <div class="user-avatar-overlay opacity-0">
                <i class="czs-doc-edit"></i>
              </div>
            </div>
            <div class="user-nickname mb-1 text-white">
              <?php echo $current_user->display_name; ?>
            </div>
            <?php if ($current_user->description): ?>
              <div class="user-description mb-1 text-white text-center px-3 mw-100">
                <?php echo $current_user->description; ?>
              </div>
            <?php endif; ?>
            <div class="user-role mb-1">
              <span class="px-2 d-inline-block f-12 text-white bg-geek" style="border-radius: 20px">
                <?php echo cherry_get_role($current_user->ID); ?>
              </span>
            </div>
            <div class="d-flex flex-row align-items-center justify-content-center w-100">
              <a class="text-primary mr-3" href="<?php echo $current_user->user_url; ?>" target="_blank">
                <i class="czs-network-l"></i>
              </a>
              <!--                            <a class="text-geek mr-3"-->
              <!--                               href="https://www.github.com/-->
              <?php //echo $current_user->display_name; ?><!--" target="_blank">-->
              <!--                                <i class="czs-github"></i>-->
              <!--                            </a>-->
              <a class="text-success mr-3"
                 href="<?php echo 'mailto:' . $current_user->user_email . '?cc=' . $current_user->user_email; ?>"
                 target="_blank">
                <i class="czs-message"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="widget-author-footer text-center">
          <div class="col-6 py-2 d-block" style="border-right: 1px solid #eee;">
            <div class="f-bolder">
              <?php echo count_user_posts($current_user->ID); ?>
            </div>
            文章
          </div>
          <div class="col-6 py-2 d-block">
            <div class="f-bolder">
              <?php echo cherry_count_user_comments($current_user->ID); ?>
            </div>
            评论
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-9">
      <div class="user-profile">
        <div class="user-tab tab-nav px-sm-6 px-3" data-tab-index="0" data-tab-content="user-tab-content">
          <div class="tab-nav-scroll">
            <div class="tab-li active">
              我的文章
              <span class="badge badge-success">
                                <?php echo cherry_count_user_all_posts($current_user->ID); ?>
                            </span>
            </div>
            <div class="tab-li">编写文章</div>
            <div class="tab-li">
              我的评论
              <span class="badge badge-success">
                                <?php echo cherry_count_user_comments($current_user->ID) ?>
                            </span>
            </div>
            <div class="tab-li">个人资料</div>
          </div>
        </div>
        <div class="user-tab-content tab-content" id="user-tab-content">
          <div class="tab-item active">
            <?php include('post.php'); ?>
          </div>
          <div class="tab-item">
            <?php include('write.php') ?>
          </div>
          <div class="tab-item">
            <?php include('comment.php') ?>
          </div>
          <div class="tab-item">
            <?php include('setting.php'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer() ?>
