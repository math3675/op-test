<?php  /* Template Name: Medarbejdere */ 

get_header();

?>

<section class="container medarbejdere">

    <select class="form-select" id="choose-afdeling">
        <option selected>Alle afdelinger</option>
        <option type="text" name="afdeling" value="salg">Salg</option>
    </select>

    <?php
    $tax_terms = get_terms( array(
        'taxonomy'   => 'afdelinger',
        'hide_empty' => true, 
    ));

    // Loop afdeling taxonomy
    foreach( $tax_terms as $term ) {

        $args = array(
            'post_type' => 'medarbejdere',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy'  => 'afdelinger',
                    'field'     => 'slug',
                    'terms'     => $term->name
                )
            )
        );

    ?>
    <div class="row mt-4 mb-2">
    <div class="col-6 col-md-6 pt-2 pb-2">
        <div class="afdeling-title p-5"> 
            <h2><?php echo $term->name ?></h2>
            <div class="d-flex mt-5">
                <div class="col-6">
                    <p>OnlinePlus<br>
                    Rugårdsvej 103D<br>
                    5000 Odense</p>
                </div>
                <div class="col-6">
                    <p>Tlf: +45 75 40 00 20</p>
                </div>
            </div>
        </div>
    </div>

    <?php

    $loop = new WP_Query($args);

    // Loop medarbejder custom post type inside single taxonomy
    while ( $loop->have_posts() ) {
        $loop->the_post();
        ?>
        <div class="col-6 col-md-3 col-lg-2 pt-2 pb-2">
            <div class="medarbejder-content">
                <img class="medarbejder-image" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                <div class="info">
                    <h3><?php the_title(); ?></h3>
                    <p class="position"><?php the_field('medarbejder_stilling'); ?></p>
                    <p class="phone"><a href="tel:<?php the_field('telefonnummer'); ?>">+45 <?php the_field('telefonnummer'); ?></a></p>
                </div>
                <div class="info-visibility">
                    <img class="show-info" src="<?php echo get_theme_file_uri() ?>/assets/icons/chevron-up-regular.svg">
                    <img class="hide-info" id="<?php echo get_the_ID() ?>" src="<?php echo get_theme_file_uri() ?>/assets/icons/xmark-regular.svg">
                </div>
            </div>
        </div>
        <?php
    }}
    ?>
    </div>
</section>

<script src="<?php echo get_theme_file_uri() ?>/assets/js/infoVisibility.js ?>"></script>
<?php 
get_footer();
?>