// Меняю местами вкладки (табы)  и апсейлы на странице продуктов
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'bbloomer_woocommerce_output_upsells', 5 );
function bbloomer_woocommerce_output_upsells() {
	woocommerce_upsell_display();
	// Display max 3 products, 3 per row
	// woocommerce_upsell_display( 3,3 );
}
