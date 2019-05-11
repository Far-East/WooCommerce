<?php 

// Выбрать опцию, для вариативного товара
add_filter('woocommerce_dropdown_variation_attribute_options_args','my_variation_attribute_options_args',10,1);
function my_variation_attribute_options_args($args){
 $args['show_option_none'] = 'Выбрать цвет';
 return $args;
}

// Для изменения текста кнопки выбрать опции" 
// для вариативного товара можно воспользоваться фильтром, например, если мы хотим поменять текст 
// "выбрать опции" на "выбрать цвет", код будет следующим:
add_filter('woocommerce_product_add_to_cart_text','my_woocommerce_variable_text_button',10,2);
 function my_woocommerce_variable_text_button($text,$product){

if($product->product_type == 'variable'){
 $text = 'Выбрать цвет';
 }

return $text;
 }
 
 // В этой же функции можно поменять текст кнопки "в корзину" для простого товара, добавив  проверку, является ли товар простым:
 if($product->product_type == 'simple'){
 $text = 'Заказать';
 }
 

