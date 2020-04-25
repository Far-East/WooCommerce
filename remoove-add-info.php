<?php
// Отключить весь блок дополнительная информация при оформлении заказа
add_filter('woocommerce_enable_order_notes_field', '__return_false');
