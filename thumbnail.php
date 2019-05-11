<?php

// для изображения товара на странице каталога
add_filter('woocommerce_get_image_size_thumbnail','add_thumbnail_size',1,10);
function add_thumbnail_size($size){

    $size['width'] = 300;
    $size['height'] = 300;
    $size['crop']   = 1; //0 - не обрезаем, 1 - обрезка
    return $size;
}

// для большого изображения на странице товара
add_filter('woocommerce_get_image_size_single','add_single_size',1,10);
function add_single_size($size){

    $size['width'] = 600;
    $size['height'] = 600;
    $size['crop']   = 0;
    return $size;
}

// для миниатюр в галерее на странице товара
add_filter('woocommerce_get_image_size_gallery_thumbnail','add_gallery_thumbnail_size',1,10);
function add_gallery_thumbnail_size($size){

    $size['width'] = 100;
    $size['height'] = 100;
    $size['crop']   = 1;
    return $size;
}


