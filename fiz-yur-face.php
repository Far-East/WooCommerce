<?php

// Добавление выбора физ. или юр. лицо
add_action( 'woocommerce_before_checkout_billing_form', 'organisation_checkout_field' );
function organisation_checkout_field( $checkout ) {
	echo '<div id="organisation_checkout_field">';
	woocommerce_form_field( 'organisation', array(
		'type'    => 'radio',
		'class'   => array('form-row-wide'),
		'label'   =>  '',
		'options' => array(
			'private_person' => 'Частное лицо',
			'company' => 'Организация'
		)
	), $checkout->get_value( 'organisation' ));
	echo '</div>';
}

// Создаем поля, которые нужны при выборе юридического лица
add_action( 'woocommerce_legal_face', 'my_custom_checkout_field_legal_face' );
function my_custom_checkout_field_legal_face( $checkout ) {
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	
	echo '<div class="woocommerce-organisation-fields__field-wrapper"><h3>Реквизиты организации</h3>';
	
	woocommerce_form_field( 'organisation_name', array(
		'required'      => true,
		'type'          => 'text',
		'class'         => array('my-field-class form-row-wide'),
		'placeholder'   => __('Наименование'),
	), get_user_meta( $user_id, 'organisation_name', true ));
	
	woocommerce_form_field( 'organisation_address', array(
		'required'      => true,
		'type'          => 'text',
		'class'         => array('my-field-class form-row-wide'),
		'placeholder'   => __('Адрес организации'),
	), get_user_meta( $user_id, 'organisation_address', true ));
	
	woocommerce_form_field( 'organisation_inn', array(
		'required'      => true,
		'type'          => 'text',
		'class'         => array('my-field-class form-row-first'),
		'placeholder'   => __('ИНН'),
	), get_user_meta( $user_id, 'organisation_inn', true ));
	
	woocommerce_form_field( 'organisation_kpp', array(
		'required'      => true,
		'type'          => 'text',
		'class'         => array('my-field-class form-row-last'),
		'placeholder'   => __('КПП'),
	), get_user_meta( $user_id, 'organisation_kpp', true ));
	
	woocommerce_form_field( 'organisation_checking_account', array(
		'required'      => true,
		'type'          => 'text',
		'class'         => array('my-field-class form-row-wide'),
		'placeholder'   => __('Расчетный счет'),
	), get_user_meta( $user_id, 'organisation_checking_account', true ));
	
	woocommerce_form_field( 'organisation_bank', array(
		'required'      => true,
		'type'          => 'text',
		'class'         => array('my-field-class form-row-wide'),
		'placeholder'   => __('Банк'),
	), get_user_meta( $user_id, 'organisation_bank', true ));
	
	echo '</div>';
}

// Прописываем скрипты: один из пунктов выбора по умолчанию и скрытие группы полей Реквизиты, если выбран вариант физ. лицо

function main_hook_javascript() {
	?>
	<script>
		jQuery( function ( $ ) {
			// Включить радио кнопку изначально
			jQuery(function() {
				var $radios = jQuery('input:radio[name=organisation]');
				if($radios.is(':checked') === false) {
					$radios.filter('[value="private_person"]').prop('checked', true);
				}
			});

// Скрытие реквизитов
			jQuery(document).ready(function($){
				$('.woocommerce-organisation-fields__field-wrapper').hide();

				$("input[name=organisation]:radio").click(function () {
					if ($('input[name=organisation]:checked').val() == "private_person") {
						$('.woocommerce-organisation-fields__field-wrapper').hide();
					} else if ($('input[name=organisation]:checked').val() == "company") {
						$('.woocommerce-organisation-fields__field-wrapper').show();
					}
				});
			});
		});
	</script>
	<?php
}
add_action('wp_footer', 'main_hook_javascript');

// Функция верификации (заполнены ли обязательные поля). Особенностью функции является вывод предупреждения только в
// случае если выбрано юр. лицо:

add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');
function my_custom_checkout_field_process() {
	$radioVal = $_POST["organisation"];
	
	if($radioVal == "company") {
		if ( ! $_POST['organisation_name'] ) wc_add_notice( __( '<strong>Наименование организации</strong> является обязательным полем.' ), 'error' );
		if ( ! $_POST['organisation_address'] ) wc_add_notice( __( '<strong>Адрес организации</strong> является обязательным полем.' ), 'error' );
		if ( ! $_POST['organisation_inn'] ) wc_add_notice( __( '<strong>ИНН</strong> является обязательным полем.' ), 'error' );
		if ( ! $_POST['organisation_kpp'] ) wc_add_notice( __( '<strong>КПП</strong> является обязательным полем.' ), 'error' );
		if ( ! $_POST['organisation_checking_account'] ) wc_add_notice( __( '<strong>Расчетный счет</strong> является обязательным полем.' ), 'error' );
		if ( ! $_POST['organisation_bank'] ) wc_add_notice( __( '<strong>Банк</strong> является обязательным полем.' ), 'error' );
	}
}

// Функция сохранения полей. Причем данные поля сохраняем не как order meta, а как user meta.
// Update user meta with field value

add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
function my_custom_checkout_field_update_order_meta() {
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	
	$radioVal = $_POST["organisation"];
	if($radioVal == "company") { update_user_meta( $user_id, 'company', 'on' ); } else { delete_user_meta( $user_id, 'company' ); }
	
	if ( ! empty( $_POST['organisation_name'] ) ) { update_user_meta( $user_id, 'organisation_name', sanitize_text_field( $_POST['organisation_name'] ) ); }
	if ( ! empty( $_POST['organisation_address'] ) ) { update_user_meta( $user_id, 'organisation_address', sanitize_text_field( $_POST['organisation_address'] ) ); }
	if ( ! empty( $_POST['organisation_inn'] ) ) { update_user_meta( $user_id, 'organisation_inn', sanitize_text_field( $_POST['organisation_inn'] ) ); }
	if ( ! empty( $_POST['organisation_kpp'] ) ) { update_user_meta( $user_id, 'organisation_kpp', sanitize_text_field( $_POST['organisation_kpp'] ) ); }
	if ( ! empty( $_POST['organisation_checking_account'] ) ) { update_user_meta( $user_id, 'organisation_checking_account', sanitize_text_field( $_POST['organisation_checking_account'] ) ); }
	if ( ! empty( $_POST['organisation_bank'] ) ) { update_user_meta( $user_id, 'organisation_bank', sanitize_text_field( $_POST['organisation_bank'] ) ); }
}


// Изменить набор методов платежей в зависимости от формы плательщика
add_filter( 'woocommerce_available_payment_gateways', 'kvk_field_cheque_payment_method', 20, 1);
function kvk_field_cheque_payment_method( $gateways ){
	if( !is_admin() ) {
		foreach( $gateways as $gateway_id => $gateway ) {
			
			if( WC()->session->get( 'is_company' ) ){
				unset( $gateways['cod'] );
			} else {
				unset( $gateways['bacs'] );
			}
		}
		return $gateways;
	}
}

// The WordPress Ajax PHP receiver
add_action( 'wp_ajax_kvk_nummer', 'get_ajax_kvk_nummer' );
add_action( 'wp_ajax_nopriv_kvk_nummer', 'get_ajax_kvk_nummer' );
function get_ajax_kvk_nummer() {
	
	if ( $_POST['organisation'] == 'company' ){
		WC()->session->set('is_company', '1');
	} else {
		WC()->session->set('is_company', '0');
	}
	die();
}

// The jQuery Ajax request
add_action( 'wp_footer', 'checkout_kvk_fields_script' );
function checkout_kvk_fields_script() {
	// Only checkout page
	if( is_checkout() && ! is_wc_endpoint_url() ):
		
		// Remove "is_company" custom WC session on load
		if( WC()->session->get('is_company') ){
			WC()->session->__unset('is_company');
		}
		?>
		<script type="text/javascript">
			jQuery( function($){
				var a = 'input[name=organisation]';

				// Ajax function
				function checkKvkNummer( value ){
					$.ajax({
						type: 'POST',
						url: wc_checkout_params.ajax_url,
						data: {
							'action': 'kvk_nummer',
							'organisation': $('input[name=organisation]:checked').val(),
							//'organisation': value != '' ? 1 : 0, // чредование значений для валидации text или включения checkbox
						},
						success: function (result) {
							$('body').trigger('update_checkout');
						}
					});
				}

				// On start
				checkKvkNummer($(a).val());

				// On change event
				$(a).change( function () {
					checkKvkNummer($(this).val());
				});
			});
		</script>
	<?php
	endif;
};
