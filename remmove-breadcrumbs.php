<?php
// Удалить breadcrumbs из магазина и категорий
add_filter( 'woocommerce_before_main_content', 'remove_breadcrumbs');
function remove_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
}
// Подключаем свои breadcrumbs
add_action( 'woocommerce_single_product_summary', 'add_breadcrumbs', 1 );
function add_breadcrumbs() {
	do_action( 'echo_kama_breadcrumbs' );
}
