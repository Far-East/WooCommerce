<?php

// Что закомментировано, то остается на странице заказа
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
  
function custom_override_checkout_fields( $fields ) {
    //unset($fields['billing']['billing_first_name']);// имя
    unset($fields['billing']['billing_last_name']);// фамилия
    unset($fields['billing']['billing_company']); // компания
    unset($fields['billing']['billing_address_1']);//
    unset($fields['billing']['billing_address_2']);//
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    //unset($fields['billing']['billing_phone']);
    //unset($fields['order']['order_comments']);
    //unset($fields['billing']['billing_email']);
    unset($fields['account']['account_username']);
    unset($fields['account']['account_password']);
    unset($fields['account']['account_password-2']);
    unset($fields['billing']['billing_company']);// компания
    unset($fields['billing']['billing_postcode']);// индекс 
      return $fields;
  
    // Пример удаления лейблов
  	unset($fields['billing']['billing_first_name']['label']); 
	  unset($fields['billing']['billing_phone']['label']);
	  unset($fields['billing']['billing_email']['label']);
    
    // Пример добавления placeholder
	  $fields['billing']['billing_first_name']['placeholder'] = 'Имя *'; 
	  $fields['billing']['billing_phone']['placeholder'] = 'Телефон *'; 
	  $fields['billing']['billing_phone']['placeholder'] = 'Email *'; 
  
}

