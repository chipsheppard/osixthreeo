<?php
/**
 * The header.
 *
 * @package kelso
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'kelso' ); ?></a>

	<?php do_action( 'kelso_before_header' ); ?>

	<header id="masthead" class="site-header">
		<div class="wrap<?php kelso_sitecontain_class(); ?>">

			<?php kelso_display_customheader(); ?>

			<div class="header-wrap">
				<div class="inner-wrap">
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

				</div>
			</div>
		</div>
	</header>

	<?php do_action( 'kelso_before_content' ); ?>

	<div id="content" class="site-content">
		<div class="page-wrap<?php kelso_sitecontain_class(); ?>">
