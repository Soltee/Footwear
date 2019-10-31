<?php 

$products = new WP_Query([
	'post_type' => 'product',
	'post_per_page' => 2
]);

if(has_posts($products)){
	while ($products->have_posts()) {
	$products->the_post();
?>
<h3><?php echo the_title(); ?></h3>
<?php
}}
?>