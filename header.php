<!DOCTYPE html><!-- Theme By JeffDesign.Net -->
<html class="no-js" <?php language_attributes(); //Theme By JeffDesign.Net?>>
<head profile="http://gmpg.org/xfn/11">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
<meta name="apple-mobile-web-app-capable" content="yes">
<title><?php wp_title( '|', true, 'right' ); echo esc_html( get_bloginfo('name'), 1 ); ?></title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="header clear">
<a class="logo" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'title' ) ); ?> &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>' rel='home'><?php echo esc_attr( get_bloginfo( 'title' ) ); ?></a>
<a class="nav-toggle hidden" title="点击打开菜单" href="#">
<div class="bars"><div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="clear"></div></div>
<p><span class="menu">菜单</span><span class="close">关闭</span></p>
</a>
</div>
<nav class="nav">
<ul class="nav-menu">
<?php get_search_form(); ?>
<?php if ( has_nav_menu( 'primary' ) ) {wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s','theme_location' => 'primary') ); } else {wp_list_pages( array('container' => '','title_li' => ''));} ?>
</ul>
</nav>
<div class="wrapper" id="wrapper">
