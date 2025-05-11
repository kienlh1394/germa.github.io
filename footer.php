<?php global $ainext_opt;
/**
 * The template for displaying the footer
 * @package AiNext
*/

	$enable_back_to_top = isset( $ainext_opt['enable_back_to_top']) ? $ainext_opt['enable_back_to_top'] : '1';
	
	get_template_part('template-parts/footer/style','one'); ?>

	<?php if( $enable_back_to_top == true ) : ?>
		<div id="progress">
			<span id="progress-value"><i class="ri-arrow-up-line"></i></span>
		</div>
	<?php endif; ?>

	<?php wp_footer(); ?>

	</body>
</html>