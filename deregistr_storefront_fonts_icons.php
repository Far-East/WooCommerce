// Отключаем шрифты и иконки в теме StoreFront
function my_deregister_styles() {
    wp_deregister_style ( 'storefront-icons' );
    wp_deregister_style ( 'storefront-fonts' );
}
add_action('wp_print_styles', 'my_deregister_styles', 100);

