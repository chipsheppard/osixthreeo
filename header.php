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

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'kelso' ); ?></a>

	<?php tha_header_before(); ?>

	<header id="masthead" class="site-header">
		<div class="wrap<?php kelso_sitecontain_class(); ?>">

			<?php kelso_display_customheader(); ?>

			<div class="header-wrap">
				<div class="inner-wrap">

					<?php tha_header_top(); ?>

					<div class="site-branding">

						<?php
						$custom_logo_id = get_theme_mod( 'custom_logo' );
						$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
						if ( has_custom_logo() ) {
						?>
							<div class="custom-logo">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo '<img src="' . esc_url( $logo[0] ) . '">'; ?></a>
							</div>
						<?php
						} else {
							if ( is_front_page() && is_home() ) :
							?>
								<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
							<?php else : ?>
								<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
							<?php
							endif;
						}

						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) :
						?>
							<div class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></div>
						<?php endif; ?>

					</div>

					<?php kelso_display_nav(); ?>

					<?php tha_header_bottom(); ?>

				</div>
			</div>

		</div>
	</header>

	<?php tha_header_after(); ?>

	<div id="content" class="site-content">
		<div class="content-wrap<?php kelso_sitecontain_class(); ?>">
