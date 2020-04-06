// Меняем надпись в бейдже "Распродажа" на процент
add_filter( 'woocommerce_sale_flash', 'tcore_percentage_sale', 10, 3 );
function tcore_percentage_sale( $text, $post, $product ) {
	
	$text = '<span class="onsale">';
	
	$regular = $product->regular_price;
	$sale = $product->sale_price;
	if ( isset( $sale ) ) {
		$discount = ceil( ( ($regular - $sale) / $regular ) * 100 );
	}
	
	$text .= '-' . $discount . '%';
	
	$text .= '</span>';
	return $text;
	
}
