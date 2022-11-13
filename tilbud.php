<?php  /* Template Name: Tilbud */ 

get_header();

?>

<section class="container tilbud">
    <div class="row">

    <form method="get">
    <select class="form-select" aria-label="Default select example" name="order">
        <option selected value="price-low">Pris (lav til høj)</option>
        <option value="price-high">Pris (høj til lav)</option>
        <option value="newest">Nyeste tilbud</option>
    </select>
    <button type="submit" class="button">kks</button>
    </form>

    <?php

    $set_orderby = 'meta_value_num';
    $set_order = 'ASC';

    if ($_GET["order"] === "price-low") {
        $set_orderby = 'meta_value_num';
        $set_order = 'ASC'; 
    } elseif($_GET["order"] === "price-high") {
        $set_orderby = 'meta_value_num';
        $set_order = 'DESC'; 
    } elseif($_GET["order"] === "newest") {
        $set_orderby = 'date';
        $set_order = 'ASC';
    } else {
        $set_orderby = 'meta_value_num';
        $set_order = 'ASC';
    }

    $args = array(
        'post_type' => 'product',
        'orderby'   => $set_orderby,
        'order'     => $set_order,
        'meta_key'  => '_sale_price'
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
        <div class="col-6 col-md-4 col-lg-3">
        <div class="card product">
            <img class="card-img-top" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            <div class="card-body">
                <h2> <?php the_title(); ?> </h2>
                <p> <?php the_excerpt(); ?></p>
                <p> 
                    <span class="regular-price"><?php echo $price . ' kr.' ?></span>
                    <span class="sale-price"><?php echo $sale . ' kr.' ?></span> 
                </p>
                <a href="<?php echo $add_to_cart ?>"><button>Tilføj til kurv</button></a>
            </div>
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


