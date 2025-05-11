<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ainext
 */


 if ( class_exists( 'WooCommerce' ) ) {
	if( is_woocommerce() ) {
		$ainext_sidebar_class = 'shop';
	} elseif ( is_product() ) {
		$ainext_sidebar_class = 'shop';
	} else {
		$ainext_sidebar_class = 'article-sidebar';
	}
} else {
	$ainext_sidebar_class = 'article-sidebar';
}

if ( ! is_active_sidebar( $ainext_sidebar_class ) ) { 
	return;
}
?>

<div class="col-lg-4 col-md-12">
	<?php if ( class_exists( 'WooCommerce' ) ) {
		if( is_woocommerce() ) { ?>
			<div id="secondary" class="shop-sidebar sidebar">
			<?php
		} elseif ( is_product() ) { ?>
			<div id="secondary" class="sidebar shop-sidebar sidebar">
		<?php
		} else { ?>
			<div id="secondary" class="title blog-sidebar sidebar sidebar-widgets widget-area">
		<?php
		}
	} else { ?>
		<div id="secondary" class="title blog-sidebar sidebar sidebar-widgets widget-area">
	<?php } ?>
		<?php dynamic_sidebar( $ainext_sidebar_class );?>
	</div>
</div><!-- #secondary -->