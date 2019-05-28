
// Замена знака валюты на буквы
add_filter('woocommerce_currency_symbol', 'misha_symbol_to_bukvi', 9999, 2);
 
function misha_symbol_to_bukvi( $valyuta_symbol, $valyuta_code ) {
	if( $valyuta_code === 'UAH' ) {
		return 'грн.';
	}
	if( $valyuta_code === 'RUB' ) {
		return 'руб.';
	}
	return $valyuta_symbol;
}

// Cделать обозначение валюты меньше по размеру, чем сама цена? Или другого цвета например.
add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 9999, 2);
 
function add_my_currency_symbol( $valyuta_symbol, $valyuta_code ) {
	if( $valyuta_code === 'RUB' ) 
		return '<span class="rubvalut">руб.</span>';
	return $valyuta_symbol;
}

