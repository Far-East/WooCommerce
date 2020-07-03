<?php

/**
 * Значения атрибута в пункте меню
 * pa_avtor — Атрибут, значения которого можно выводить в меню.
 */
add_filter('woocommerce_attribute_show_in_nav_menus', 'wc_reg_for_menus', 1, 2);

function wc_reg_for_menus( $register, $name = '' ) {
	if ( $name == 'pa_avtor' ) $register = true;
	return $register;
}
