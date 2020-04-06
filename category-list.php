// Вывод списока категорий WooCommerce
<?php $terms = get_terms(array(
	'taxonomy' => 'product_cat',
	'hide_empty' => false,
	'orderby' => 'menu_order',
	'parent' => 0
)); ?>
<?php if ($terms) : ?>
	<div class="main-category-collect">
		<ul class="main-category-list">
			<?php foreach ($terms as $term) : ?>
				<li>
					<a href="<?php echo get_term_link($term->term_id); ?>">
						<?php woocommerce_subcategory_thumbnail($term); ?>
						<h4><?php echo $term->name; ?></h4>
						<span class="main-category-count"><?php if ($term->count > 0) : ?><?php
								echo
								$term->count; ?><?php else: ?>0<?php endif; ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
