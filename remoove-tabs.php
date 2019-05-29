<?php

//  Отключение вкладок на странице товара
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
unset( $tabs['description'] ); // Отключить вкладку "Описание"
unset( $tabs['reviews'] ); // Отключить вкладку "Отзывы"
unset( $tabs['additional_information'] ); // Отключить вкладку "Свойства"
return $tabs;
}

