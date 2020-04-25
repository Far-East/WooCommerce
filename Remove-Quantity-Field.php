<?php
// Скрыть поле выбора количества количества продукта (+ / -)
function cw_remove_quantity_fields( $return, $product ) {
	return true;
}
add_filter( 'woocommerce_is_sold_individually', 'cw_remove_quantity_fields', 10, 2 );
