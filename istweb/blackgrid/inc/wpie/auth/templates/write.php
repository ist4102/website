<div class="p-sm-6 p-3">
  <form class="form-submit" method="post" action="<?php echo $_SERVER["REQUEST_URI"];
  $current_user = wp_get_current_user(); ?>">
    <div class="row">
      <div class="form-item col-sm-12">
        <input placeholder="填写文章标题" type="text" name="submit-title" class="form-field submit-title"/>
      </div>

      <div class="form-item col-sm-6">
        <label for="category-select">分类</label>
        <?php
        $args = array(
          'class' => 'form-field',
          'hide_empty' => 0,
          'id' => 'category-select',
          'show_count' => 1,
          'hierarchical' => 1,
          'taxonomy' => 'category',
          'textarea_rows' => 8,
        );
        ?>
        <?php wp_dropdown_categories($args); ?>
      </div>
      <div class="form-item col-sm-6">
        <label for="tag-select">标签</label>
        <?php
        $args = array(
          'class' => 'form-field',
          'hide_empty' => 0,
          'id' => 'tag-select',
          'name' => 'tag',
          'show_count' => 1,
          'hierarchical' => 1,
          'taxonomy' => 'post_tag',
          'textarea_rows' => 8,
        );
        ?>
        <?php wp_dropdown_categories($args); ?>
      </div>
      <div class="form-item col-sm-6">
        <label for="subject-select">专题</label>
        <?php
        $args = array(
          'class' => 'form-field',
          'hide_empty' => 0,
          'id' => 'subject-select',
          'name' => 'subject',
          'show_count' => 1,
          'hierarchical' => 1,
          'taxonomy' => 'subject',
          'textarea_rows' => 8,
        );
        ?>
        <?php wp_dropdown_categories($args); ?>
      </div>
      <div class="form-item col-sm-12">
        <label for="thumbnail">文章缩略图</label>
      </div>
      <div class="form-item col-sm-12">
        <a class="btn btn-primary btn-upload-thumbnail mb-2">选择图片</a>
        <img class="thumbnail-img d-none d-block" width="160" height="120" alt="缩略图"/>
      </div>
      <div class="form-item col-sm-12">
        <label style="vertical-align:top" for="submit-content">文章内容</label>
        <?php
        wp_editor('', 'submit-content', array(
          'media_buttons' => true,
//                    'media_buttons' => false,
          'editor_height' => '380px',
          'teeny' => false,
          'quicktags' => true,
          'tinymce' => true,
          'dfw' => false,

        ));
        wp_nonce_field('cherry_nonce_action', 'cherry_nonce');

        ?>
      </div>
      <div class="form-item text-center col-sm-12">
        <input type="hidden" value="send" name="submit-form"/>
        <input type="submit" class="btn btn-primary" value="提交"/>
      </div>
    </div>
  </form>
</div>

