<?php
/*
 * Добавляю дополнительное поле на страницу оформления заказа
 * https://docs.woocommerce.com/document/tutorial-customising-checkout-fields-using-actions-and-filters/#section-7
 * 1. Добавляем поле к оформлению заказа.
 * 2. Валидация, проверка поля на заполнение.
 * 3. Обновляем метаданные заказа с помощью значения поля (сохранение).
 * 4. Отображение значения поля на странице редактирования заказа (в админке).
 * 5. Отображение значения поля в письмах.
 * 6. Отображение значения поля на страницах Детали Заказа и Спасибо за покупку.
*/
 
// 1. Добавляем поле к оформлению заказа
add_action( 'woocommerce_after_checkout_billing_form', 'my_custom_checkout_field' );
 
function my_custom_checkout_field( $checkout ) {
    
    echo '<div id="my_custom_checkout_field">';
    
    woocommerce_form_field( 'person_count', array(
        'type'          => 'text',
        'class'         => array('form-row-wide'),
        'label'         => __('Количество персон'),
        'placeholder'   => __('Введите количество персон'),
    ), $checkout->get_value( 'person_count' ));
    
    echo '</div>';
}
 
// 2. Валидация, проверка поля на заполнение
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');
 
function my_custom_checkout_field_process() {
    // Проверка, если не заполнено, добавляем ошибку.
    if ( ! $_POST['person_count'] )
        wc_add_notice( __( 'Пожалуйста, введите количество персон.' ), 'error' );
}
 
// 3. Обновляем метаданные заказа с помощью значения поля (сохранение).
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
 
function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['person_count'] ) ) {
        update_post_meta( $order_id, 'Количество персон', sanitize_text_field( $_POST['person_count'] ) );
    }
}
 
// 4. Отображение значения поля на странице редактирования заказа
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
 
function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Количество персон').':</strong> ' . get_post_meta( $order->get_id(), 'Количество персон', true ) . '</p>';
}
 
// 5. Отображение значения поля в письмах
add_filter('woocommerce_email_order_meta_keys', 'my_custom_order_meta_keys');
 
function my_custom_order_meta_keys( $keys ) {
    $keys[] = 'Количество персон';
    return $keys;
}
 
// 6. Отображение значения поля на страницах Детали Заказа и Спасибо за покупку.
add_action( 'woocommerce_thankyou', 'misha_view_order_and_thankyou_page', 5 );
add_action( 'woocommerce_view_order', 'misha_view_order_and_thankyou_page', 5 );
 
function misha_view_order_and_thankyou_page( $order_id ){  ?>
    <h4>Дополнительно</h4>
    <table class="woocommerce-table shop_table gift_info">
        <tbody>
        <tr>
            <th>Количество персон</th>
            <td><?php echo get_post_meta( $order_id, 'Количество персон', true ); ?></td>
        </tr>
        </tbody>
    </table>
<?php } 
