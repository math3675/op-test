<?php  
get_header();

?>



<?php

    $terms = get_the_terms($product->ID, 'product_cat');
    
    foreach ($terms as $term) {
        $product_cat = $term->name;
        break;
    }

 ?>



<section class="container product-content">
    <div class="row">
        <div class="col-12 col-md-6">
            <img class="product-image" src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php the_title() ?>">
        </div>
        <div class="col-12 col-md-6 d-flex align-items-center">
            <div class="w-100 p-5">
                <h1><?php the_title() ?></h1>
                <div class="prices mt-5">
                    <h2 class="mb-4">Udlejningspriser</h2>
                    <div class="single-price">
                        <p>Daglig pris</p>
                        <span class="price-number">
                            <?php if( the_field('daglig_vejl_pris_tilbud') ): ?>
                                <p class="old-price"><?php  the_field('daglig_vejl_pris') ?> kr.</p>
                                <p><?php the_field('daglig_vejl_pris_tilbud') ?> kr.</p>
                            <?php else: ?>
                                <p><?php the_field('daglig_vejl_pris'); ?> kr.</p>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="single-price">
                        <p>Ugentlig pris</p>
                        <span class="price-number">
                            <?php if( get_field('ugentlig_vejl_pris_tilbud') ): ?>
                                <p class="old-price"><?php the_field('ugentlig_vejl_pris') ?> kr.</p>
                                <p><?php the_field('ugentlig_vejl_pris_tilbud') ?> kr.</p>
                            <?php else: ?>
                                <p><?php the_field('ugentlig_vejl_pris') ?> kr.</p>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="single-price">
                        <p>Månedlig pris</p>
                        <span class="price-number">
                            <?php if( get_field('manedlig_vejl_pris_tilbud') ): ?>
                                <p class="old-price"><?php the_field('manedlig_vejl_pris') ?> kr.</p>
                                <p><?php the_field('manedlig_vejl_pris_tilbud') ?> kr.</p>
                            <?php else: ?>
                                <p><?php the_field('manedlig_vejl_pris') ?> kr.</p>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="info p-5">
                <h2 class="mb-4">Produktbeskrivelse</h2>    
                <p><?php the_content() ?></p>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="info p-5">
            <h2 class="mb-4">Forespørgsel</h2>
                <form action="" method="post">
                    <input type="email" name="email" required placeholder="Din e-mail">
                    <input type="tel" name="phone" pattern="[0-9]{8}" required placeholder="Dit telefonnummer">
                    <button type="submit">Send forespørgsel</button>
                </form>   
            </div>
        </div>
    </div>
</section>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'):?> 
<section class="container message">
    <div class="row">
        <div class="col-12">
            <div class="quote-message p-5">
                <h2 class="mb-4">Tak for din forespørgsel</h2>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <h3>Du har sendt en forespørgsel fra:</h3>
                        <p><b>E-mail:</b> <?php echo $_POST['email'] ?></p>
                        <p><b>telefonnummer:</b> <?php echo $_POST['phone'] ?></p>
                    </div>
                    <div class="col-12 col-md-3">
                        <h3>Produktinfo:</h3>
                        <p><b>Bil:</b> <?php the_title() ?></p>
                        <p><b>Kategori:</b> <?php echo $product_cat ?></p>
                        <p><b>Priser:</b> 
                        <?php if( get_field('daglig_vejl_pris_tilbud') ): ?>
                                <?php the_field('daglig_vejl_pris_tilbud') ?> kr. / 
                            <?php else: ?>
                                <?php the_field('daglig_vejl_pris') ?> kr. / 
                            <?php endif; ?>    

                            <?php if( get_field('ugentlig_vejl_pris_tilbud') ): ?>
                                <?php the_field('ugentlig_vejl_pris_tilbud') ?> kr. / 
                            <?php else: ?>
                                <?php the_field('ugentlig_vejl_pris') ?> kr. / 
                            <?php endif; ?>

                            <?php if( get_field('manedlig_vejl_pris_tilbud') ): ?>
                                <?php the_field('manedlig_vejl_pris_tilbud') ?> kr.
                            <?php else: ?>
                                <?php the_field('manedlig_vejl_pris') ?> kr.
                            <?php endif; ?>
                        </p>
                        <p><b>Dato:</b> <?php echo date('d/m/Y') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php

global $post;

$args = get_posts( 
    array(
    'product_cat' => 'udlejning', 
    'numberposts'  => 4, 
    'post__not_in' => array( $post->ID ),
    'post_type'    => 'product'
)
    );

if( $args ) { ?>
    <section class="related container">
        <div class="row">
            <h2 class="mb-4">Relaterede produkter</h2>    
        <?php 
            foreach( $args as $post ) {
            setup_postdata($post); 
            $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'full' );
            $product = wc_get_product( get_the_ID() );?>
            <div class="post-<?php echo get_the_ID();?> product type-product .col-12 col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">   
                        <a href="<?php echo get_the_permalink(get_the_ID()); ?>">
                        <img src="<?php echo $url; ?>">
                        <h3><?php echo get_the_title(); ?></h3>
                        </a>
                        <p>
                            <?php if( get_field('daglig_vejl_pris_tilbud') ): ?>
                                <?php the_field('daglig_vejl_pris_tilbud') ?> kr. / 
                            <?php else: ?>
                                <?php the_field('daglig_vejl_pris') ?> kr. / 
                            <?php endif; ?>    

                            <?php if( get_field('ugentlig_vejl_pris_tilbud') ): ?>
                                <?php the_field('ugentlig_vejl_pris_tilbud') ?> kr. / 
                            <?php else: ?>
                                <?php the_field('ugentlig_vejl_pris') ?> kr. / 
                            <?php endif; ?>

                            <?php if( get_field('manedlig_vejl_pris_tilbud') ): ?>
                                <?php the_field('manedlig_vejl_pris_tilbud') ?> kr.
                            <?php else: ?>
                                <?php the_field('manedlig_vejl_pris') ?> kr.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php
            }
        wp_reset_postdata(); ?>
    </div>
    </section>
  <?php } ?>

<?php  

get_footer();

?>

