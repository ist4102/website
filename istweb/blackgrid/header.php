<?php
/**
 * Created by PhpStorm.
 * User: Overbool
 * Date: 2019-03-21
 * Time: 22:54
 */
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="<?php echo cs_get_option('i_seo_keywords'); ?>">
  <meta name="description" content="<?php echo cs_get_option('i_seo_description'); ?>">
  <link rel="shortcut icon" href="<?php echo cs_get_option('i_favicon_url'); ?>" type="image/x-icon">
  <title><?php echo get_bloginfo("name") . " - " . get_bloginfo("description"); ?></title>
  <?php wp_head(); ?>
  <style type="text/css">
    <?php echo cs_get_option('i_code_css'); ?>
  </style>
  <script>
    var isHomePage = "<?php echo is_home(); ?>";
    var homeURL = "<?php echo home_url(); ?>";
  </script>
</head>
<body>

<?php get_template_part('template-parts/sidenav'); ?>

<main class="main" data-id="">
  <?php get_template_part('template-parts/navbar'); ?>

