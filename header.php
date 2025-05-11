<?php global $ainext_opt;
/**
 * The header for our theme
 * @package AiNext
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<?php if( isset( $ainext_opt['enable_preloader'] ) && $ainext_opt['enable_preloader'] == true ): ?>
	    <div class="preloader-area position-fixed text-center" id="preloader">
            <div class="loader">
                <div class="waviy">
                    <span><?php esc_html_e('AiNext' , 'ainext'); ?></span>
                </div>
            </div>
        </div>
	<?php endif; ?>

	<?php 
		get_template_part('template-parts/header/style','1'); 
	?>