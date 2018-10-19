<?php
/**
 * Site header
 *
 * @package kelso
 */

?>
<!DOCTYPE html>
<?php tha_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php tha_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
<?php tha_head_bottom(); ?>
</head>

<body <?php body_class(); ?>>
<?php tha_body_top(); ?>

<div id="page" class="site<?php kelso_sitecontain_class(); ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'kelso' ); ?></a>

	<?php tha_header_before(); ?>

	<header id="masthead" class="site-header">

		<div class="header-wrap">
			<div class="inner-wrap">
				<?php
				tha_header_top();
				kelso_display_branding();
				kelso_display_nav();
				tha_header_bottom();
				?>
			</div>
		</div>

		<?php kelso_display_customheader(); ?>

	</header>

	<?php tha_header_after(); ?>

	<div id="content" class="site-content">
		<div class="content-wrap">
