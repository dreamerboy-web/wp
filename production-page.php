<?php
/*
Template Name: Продукция
Template Post Type: post, page, product
*/
?>

<?php get_header(); ?>

<section class="info">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
            </div>
            <div class='col-12 text-center'>
                <h3 class="statiks__title">
                    Продукция МИЛИН ДОМ
                </h3>
            </div>


            <div class="col-12">
                <?php
                $args = array(
                    'taxonomy' => 'product_cat',
                    'number' => 0,
                    'exclude' => '',
                    'hide_empty' => false,
                );

                $product_categories = get_terms($args);

                $count = count($product_categories);

                if ($count > 0) {
                    foreach ($product_categories as $product_category) {
                        $item = '<div class="catalog__category category-block production__cat">';

                        $item .= '<h4 class="for_page_production">
                                                              ' . $product_category->name . '
                                                          </h4>';
                        $item .= '<div class="production__categorias">';
                        $loop = new WP_Query(array(
                            'post_type' => 'product',
                            'posts_per_page' => 0,
                            'orderby' => 'menu_order',
                            'product_cat' => '' . $product_category->slug . '',
                        ));

                        while ($loop->have_posts()): $loop->the_post(); ?>

                            <div class="product">
                                <div class="">
                                    <?php the_post_thumbnail("thumbnail-215x300"); ?>
                                </div>
                                <div class="">
                                    <h4>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h4>
                                    <?php the_content(); ?>
                                    <p class="price">
                                        <?php _e("Price:", "examp"); ?>
                                        <?php woocommerce_template_loop_price(); ?>
                                    </p>
                                    <?php woocommerce_template_loop_add_to_cart(); ?>
                                </div>
                            </div>


                        <?php endwhile;
                        wp_reset_postdata(); ?>
                        <?php
                        $item .= '</div>';
                        $item .= '</div>';
                        echo $item;

                    }
                }
                ?>


            </div>


        </div>
    </div>
</section>
<?php get_footer(); ?>
