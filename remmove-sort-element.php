<?php
// Убрать из сортировки товаров элемент
add_filter('woocommerce_catalog_orderby','in_woocommerce_catalog_orderby');

function in_woocommerce_catalog_orderby($args){
    unset($args['popularity']);
    unset($args['rating']);
    return $args;
}

// Список названий всех видов сортировки
array(
   'menu_order' => __( 'Default sorting', 'woocommerce' ),
   'popularity' => __( 'Sort by popularity', 'woocommerce' ),
   'rating'     => __( 'Sort by average rating', 'woocommerce' ),
   'date'       => __( 'Sort by latest', 'woocommerce' ),
   'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
   'price-desc' => __( 'Sort by price: high to low', 'woocommerce' ),
)
