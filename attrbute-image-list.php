<?php
/**
 * Вывод списка атрибутов с картинками плюс товары по атрибутам
 * Для работы кода нужен плагин ACF.
 * Ярлык поля cat_image. Тип поля изображение. Возвращаемый формат массив изображения. Условие отображения таксономия - ваш атрибут.
 * Создается отдельный шаблон, туда код.
 */
 ?>
 
<?php //Начало выборки терминов для таксономии pa_avtor
$terms = get_terms('pa_avtor', array(
	'hide_empty' => false,
	'number' => 10,
));

// Теперь выполняется запрос для каждого автора
foreach ($terms as $term) { ?>
	<div class="row">
		<?php // Определение запроса
		$args = array(
			'post_type' => 'product',
			'pa_avtor' => $term->slug,
		);
		$query = new WP_Query($args); ?>
		
		
		<?php if ($cat_image = get_field("cat_image", $term)) { ?>
	<?php
	$cat_image = get_field('cat_image', $term);
	$url = $cat_image['url'];
	$alt = $cat_image['alt'];
	// Миниатюра
	$size = 'attribute-size'; // Размер миниатюры.
	$thumb = $cat_image['sizes'][$size];
	?>

		<div class="col-md-3">
			<!--Вывод изображения категории-->
			<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>"/>
			
			<?php } ?>

			<h4><a href="<?php echo get_category_link($term->term_id); ?>"><?php echo $term->name;
					?></a></h4>
		</div>

		<div class="col-md-9">
			<div class="row">
				<?php
				while ($query->have_posts()) : $query->the_post(); ?>

					<div class="col-md-4" id="post-<?php the_ID(); ?>">
						<?php the_post_thumbnail('attribute-size'); ?>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<?php
						woocommerce_template_loop_price();
						woocommerce_template_loop_add_to_cart();
						
						?>
						<?php echo wc_get_product_category_list($product->get_id(), ', ', '<span class="posted_in">' . _n('Category:', 'Categories:', count($product->get_category_ids()), 'woocommerce') . ' ', '</span>'); ?>
					</div>
				
				<?php endwhile; ?>

			</div>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>
<?php } ?>
