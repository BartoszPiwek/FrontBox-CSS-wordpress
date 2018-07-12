<!doctype html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>

	<?php
		global $version;
		$post_id = $post->ID;
		$page_title = get_the_title();

		if (has_post_thumbnail() && !is_front_page() &&!is_home()) {
			$thumb_id = get_post_thumbnail_id();
			$page_image = wp_get_attachment_image_src( $thumb_id,'og-image', true )[0];
		} else {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$page_image = wp_get_attachment_image_src( $custom_logo_id , 'og-image', true )[0];
		}
		if (is_home() || is_front_page() ) {
			$page_description = get_bloginfo("description");
		} else {
			if (has_excerpt($post_id)) {
				$page_description = get_the_excerpt($post_id);
			} else {
				$page_description = get_post_meta($post_id, "meta_description", true);
			}
		}

		$page_keywords = get_post_meta($post_id, "meta_keywords", true);
	?>

	<meta charset="utf-8">
	<meta name="author" content="Bartosz Piwek">
	<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<link rel="canonical" href="<?php echo site_url(); ?>">
    <meta property="og:url" content="<?php echo site_url(); ?>">
	<meta name="keywords" content="<?php echo $page_keywords ?>">
	<title><?php echo $page_title ?></title>
	<meta itemprop="name" content="<?php echo $page_title ?>">
    <meta name="twitter:title" content="<?php echo $page_title ?>">
    <meta property="og:title" content="<?php echo $page_title ?>">

	<meta name="description" content="<?php echo $page_description ?>">
	<meta property="og:description" content="<?php echo $page_description ?>">
    <meta itemprop="description" content="<?php echo $page_description ?>">
	<meta name="twitter:description" content="<?php echo $page_description ?>">
	<meta property="og:type" content="website">
	<meta property="og:image" content="<?php echo $page_image; ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:image:src" content="<?php echo $page_image; ?>">
	<meta itemprop="image" content="<?php echo $page_image; ?>">
	
	<?php
		if( !has_site_icon() ) {
			$template = 'template-parts/favicon.php';
			if (file_exists($template)) {
				include($template);
			}
		}
	?>

	<?php wp_head(); ?>
</head>

<body id="body" <?php body_class(); ?>>