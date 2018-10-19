<!doctype html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>

	<?php
		global $version;
		$post_id = $post->ID;
		$googleTagManager = get_option('google-tag-manager');

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

	<?php

		/* Add Google Tag Manager code */
		if ($googleTagManager) {
			?>
				<script>
					(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?php echo $googleTagManager ?>');
				</script>
			<?php
		}

		/* Title */
		if ( is_archive() ) {
			$page_title = get_the_archive_title();
		}
		else {
			$metaTitle = get_post_meta($post->ID, 'meta_title', true);
			if ( $metaTitle ) {
				$page_title = $metaTitle;
			}
			else {
				$page_title = get_the_title();
			}
		}
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

<body id="body">
	
	<?php

		/* Add Google Tag Manager code */
		if ($googleTagManager) {
			?>
				<noscript>
					<iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $googleTagManager ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe>
				</noscript>
			<?php
		}

		include("template-parts/navigation.php");	
	?>

<div class="page-content relative">