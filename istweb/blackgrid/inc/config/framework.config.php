<?php

$settings = array(
  'menu_title' => '黑格导航菜单',
  'menu_type' => 'menu', // menu, submenu, options, theme, etc.
  'menu_slug' => 'cs-framework',
  'ajax_save' => true,
  'show_reset_all' => false,
  'framework_title' => '黑格导航菜单 <small>配置菜单</small>',
);

$options = array();

$options[] = array(
  'name' => 'overview',
  'title' => '常规',
  'icon' => 'czs-setting',
  'fields' => array(
    array(
      'id' => 'i_logo_url',
      'type' => 'upload',
      'title' => '网站logo',
      'default' => get_template_directory_uri() . "/assets/images/logo.png",
    ),
    array(
      'id' => 'i_navbar_logo_url',
      'type' => 'upload',
      'title' => '顶部logo',
      'default' => get_template_directory_uri() . "/assets/images/logo-mobile.png",
    ),
    array(
      'id' => 'i_favicon_url',
      'type' => 'upload',
      'title' => '网站favicon',
      'default' => get_template_directory_uri() . "/assets/images/favicon.ico",
      'help' => '上传网站favicon',
    ),
    array(
      'id' => 'i_submit_href',
      'type' => 'text',
      'title' => '投稿链接',
      'desc' => '默认跳转到后台',
    ),
    array(
      'id' => 'i_brief_card_switcher',
      'type' => 'switcher',
      'title' => '卡片样式一键简化',
    ),
    array(
      'id' => 'i_navigation_href_blank_switcher',
      'type' => 'switcher',
      'title' => '导航链接新窗口打开',
    ),
    array(
      'id' => 'i_sub_category_switcher',
      'type' => 'switcher',
      'title' => '隐藏子分类图标',
    ),
    array(
      'id' => 'i_auth_switcher',
      'type' => 'switcher',
      'title' => '开启前端登录功能',
    ),
    array(
      'id' => 'i_link_switcher',
      'type' => 'switcher',
      'title' => '开启友情链接功能',
    ),
    array(
      'id' => 'i_notice_carousel_switcher',
      'type' => 'switcher',
      'title' => '开启轮播通知功能'
    ),
    array(
      'id' => 'i_notice_carousel_group',
      'type' => 'group',
      'title' => '添加通知',
      'button_title' => '添加',
      'accordion_title' => '新添加通知',
      'fields' => array(
        array(
          'id' => 'i_notice_carousel_icon',
          'type' => 'icon',
          'title' => '通知文字前图标',
        ),
        array(
          'id' => 'i_notice_carousel_content',
          'type' => 'text',
          'title' => '通知文字',
        ),
        array(
          'id' => 'i_notice_carousel_href_content',
          'type' => 'text',
          'title' => '通知链接文字',
        ),
        array(
          'id' => 'i_notice_carousel_href',
          'type' => 'text',
          'title' => '通知链接',
        ),
      ),
      'dependency' => array(
        'i_notice_carousel_switcher',
        '==',
        'true'
      )
    ),
    array(
      'id' => 'i_sidenav_button_switcher',
      'type' => 'switcher',
      'title' => '开启侧边栏按钮'
    ),
    array(
      'id' => 'i_sidenav_button_icon',
      'type' => 'icon',
      'title' => '按钮图标',
      'dependency' => array(
        'i_sidenav_button_switcher',
        '==',
        'true',
      ),
    ),
    array(
      'id' => 'i_sidenav_button_content',
      'type' => 'text',
      'title' => '按钮内容',
      'dependency' => array(
        'i_sidenav_button_switcher',
        '==',
        'true',
      ),
    ),
    array(
      'id' => 'i_sidenav_button_href',
      'type' => 'text',
      'title' => '按钮内容链接',
      'dependency' => array(
        'i_sidenav_button_switcher',
        '==',
        'true',
      ),
    ),
    array(
      'id' => 'i_colorful_card',
      'type' => 'group',
      'title' => '添加首页自定义卡片',
      'button_title' => '添加',
      'accordion_title' => '新添加卡片',
      'fields' => array(
        array(
          'id' => 'i_colorful_card_icon',
          'type' => 'icon',
          'title' => '图标',
        ),
        array(
          'id' => 'i_colorful_card_title',
          'type' => 'text',
          'title' => '标题',
        ),
        array(
          'id' => 'i_colorful_card_href',
          'type' => 'text',
          'title' => '链接',
        ),
        array(
          'id' => 'i_colorful_card_color',
          'type' => 'color_picker',
          'title' => '颜色',
        ),
      ),
    ),
  ),
);

/**
 * footer
 */
$options[] = array(
  'name' => 'footer',
  'title' => '底部设置',
  'icon' => 'czs-medal',
  'fields' => array(
    array(
      'id' => 'i_site_date',
      'type' => 'text',
      'title' => '建站时间',
      'default' => 2017,
    ),
    array(
      'id' => 'i_site_description',
      'type' => 'text',
      'title' => '网站简介介绍',
      'default' => "为极客、创意工作者而设计",
    ),
    array(
      'id' => 'i_site_record',
      'type' => 'text',
      'title' => '网站备案号',
      'default' => "京ICP备1000000号-01",
    ),
    array(
      'id' => 'i_site_record_href',
      'type' => 'text',
      'title' => '网站备案链接',
      'default' => "http://www.miitbeian.gov.cn",
    )
  ),
);

/**
 * ad
 */
$options[] = array(
  'name' => 'ad',
  'title' => '广告设置',
  'icon' => 'czs-money',
  'fields' => array(
    array(
      'id' => 'i_ad_footer_switcher',
      'type' => 'switcher',
      'title' => '开启底部广告',
    ),
    array(
      'id' => 'i_ad_footer_group',
      'type' => 'group',
      'title' => '添加底部广告',
      'button_title' => '添加',
      'accordion_title' => '新添加底部广告',
      'fields' => array(
        array(
          'id' => 'i_ad_footer_code',
          'type' => 'textarea',
          'title' => '广告代码',
        ),
      ),
      'dependency' => array(
        'i_ad_footer_switcher',
        '==',
        'true'
      )
    ),
  ),
);

/**
 * follow
 */
$options[] = array(
  'name' => 'follow',
  'title' => '关注我们',
  'icon' => 'czs-people',
  'fields' => array(
    array(
      'id' => 'i_follow_wechat',
      'type' => 'upload',
      'title' => '微信公众号二维码',
      'default' => get_template_directory_uri() . "/assets/images/wechat_qrcode.png",
    ),
  )
);

/**
 * seo
 */
$options[] = array(
  'name' => 'seo',
  'title' => 'SEO设置',
  'icon' => 'czs-bug',
  'fields' => array(
    array(
      'id' => 'i_seo_keywords',
      'type' => 'text',
      'title' => '网站关键字keywords',
      'default' => '黑格主题',
    ),
    array(
      'id' => 'i_seo_description',
      'type' => 'textarea',
      'title' => '网站描述description',
      'default' => '黑格(Heige)主题，一款漂亮而优雅的主题，为自媒体、极客而设计！',
    ),
    array(
      'id' => 'i_seo_statistics',
      'type' => 'textarea',
      'title' => '统计代码',
      'desc' => '支持百度统计',
    ),

  )
);

/**
 * code
 */
$options[] = array(
  'name' => 'code',
  'title' => '自定义',
  'icon' => 'czs-chemistry',
  'fields' => array(
    array(
      'id' => 'i_code_footer',
      'type' => 'textarea',
      'title' => 'footer自定义代码',
      'desc' => '显示在网站版权之前'
    ),
    array(
      'id' => 'i_code_css',
      'type' => 'textarea',
      'title' => '自定义样式css代码',
      'desc' => '不要添加style标签',
    ),
  )
);

/**
 * backup
 */
$options[] = array(
  'name' => 'backup_section',
  'title' => '配置备份',
  'icon' => 'czs-list-clipboard',
  'fields' => array(

    array(
      'type' => 'notice',
      'class' => 'warning',
      'content' => 'You can save your current options. Download a Backup and Import.',
    ),

    array(
      'type' => 'backup',
    ),

  )
);

// ------------------------------
// license                      -
// ------------------------------
$options[] = array(
  'name' => 'license_section',
  'title' => '创造狮',
  'icon' => 'czs-about-l',
  'fields' => array(
    array(
      'type' => 'heading',
      'content' => '黑格主题-创造狮团队'
    ),
    array(
      'type' => 'content',
      'content' => '黑格主题官方店铺购买地址：<a href="https://chuangzaoshi.taobao.com" target="_blank">创造狮店铺</a>',
    ),
    array(
      'type' => 'content',
      'content' => '为自媒体、极客、创意工作者而设计的网站主题模板，详情请访问：<a href="http://heige.chuangzaoshi.com" target="_blank">黑格主题</a>',
    ),
    array(
      'type' => 'content',
      'content' => '黑格主题图标，配置<a href="http://www.chuangzaoshi.com/icon" target="_blank">草莓图标库</a>',
    ),

  )
);

CSFramework::instance($settings, $options);
