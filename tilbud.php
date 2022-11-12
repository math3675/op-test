<?php  /* Template Name: Tilbud */ 

get_header();

?>

<section class="container tilbud">
    <div class="row">

    <?php
    $args = array(
        'post_type' => 'product',
        'meta_key' => '_sale_price'
    );

    $loop = new WP_Query($args);

    // Loop products on sale
    while ( $loop->have_posts() ) {
        $loop->the_post();

        $id = get_the_ID();
        $price = get_post_meta( $id, '_regular_price', true);
        $sale = get_post_meta( $id, '_sale_price', true);
        $add_to_cart = do_shortcode('[add_to_cart_url id="' . $id .'"]');

        ?>
        <div class="card col-md-3">
            <img class="card-img-top" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            <div class="card-body">
                <h3> <?php the_title(); ?> </h3>
                <p> <?php the_excerpt(); ?></p>
                <p> 
                    <span><?php echo $price . ' kr.' ?></span>
                    <span><?php echo $sale . ' kr.' ?></span> 
                </p>
                <a href="<?php echo $add_to_cart ?>"><button>Tilføj til kurv</button></a>
            </div>
        </div>
        <?php
    }
    ?>

    </div>
</section>

<?php

    get_footer();

?>


