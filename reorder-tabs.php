// Меняем местами вкладки на странице продуктов
add_filter( 'woocommerce_product_tabs', 'woo_reorder_tabs', 98 );
function woo_reorder_tabs( $tabs ) {
	
	$tabs['woodmart_additional_tab']['priority'] = 5;
	$tabs['description']['priority'] = 10;
	$tabs['reviews_tab']['priority'] = 15;
	
	return $tabs;
}
