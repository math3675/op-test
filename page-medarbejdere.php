<?php  /* Template Name: Medarbejdere */ 

get_header();

?>

<section class="container medarbejdere">

    <?php
    $tax_terms = get_terms( array(
        'taxonomy'   => 'afdelinger',
        'hide_empty' => true, 
    ));

    
    $afdeling = $_GET['afdeling'];
    ?>
    <div class="row mb-4">
        <div class="col-12 col-md-6 col-lg-8"></div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="selecter">
                <form action="" method="get">
                    <select class="form-select" name="afdeling" id="choose-afdeling" onChange="submit()">
                        <option value="">Alle afdelinger</option>
                        <?php
                        foreach( $tax_terms as $term ) {
                        ?>
                            <option type="text" <?php if($afdeling === $term->slug) echo "selected";?> value="<?php echo $term->slug ?>"><?php echo $term->name ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <?php

    // display afdelinger
    foreach( $tax_terms as $term ) {

        $args = array(
            'post_type' => 'medarbejdere',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy'  => 'afdelinger',
                    'field'     => 'slug',
                    'terms'     => $term->slug
                )
            )
        );
        ?>
        
        <?php 
            if ($term->slug === $afdeling || $afdeling == null) {
                echo '<div class="row mt-2 mb-2">';
            } else {
                echo '<div class="row mt-2 mb-2 d-none">';
            }
        ?>
        <div class="col-6 col-md-6 pt-2 pb-2">
            <div class="afdeling-title p-5"> 
                <h2><?php echo $term->name ?></h2>
                <div class="d-md-flex mt-5">
                    <div class="col-12 col-md-6">
                        <p>OnlinePlus<br>
                        Rugårdsvej 103D<br>
                        5000 Odense</p>
                    </div>
                    <div class="col-12 col-md-6">
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
        }
        ?>
        </div>
        <?php
    }
    ?>
    </div>
</section>

<div class="container more-info">
    <div class="row">
        <div class="col-12">
            <div class="info-content p-5">
                <h2 class="mb-4">Vil du vide mere?</h2>
                <div class="d-flex flex-column flex-md-row">
                    <div class="info-text"> 
                        <p>Er du i tvivl eller har du spørgsmål til vores produkter, er du mere end velkommen til at kontakte os på tlf. eller mail.</p>
                    </div>
                    <div class="info-contact"> 
                        <div>
                            <img class="phone" id="<?php echo get_the_ID() ?>" src="<?php echo get_theme_file_uri() ?>/assets/icons/phone-solid.svg">
                            <a class="phone-link" href="tel:70221144">+45 70 22 11 44</a>
                        </div>
                        <div>
                            <img class="mail" id="<?php echo get_the_ID() ?>" src="<?php echo get_theme_file_uri() ?>/assets/icons/envelope-regular.svg">
                            <a class="mail-link" href="mailto:support@online-plus.dk">support@online-plus.dk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo get_theme_file_uri() ?>./assets/js/infoVisibility.js ?>"></script>
<?php 
get_footer();
?>