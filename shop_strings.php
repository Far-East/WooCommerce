<?php
// Замена стандартных текстов
function rog_shop_strings( $translated_text, $text, $domain ) {
	
	if( 'woocommerce' === $domain ) {
		
		switch ( $translated_text ) {
			case 'Возможно Вас также заинтересует&hellip;' :
				$translated_text = 'С этим товаром покупают';
				break;
		}
		
	}
	
	return $translated_text;
}
add_filter( 'gettext', 'rog_shop_strings', 20, 3 );
