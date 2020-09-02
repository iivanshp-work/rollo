<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$id = $post->ID;
$product = wc_get_product($id);
$productAttributes = $product->get_attributes();

$selectedVariationProduct = null;
$selectedVariationID = 0;
$selectedVariationColor = isset($_REQUEST['attribute_pa_kolory-modeli']) ? trim($_REQUEST['attribute_pa_kolory-modeli']) : '';
if ($selectedVariationColor) {
    $attributes = [];
    $attributes['attribute_pa_kolory-modeli'] = $selectedVariationColor;
    $selectedVariationID = custom_find_matching_product_variation(new \WC_Product($product->get_id()), $attributes);
    $selectedVariationProduct = wc_get_product($selectedVariationID);
}

get_header( '' ); ?>

  <main>
    <div class="breadcrums">
      <div class="container">
          <? 	get_template_part( 'template-parts/bread'); ?>
      </div>
    </div>
    <section class="product-topsect">
      <div class="product-topsect__greybox"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <div class="product-topsect__pic">
              <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/prtrig.svg" alt="">
                <?php
                $image = '';
                if ( $selectedVariationProduct && $selectedVariationProduct->get_image_id() ) {
                    $image = wp_get_attachment_image_url($selectedVariationProduct->get_image_id(), 'large');
                } else if ( $product->get_image_id() ) {
                    //$image = wp_get_attachment_image($product->get_image_id(), 'medium_large');
                    $image = wp_get_attachment_image_url($product->get_image_id(), 'large');
                }
                if ($image):
                    ?>
                  <div class="prmainpic">
                      <?php //echo $image; ?>
                      <img src="<? echo $image; ?>" class="" alt="">
                  </div>
                <?php endif; ?>
                <div class="var_images" style="display: none;">
                </div>
            </div>
          </div>
          <div class="col-lg-6 offset-lg-1">
            <form id="product_form" class="post-<?php echo $product->get_id(); ?>">
              <input type="hidden" name="product_id" value="<?php echo $product->get_id(); ?>">
              <div class="product-topsect__descr">
                <p class="page-linetitle">
                    <?php
                    $name = $product->get_name();
                    if ($selectedVariationProduct && $selectedVariationProduct->get_name()) {
                        $name = $selectedVariationProduct->get_name();
                    }
                    echo $name;
                    ?>
                </p>
                <div class="colors-slidersect">
                    <?php
                    $availableColorsIDS = isset($productAttributes['pa_kolory-modeli']) ? $productAttributes['pa_kolory-modeli']->get_options() : null;
                    $availableVariations = $product->get_available_variations();
                    if (!empty($availableVariations)) {
                        $availableColorsIDSNew = [];
                        foreach($availableVariations as $availableVariation) {
                            if (isset($availableVariation['attributes']['attribute_pa_kolory-modeli'])) {
                                $value = $availableVariation['attributes']['attribute_pa_kolory-modeli'];
                                $term_obj = get_term_by('slug', $value, "pa_kolory-modeli");
                                if ($term_obj && $term_obj->term_id) {
                                    $availableColorsIDSNew[] = $term_obj->term_id;
                                }
                            }
                        }
                        $availableColorsIDS = !empty($availableColorsIDSNew) ? $availableColorsIDSNew : null;
                    }

                    //test($product->get_available_variations());

                    $availableColors = [];
                    if ($availableColorsIDS) {
                        foreach($availableColorsIDS as $availableColorsID) {
                            $term_obj = get_term( $availableColorsID, 'pa_kolory-modeli');
                            if ($term_obj) {
                                $availableColors[$availableColorsID] = $term_obj;
                                $attributes = [];
                                $attributes['attribute_pa_kolory-modeli'] = $term_obj->slug;
                                $var = custom_find_matching_product_variation(new \WC_Product($product->get_id()), $attributes);
                                $mini_image = 0;
                                if ($var) {
                                    $variant = wc_get_product($var);
                                    $mini_image = get_post_meta( $variant->get_id(), '_mini_image', true );
                                }
                                $availableColors[$availableColorsID]->color = get_field('hex_color', $term_obj);
                                $availableColors[$availableColorsID]->mini_image = $mini_image ? wp_get_attachment_image_url($mini_image) : 0;
                            }
                        }
                    }
                    ?>
                    <?php if(!empty($availableColors)): ?>
                      <p class="title"><?php echo pll__('Кольори моделі'); ?> </p>
                      <input class="recalculate_price" data-product_attribute="pa_kolory-modeli" type="hidden" name="product_attribute[pa_kolory-modeli]" value="">

                      <div class="colors-slider">
                          <?php foreach($availableColors as $availableColor): ?>
                            <div>
                              <div class="colorbox <?php if($selectedVariationColor && $selectedVariationColor == $availableColor->slug): ?> selected_variation <?php endif; ?>" data-pa-type="pa_kolory-modeli" data-id="<?php echo $availableColor->slug; ?>" title="<?php echo $availableColor->name; ?>">
                                  <?php if ($availableColor->mini_image): ?>
                                      <span style="background-size: contain;background-image: url('<?php echo $availableColor->mini_image; ?>');background-color: <?php echo $availableColor->color ? $availableColor->color : '#fff'; ?>;"></span>
                                  <?php else: ?>
                                      <span style="background-color: <?php echo $availableColor->color ? $availableColor->color : '#fff'; ?>;"></span>
                                  <?php endif; ?>
                              </div>
                            </div>
                          <?php endforeach; ?>
                      </div>
                    <?php endif; ?>
                  <p class="descr">
                      <?php echo $product->get_short_description(); ?>
                  </p>
                  <div>
                      <?php echo '<div style="display: none;" class="hidden">' . do_shortcode(' [viewBuyButton]') . '</div>'; ?>
                      <div class="row">
                          <div class="col-xl-6 col-lg-7 col-md-6 col-sm-6">
                              <button type="button" class="prwhitebtn single_add_to_cart_button clickBuyButton button21 button alt ld-ext-left" data-visible-one-click-buy="" data-variation_id="<?php echo $selectedVariationID; ?>" data-productid="<?php echo $product->get_id(); ?>">
                                  <span> <?php echo pll__('Замовити в 1 клік');?></span>
                                  <div style="font-size:14px" class="ld ld-ring ld-cycle"></div>
                              </button>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-6 col-lg-7 col-md-6 col-sm-6">
                  <input data-product_attribute="width" type="hidden" name="product_attribute[width]" value="">
                  <input class="recalculate_price" data-product_attribute="height" type="hidden" name="product_attribute[height]" value="">

                  <div class="settblock new-size">
                    <p class="title"><?php echo pll__('Обраний розмір');?></p>
                    <div class="sizelist__boxnew">
                      <div class="sizelist__row active">
                        <span class="newswidth"><text>00</text> мм</span><img
                                src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/x.svg" alt="x"><span
                                class="newsheight"><text>00</text>
                                                    мм</span>
                        <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/cancel.svg" alt="delete" class="delete-size">
                      </div>

                    </div>
                  </div>
                    <?php
                    $standardSizes = get_field('standard_sizes', $product->get_id());
                    ?>
                    <?php if (!empty($standardSizes)): ?>
                      <div class="settblock">
                        <p class="title"><?php echo pll__('Стандартні розміри');?></p>
                        <div class="sizelist">
                          <div class="sizelist__title">
                            <span><?php echo pll__('Ширина');?></span><span><?php echo pll__('Висота');?></span>
                          </div>
                          <div class="sizelist__box">
                              <?php foreach ($standardSizes as $standardSize): ?>
                                  <?php if (isset($standardSize['width']) && isset($standardSize['height']) && $standardSize['width'] && $standardSize['height']): ?>
                                  <div class="sizelist__row" data-product-standard-sizes="" data-width="<?php echo $standardSize['width']; ?>" data-height="<?php echo $standardSize['height']; ?>">
                                    <span><?php echo $standardSize['width']; ?> мм</span>
                                    <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/x.svg" alt="x">
                                    <span><?php echo $standardSize['height']; ?> мм</span>
                                  </div>
                                  <?php endif; ?>
                              <?php endforeach; ?>
                          </div>
                        </div>
                      </div>
                    <?php endif; ?>
                </div>
                <div class="col-xl-6 col-lg-5 col-md-6 col-sm-6">
                    <?php
                    $availableManSidesIDS = isset($productAttributes['pa_storona-upravlinnya']) ? $productAttributes['pa_storona-upravlinnya']->get_options() : null;
                    $availableManSides = [];
                    $primaryMainSideId = 214;// right side
                    $primaryMainSide = null;
                    if ($availableManSidesIDS) {
                        foreach($availableManSidesIDS as $availableManSidesID) {
                            $term_obj = get_term( $availableManSidesID, 'pa_storona-upravlinnya');
                            if ($term_obj) {
                                if ($term_obj && $term_obj->term_id == $primaryMainSideId) {
                                    $primaryMainSide = $term_obj->slug;
                                }
                                $availableManSides[$availableManSidesID] = $term_obj;
                            }
                        }
                    }
                    if (!$primaryMainSide && !empty($availableManSides)) {
                        $availableManSide = reset($availableManSides);
                        $primaryMainSide = $availableManSide->slug;
                    }
                    $availableSysColorsIDS = isset($productAttributes['pa_kolory-systemy']) ? $productAttributes['pa_kolory-systemy']->get_options() : null;
                    $availableSysColors = [];

                    if ($availableSysColorsIDS) {
                        $sortOrderSysColors = [211, 212, 246, 247];
                        $baseAvailableSysColorsIDS = $availableSysColorsIDS;
                        $availableSysColorsIDS = array_intersect($sortOrderSysColors, $availableSysColorsIDS);
                        if (empty($availableSysColorsIDS)) {
                            $availableSysColorsIDS = $baseAvailableSysColorsIDS;
                        }
                    }
                    $primaryMainSysColorId = 211;// white color
                    $primaryMainSysColor = null;
                    if ($availableSysColorsIDS) {
                        foreach($availableSysColorsIDS as $availableSysColorsID) {
                            $term_obj = get_term( $availableSysColorsID, 'pa_kolory-systemy');
                            if ($term_obj) {
                                if ($term_obj && $term_obj->term_id == $primaryMainSysColorId) {
                                    $primaryMainSysColor = $term_obj->slug;
                                }
                                $availableSysColors[$availableSysColorsID] = $term_obj;
                                $availableSysColors[$availableSysColorsID]->color = get_field('hex_color', $term_obj);
                            }
                        }
                    }
                    if (!$primaryMainSysColor && !empty($availableSysColors)) {
                        $availableSysColor = reset($availableSysColors);
                        $primaryMainSysColor = $availableSysColor->slug;
                    }
                    ?>
                    <?php if(!empty($availableManSides)): ?>
                      <div class="settblock">
                        <p class="title"><?php echo pll__('Сторона управління');?></p>
                        <div class="left-right">
                          <input class="" data-product_attribute="pa_storona-upravlinnya" type="hidden" name="product_attribute[pa_storona-upravlinnya]" value="<?php echo $primaryMainSide; ?>">
                            <?php foreach($availableManSides as $availableManSide): ?>
                              <span data-pa-type="pa_storona-upravlinnya" data-id="<?php echo $availableManSide->slug; ?>" title="<?php echo pll__($availableManSide->name); ?>" <?php if($availableManSide->slug == $primaryMainSide):?>class="active"<?php endif;?>><?php echo pll__($availableManSide->name); ?></span>
                            <?php endforeach; ?>
                        </div>
                      </div>
                    <?php endif; ?>
                    <?php if(!empty($availableSysColors)): ?>
                      <div class="settblock">
                        <p class="title"><?php echo pll__('Кольори системи');?></p>
                        <div class="systems-color">
                          <input class="recalculate_price" data-product_attribute="pa_kolory-systemy" type="hidden" name="product_attribute[pa_kolory-systemy]" value="<?php echo $primaryMainSysColor; ?>">
                            <?php foreach($availableSysColors as $availableSysColor): ?>
                              <div data-pa-type="pa_kolory-systemy" data-id="<?php echo $availableSysColor->slug; ?>" title="<?php echo pll__($availableSysColor->name); ?>" <?php if($availableSysColor->slug == $primaryMainSysColor): ?>class="active"<?php endif;?>>
                                <span style="background-color: <?php echo $availableSysColor->color ? $availableSysColor->color : '#fff'; ?>;"></span>
                              </div>
                            <?php endforeach; ?>
                        </div>
                      </div>
                    <?php endif; ?>
                    <div class="colors-slidersect">
                        <div class="bottbox">
                            <?php if ($product->is_in_stock()): ?>
                                <div class="kst">
                                    <span><?php echo pll__('Кількість');?></span>
                                    <div class="incard__num">
                                        <div class="input-group">
                                            <input type="button" value="" class="button-minus"
                                                   data-field="quantity">
                                            <input type="text" step="1" max="<?php echo $product->get_stock_quantity() ? $product->get_stock_quantity() : 100; ?>" value="1" name="quantity"
                                                   class="quantity-field">
                                            <input type="button" value="" class="button-plus" data-field="quantity">
                                        </div>
                                    </div>
                                </div>
                            <?php else:?>
                                <div class="kst" s>
                                    <span class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></span>
                                </div>
                            <?php endif;?>
                        </div>
                        <span class="price" id="price"><?php echo wc_price(calculate_product_price($product->get_id())); ?></span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <?php
                    $notStandardSizes = get_field('not_standard_sizes', $product->get_id());
                    ?>
                    <?php if (!empty($standardSizes) && !empty($notStandardSizes)): ?>
                      <span class="prwhitebtn prwhitebtn-open-popup">
                          <span>
                              <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/shape-size-interface-symbol.svg" alt="icon">
                              <?php echo pll__('Інший розмір вікон');?>
                          </span>
                      </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <?php if ($product->is_in_stock()): ?>
                      <a href="#" class="prblackbtn" data-add-to-cart="" >
                        <span><?php echo pll__('Додати до корзини');?><img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/shopping-basketpr.svg" alt="icon"></span>
                      </a>
                    <?php else: ?>
                      <a href="javascript:void(0);" class="prblackbtn">
                        <span><?php echo pll__('Немає в наявності');?><img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/shopping-basketpr.svg" alt="icon"></span>
                      </a>
                    <?php endif; ?>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </section>
      <?php
      $relatedProducts = wc_get_related_products($product->get_id(), 10);
      $relatedProducts = wc_get_products(['include' => $relatedProducts, 'posts_per_page' => 10]);
      ?>
      <?php if (!empty($relatedProducts)): ?>
        <section class=" product__slider product-block">
          <div class="container">
            <h3><?php echo pll__('Можливо вас зацікавлять');?></h3>
            <div class="prodslider row" data-count-products="<?php echo count($relatedProducts); ?>">
                <?php foreach($relatedProducts as $relatedProduct): ?>
                  <?php
                    $product_slug = $relatedProduct->get_slug();
                    $product_slug = esc_url((pll_current_language() == 'uk' ? '' : '/ru') .  '/product/' . $product_slug . '/');
                  ?>
                  <div>
                    <div class="catalog-productbox">
                      <a href="<?php echo $product_slug; ?>">
                        <div class="catalog-productbox__pic">
                            <?php
                            $image = '';
                            if ( $relatedProduct->get_image_id() ) {
                                $image = wp_get_attachment_image($relatedProduct->get_image_id(), 'woocommerce_thumbnail');
                            }
                            if ($image):
                                echo $image;
                            endif;
                            ?>
                        </div>
                      </a>
                      <div class="catalog-productbox__text">
                        <a href="<?php echo $product_slug; ?>" class="title"><?php echo $relatedProduct->get_name(); ?></a>
                        <p class="price"><?php echo wc_price(calculate_product_price($relatedProduct->get_id())); ?></p>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
            </div>
          </div>
        </section>
      <?php endif; ?>
      <?php
      $descImage = get_field('description_image', $product->get_id());
      $desc = $product->get_description();
      ?>
    <section class="product-block product-text">
      <div class="container">
        <div class="row">
            <?php if($desc && $descImage): ?>
              <div class="col-lg-6 col-md-6">
                <h3><?php echo pll__('Опис');?></h3>
                <p><?php echo wpautop($desc); ?></p>
              </div>
              <div class="col-lg-5 offset-lg-1  col-md-6">
                <img src="<? echo $descImage; ?>" alt="image">
              </div>
            <?php elseif($desc): ?>
              <div class="col-lg-12 col-md-12">
                <h3><?php echo pll__('Опис');?></h3>
                <p><?php echo wpautop($desc); ?></p>
              </div>
            <?php elseif($descImage): ?>
              <div class="col-lg-5 col-md-6">
                <img src="<? echo $descImage; ?>" alt="image">
              </div>
              <div class="col-lg-7 col-md-6"></div>
            <?php endif; ?>
        </div>
      </div>
    </section>

      <?php if ($product->get_reviews_allowed()): ?>
        <section class="product-block reviews">
          <div class="container">
            <div class="row">
              <div class="col-lg-5">
                <h3><?php echo pll__('Відгуки');?></h3>
                  <?php if ($product->get_review_count()): ?>
                      <?php
                      $args = array ('post_id' => $product->get_id(), 'status'=>'approve');
                      $reviews = get_comments( $args );
                      ?>
                  <?php endif; ?>
                  <?php if ($reviews): ?>
                      <?php $iter = 0;?>
                      <?php foreach ($reviews as $review):?>
                          <?php $iter++;?>
                      <div class="review">
                        <p class="review__title"><?php echo $review->comment_author;?> <span><?php echo date("m.d.Y", strtotime($review->comment_date));?></span></p>
                        <p class="review__descr">
                            <?php echo $review->comment_content;?>
                        </p>
                      </div>
                          <?php if ($iter ==4): ?>
                        <div class="more-reviewssect">
                          <?php endif; ?>
                      <?php endforeach; ?>
                      <?php if (count($reviews) > 3): ?>
                      </div>
                      <span class="review-more"><?php echo pll__('Всі');?></span>
                      <?php endif; ?>
                  <?php else: ?>
                    <p class="review__title"><?php echo pll__('Ще немає відгуків.');?></p>
                  <?php endif; ?>
              </div>
              <div class="col-lg-5 offset-lg-2">
                <form action="" id="product-review-form" class="review-form form-section">
                  <p class="title"><?php echo pll__('Залишити відгук');?></p>
                  <div class="fieldset">
                    <input type="hidden" name="product_id" value="<?php echo $product->get_id(); ?>">
                    <label for="name"><?php echo pll__('Ім’я');?></label>
                    <input type="text" id="name" name="name">
                    <label for="email"><?php echo pll__('Email');?></label>
                    <input type="text" id="email" class="email-input" name="email">
                    <label for="text"><?php echo pll__('Відгук');?></label>
                    <textarea id="text" name="comment"></textarea>
                    <input type="submit" value="<?php echo pll__('Надіслати');?>" class="black-btn">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      <?php endif; ?>
  </main>

<?php
if (!isset($notStandardSizes)) {
    $notStandardSizes = get_field('not_standard_sizes', $product->get_id());
}
?>
<?php if(!empty($availableColors)): ?>
    <div class="modal-section modal-section-available-colors">
        <div class="align-block">
            <div class="modal-sizeset">
                <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/cancel.svg" alt="cancel" class="modal-cancel">
                <p class="title"><?php echo pll__('Виберіть колір тканини'); ?></p>

                <div class="colors-slider">
                    <?php foreach($availableColors as $availableColor): ?>
                        <div>
                            <div class="colorbox <?php if($selectedVariationColor && $selectedVariationColor == $availableColor->slug): ?> selected_variation <?php endif; ?>" data-pa-type-popup="pa_kolory-modeli" data-id="<?php echo $availableColor->slug; ?>" title="<?php echo $availableColor->name; ?>">
                                <?php if ($availableColor->mini_image): ?>
                                    <span style="background-size: contain;background-image: url('<?php echo $availableColor->mini_image; ?>');background-color: <?php echo $availableColor->color ? $availableColor->color : '#fff'; ?>;"></span>
                                <?php else: ?>
                                    <span style="background-color: <?php echo $availableColor->color ? $availableColor->color : '#fff'; ?>;"></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if (!empty($standardSizes) && !empty($notStandardSizes)): ?>
  <div class="modal-section modal-section-diff-sizes">
    <div class="align-block">
      <div class="modal-sizeset">
        <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/cancel.svg" alt="cancel" class="modal-cancel">

          <?php if(!empty($availableColors)): ?>
            <select data-product-color-popup="">
                <?php foreach($availableColors as $availableColor): ?>
                  <option value="<?php echo $availableColor->slug; ?>"><?php echo $product->get_name() . ' - ' . $availableColor->name; ?></option>
                <?php endforeach; ?>
            </select>
          <?php endif; ?>

        <div class="rangeslider-sect">
          <div class="row">
            <div class="rangebox-new col-sm-6 col-6 col-md-4 offset-0 offset-sm-0 offset-md-2">
                <input class="widthrangeinput" type="text" min="<?php echo isset($notStandardSizes['width']['min_width']) ? $notStandardSizes['width']['min_width'] : 150;?>" max="<?php echo isset($notStandardSizes['width']['max_width']) ? $notStandardSizes['width']['max_width'] : 2800;?>" value="" step="5" data-range-input>
                <p class="range__title"><?php echo pll__('Ширина');?></p>
            </div>
            <div class="rangebox-new col-sm-6 col-6 col-md-4">
                <input class="heightrangeinput" type="text" min="<?php echo isset($notStandardSizes['height']['min_height']) ? $notStandardSizes['height']['min_height'] : 1000;?>" max="<?php echo isset($notStandardSizes['height']['max_height']) ? $notStandardSizes['height']['max_height'] : 2800;?>" value="" step="5" data-range-input>
                <p class="range__title"><?php echo pll__('Висота');?></p>
            </div>
          </div>
        </div>

        <div class="modalrange__bottsect">
          <div class="row">
            <div class="col-sm-6 col-6">
              <p class="lefttext"><?php echo pll__('Вартість / шт.');?></p>
            </div>
            <div class="col-sm-6 col-6">
                <p class="righttext popup-price"><?php echo wc_price(calculate_product_price($product->get_id())); ?></p>
            </div>
            <a href="#" class="black-btn modalbtn"><?php echo pll__('Додати розмір');?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
