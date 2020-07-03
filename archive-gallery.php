<?php
/**
 * Галерея изображений в архиве
 * pa_avtor — Атрибут, значения которого можно выводить в меню.
 * https://opttour.ru/plugins/galereya-izobrazheniy-tovara-v-kategorii/
 * добавляется в файл archive-product.php после header
 */

function woocommerce_feature_gallery() {
	
	global $product;
	$attachment_ids = $product->get_gallery_image_ids();
	
	echo '<div class="feature-slider">';
	
	echo '<div>';
	echo get_the_post_thumbnail( $post->ID, 'shop_single');
	echo '</div>';
	
	foreach( $attachment_ids as $attachment_id ) {
		echo '<div>';
		echo wp_get_attachment_image( $attachment_id, 'shop_catalog' );
		echo '</div>';
	}
	echo '</div>';
	
}

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 ); //Убираем вывод одиночного изображения
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_feature_gallery', 8 );
