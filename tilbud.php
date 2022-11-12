<?php  /* Template Name: Tilbud */ 

get_header();

?>

<?php
$args = array(
    'post_type' => 'product',
    'meta_key' => '_sale_price'
);

$loop = new WP_Query($args);

// Loop products on sale
while ( $loop->have_posts() ) {
    $loop->the_post();

    $price = get_post_meta( get_the_ID(), '_regular_price', true);
    $sale = get_post_meta( get_the_ID(), '_sale_price', true);

    ?>
    <img class="medarbejder-image" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
    <h3> <?php the_title(); ?> </h3>
    <p> <?php the_excerpt(); ?></p>
    <p> 
        <span><?php echo $price . ' kr.' ?></span>
        <span><?php echo $sale . ' kr.' ?></span> 
    </p>
    <?php
}

 
get_footer();


