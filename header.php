<?php

/**
 * The header for the theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package loop
 */

?><!DOCTYPE html>

<html class="landing" lang="en-EN">

<head>

  <meta charset="<?php bloginfo( 'charset' ); ?>">

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <meta name="robots" content="index, follow">

  <meta name="referrer" content="always">

  <meta http-equiv="x-dns-prefetch-control" content="on">

  <link rel="dns-prefetch" href="//fonts.googleapis.com">

  <link rel="dns-prefetch" href="//fonts.gstatic.com">

  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

  <link rel="profile" href="http://gmpg.org/xfn/11">

  <?php wp_head(); ?>

</head>

<body <?php body_class( 'layout' ); ?>>

  <header id="masthead" class="layout-header" role="banner">

    <div class="header-container layout-module">

      <div class="blog-name"><?php echo esc_html( get_bloginfo( 'name', 'display' ) ); ?></div>

    </div>

  </header><!-- .layout-header -->

  <main class="layout-main" role="main">
