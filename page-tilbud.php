<?php  /* Template Name: Tilbud */ 

get_header();


if ($_GET["order"] === "price-low") {
    $selected = 'Pris (lav til høj)';
    $set_orderby = 'meta_value_num';
    $set_order = 'ASC';
} elseif($_GET["order"] === "price-high") {
    $selected = 'Pris (høj til lav)';
    $set_orderby = 'meta_value_num';
    $set_order = 'DESC'; 
} elseif($_GET["order"] === "newest") {
    $selected = 'Nyeste tilbud';
    $set_orderby = 'date';
    $set_order = 'ASC';
} else {
    $selected = 'Sorter produkter';
    $set_orderby = 'meta_value_num';
    $set_order = 'ASC';
}

$category = $_GET['category'];

?>

<section class="container filters">
    <div class="row mb-5">
        <h1><?php the_title() ?></h1>
    </div>
    <div class="row">
        <form class="sort-products d-md-flex align-items-end" method="get" action="">
            <div class="col-12 col-sm-8">
                <h3>Kategorier</h3>
                <?php
                    $tax_terms = get_terms( array(
                        'child_of' => 25,
                        'taxonomy'  => 'product_cat',
                    ));
                    
                    foreach( $tax_terms as $term ) {
                        ?>
                            <input id="<?php echo $term->slug ?>" type="radio" name="category" <?php if($category === $term->slug) echo "checked"; ?> value="<?php echo $term->slug ?>" onChange="submit()">
                            <label class="me-3" for="<?php echo $term->slug ?>"><?php echo $term->name ?></label>
                        <?php
                    }
                ?>
                <input type="radio" name="category" id="all-shoes" value="" <?php if($category == null) echo "checked"; ?> value="" onChange="submit()">
                <label class="me-3" for="all-shoes">Alle</label>
                </div>
                <div class="col-12 col-sm-4">
                <select class="form-select" name="order" onChange="submit()">
                    <option style="display:none" selected><?php echo $selected ?></option>
                    <option value="price-low">Pris (lav til høj)</option>
                    <option value="price-high">Pris (høj til lav)</option>
                    <option value="newest">Nyeste tilbud</option>
                </select>
            </div>
        </form>
    </div>
</section>

<section class="container tilbud">
    <div class="row">
    <?php

    $args = array(
        'post_type' => 'product',
        'product_cat' => $category,
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


