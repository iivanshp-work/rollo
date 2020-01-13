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
								if ( $product->get_image_id() ) {
									$image = wp_get_attachment_image($product->get_image_id(), 'woocommerce_thumbnail');
								}
								if ($image):
							?>
								<div class="prmainpic">
									<?php echo $image; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-lg-6 offset-lg-1">
                        <form id="product_form" class="post-<?php echo $product->get_id(); ?>">
                            <input type="hidden" name="product_id" value="<?php echo $product->get_id(); ?>">
                            <div class="product-topsect__descr">
                                <p class="page-linetitle"><?php echo $product->get_name(); ?></p>
                                <div class="colors-slidersect">
                                    <?php
                                        $availableColorsIDS = isset($productAttributes['pa_kolory-modeli']) ? $productAttributes['pa_kolory-modeli']->get_options() : null;
                                        $availableColors = [];
                                        if ($availableColorsIDS) {
                                            foreach($availableColorsIDS as $availableColorsID) {
                                                $term_obj = get_term( $availableColorsID, 'pa_kolory-modeli');
                                                if ($term_obj) {
                                                    $availableColors[$availableColorsID] = $term_obj;
                                                    $availableColors[$availableColorsID]->color = get_field('hex_color', $term_obj);
                                                }
                                            }
                                        }
                                    ?>
                                    <?php if(!empty($availableColors)): ?>
                                        <p class="title">Кольори моделі</p>
                                        <input class="recalculate_price" data-product_attribute="pa_kolory-modeli" type="hidden" name="product_attribute[pa_kolory-modeli]" value="">

                                        <div class="colors-slider">
                                            <?php foreach($availableColors as $availableColor): ?>
                                                <div>
                                                    <div class="colorbox" data-pa-type="pa_kolory-modeli" data-id="<?php echo $availableColor->slug; ?>" title="<?php echo $availableColor->name; ?>">
                                                        <span style="background-color: <?php echo $availableColor->color ? $availableColor->color : '#fff'; ?>;"></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <p class="descr">
                                        <?php echo $product->get_short_description(); ?>
                                    </p>
                                    <div class="bottbox">
                                        <span class="price" id="price"><?php echo $product->get_price_html(); ?></span>
                                        <?php if ($product->is_in_stock()): ?>
                                            <div class="kst">
                                                <span>Кількість</span>
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
                                            <div class="kst">
                                                <span class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></span>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-7 col-md-6 col-sm-6">
                                    <input class="recalculate_price" data-product_attribute="width" type="hidden" name="product_attribute[width]" value="">
                                    <input class="recalculate_price" data-product_attribute="height" type="hidden" name="product_attribute[height]" value="">

                                    <div class="settblock new-size">
                                        <p class="title">Обраний розмір</p>
                                        <div class="sizelist__boxnew">
                                            <div class="sizelist__row active">
                                                <span class="newswidth"><text>420</text> мм</span><img
                                                    src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/x.svg" alt="x"><span
                                                    class="newsheight"><text>1650</text>
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
                                            <p class="title">Стандартні розміри</p>
                                            <div class="sizelist">
                                                <div class="sizelist__title">
                                                    <span>Ширина</span><span>Висота</span>
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
                                    if ($availableManSidesIDS) {
                                        foreach($availableManSidesIDS as $availableManSidesID) {
                                            $term_obj = get_term( $availableManSidesID, 'pa_storona-upravlinnya');
                                            if ($term_obj) {
                                                $availableManSides[$availableManSidesID] = $term_obj;
                                            }
                                        }
                                    }
                                    $availableSysColorsIDS = isset($productAttributes['pa_kolory-systemy']) ? $productAttributes['pa_kolory-systemy']->get_options() : null;
                                    $availableSysColors = [];
                                    if ($availableSysColorsIDS) {
                                        foreach($availableSysColorsIDS as $availableSysColorsID) {
                                            $term_obj = get_term( $availableSysColorsID, 'pa_kolory-systemy');
                                            if ($term_obj) {
                                                $availableSysColors[$availableSysColorsID] = $term_obj;
                                                $availableSysColors[$availableSysColorsID]->color = get_field('hex_color', $term_obj);
                                            }
                                        }
                                    }
                                    ?>
                                    <?php if(!empty($availableManSides)): ?>
                                        <div class="settblock">
                                            <p class="title">Сторона управління</p>
                                            <div class="left-right">
                                                <input class="" data-product_attribute="pa_storona-upravlinnya" type="hidden" name="product_attribute[pa_storona-upravlinnya]" value="">
                                                <?php foreach($availableManSides as $availableManSide): ?>
                                                    <span data-pa-type="pa_storona-upravlinnya" data-id="<?php echo $availableManSide->slug; ?>" title="<?php echo $availableManSide->name; ?>" <?php if(!isset($manSideActive)): $manSideActive= 1?>class="active"<?php endif;?>><?php echo $availableManSide->name; ?></span>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($availableSysColors)): ?>
                                        <div class="settblock">
                                            <p class="title">Кольори системи</p>
                                            <div class="systems-color">
                                                <input class="recalculate_price" data-product_attribute="pa_kolory-systemy" type="hidden" name="product_attribute[pa_kolory-systemy]" value="">
                                                <?php foreach($availableSysColors as $availableSysColor): ?>
                                                    <div data-pa-type="pa_kolory-systemy" data-id="<?php echo $availableSysColor->slug; ?>" title="<?php echo $availableSysColor->name; ?>" <?php if(!isset($sysColorActive)): $sysColorActive= 1?>class="active"<?php endif;?>>
                                                        <span style="background-color: <?php echo $availableSysColor->color ? $availableSysColor->color : '#fff'; ?>;"></span>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">

                                    <span class="prwhitebtn">
                                        <span>
                                          <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/shape-size-interface-symbol.svg" alt="icon">
                                          Інший розмір вікон
                                        </span>
                                    </span>

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <?php if ($product->is_in_stock()): ?>
                                        <a href="#" class="prblackbtn" data-add-to-cart="" >
                                            <span>Додати до корзини<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/shopping-basketpr.svg" alt="icon"></span>
                                        </a>
                                    <?php else: ?>
                                        <a href="javascript:void(0);" class="prblackbtn">
                                            <span>Немає в наявності<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/shopping-basketpr.svg" alt="icon"></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </form>
					</div>
				</div>
			</div>
		</section>

		<section class=" product__slider product-block">
			<div class="container">
				<h3>Можливо вас зацікавлять</h3>
				<div class="prodslider row">
					<div>
						<div class="catalog-productbox">
							<a href="#">
								<div class="catalog-productbox__pic">
									<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/products/category-product1.png" alt="product image">
								</div>
							</a>
							<div class="catalog-productbox__text">
								<a href="#" class="title">Ролети Тканинні Льон Білий</a>
								<p class="price">280 грн</p>
							</div>
						</div>
					</div>
					<div>
						<div class="catalog-productbox">
							<a href="#">
								<div class="catalog-productbox__pic">
									<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/products/category-product2.png" alt="product image">
								</div>
							</a>
							<div class="catalog-productbox__text">
								<a href="#" class="title">Ролети Тканинні Льон Білий</a>
								<p class="price">280 грн</p>
							</div>
						</div>
					</div>
					<div>
						<div class="catalog-productbox">
							<a href="#">
								<div class="catalog-productbox__pic">
									<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/products/category-product3.png" alt="product image">
								</div>
							</a>
							<div class="catalog-productbox__text">
								<a href="#" class="title">Ролети Тканинні Льон Білий</a>
								<p class="price">280 грн</p>
							</div>
						</div>
					</div>
					<div>
						<div class="catalog-productbox">
							<a href="#">
								<div class="catalog-productbox__pic">
									<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/products/category-product4.png" alt="product image">
								</div>
							</a>
							<div class="catalog-productbox__text">
								<a href="#" class="title">Ролети Тканинні Льон Білий</a>
								<p class="price">280 грн</p>
							</div>
						</div>
					</div>
					<div>
						<div class="catalog-productbox">
							<a href="#">
								<div class="catalog-productbox__pic">
									<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/products/category-product5.png" alt="product image">
								</div>
							</a>
							<div class="catalog-productbox__text">
								<a href="#" class="title">Ролети Тканинні Льон Білий</a>
								<p class="price">280 грн</p>
							</div>
						</div>
					</div>
					<div>
						<div class="catalog-productbox">
							<a href="#">
								<div class="catalog-productbox__pic">
									<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/products/category-product2.png" alt="product image">
								</div>
							</a>
							<div class="catalog-productbox__text">
								<a href="#" class="title">Ролети Тканинні Льон Білий</a>
								<p class="price">280 грн</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="product-block product-text">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<h3>Опис</h3>
						<p>
							Тканинні ролети - надзвичайно просте, але дуже ефективне і популярне рішення для оформлення
							вікон.
							Вони поєднують в собі комфорт cучасних жалюзі і затишок традиційних штор. Ролети захищають
							від
							зайвого сонячного світла, не дають приміщенню нагріватися, а також створюють
							затишок в темний час доби.
						</p>
						<p>Термін відправлення товару до 4 робочих днів.</p>
						<p>Рекомендуємо купити комплект нижньої фіксації для відкривної створки, який запобігає
							провисанню
							тканини при провітрюванні.</p>
						<p>Зверніть увагу що розміри вказані "по тканині", конструкція на 4см ширша (по 2см на сторону).
						</p>
						<a href="#" class="black-btn">Як правино поміряти вікно? </a>
					</div>
					<div class="col-lg-5 offset-lg-1  col-md-6">
						<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/tkaninni_na_sait 1.png" alt="image">
					</div>
				</div>
			</div>
		</section>

		<section class="product-block reviews">
			<div class="container">
				<div class="row">
					<div class="col-lg-5">
						<h3>Відгуки</h3>
						<div class="review">
							<p class="review__title">Настя <span>21.10.2019</span></p>
							<p class="review__descr">
								Купляла для кухні. Я зодоволена своїм вибором. Якісні ролетти, гарно виглядають і не
								дорогі.
							</p>
						</div>
						<div class="review">
							<p class="review__title">Олег <span>16.09.2019</span></p>
							<p class="review__descr">
								Сподобались не тільки ролети, а й персонал. Привітні та ввчіливі працівники, які не
								тільки відповідять на всі питання, але і підскажуть як обрати “правильні ролети”.
								Рекомендую.
							</p>
						</div>
						<div class="review">
							<p class="review__title">Таня <span>03.09.2019</span></p>
							<p class="review__descr">
								Ролетами задоволена. Довго вагалася з кольором, але рада що обрала саме ці, кімната з
								ними виглядає світлою та просторнішою.
							</p>
						</div>
						<div class="more-reviewssect">
							<div class="review">
								<p class="review__title">Таня <span>03.09.2019</span></p>
								<p class="review__descr">
									Ролетами задоволена. Довго вагалася з кольором, але рада що обрала саме ці, кімната
									з
									ними виглядає світлою та просторнішою.
								</p>
							</div>
							<div class="review">
								<p class="review__title">Таня <span>03.09.2019</span></p>
								<p class="review__descr">
									Ролетами задоволена. Довго вагалася з кольором, але рада що обрала саме ці, кімната
									з
									ними виглядає світлою та просторнішою.
								</p>
							</div>
							<div class="review">
								<p class="review__title">Таня <span>03.09.2019</span></p>
								<p class="review__descr">
									Ролетами задоволена. Довго вагалася з кольором, але рада що обрала саме ці, кімната
									з
									ними виглядає світлою та просторнішою.
								</p>
							</div>
						</div>
						<span class="review-more">Всі</span>
					</div>
					<div class="col-lg-5 offset-lg-2">
						<form action="" class="review-form form-section">
							<p class="title">Залишити відгук</p>
							<label for="name">Ім’я</label>
							<input type="text" id="name">
							<label for="email">Email</label>
							<input type="text" id="email" class="email-input">
							<label for="text">Відгук</label>
							<textarea id="text"></textarea>
							<input type="submit" value="Надіслати" class="black-btn">
						</form>
					</div>
				</div>
			</div>
		</section>

	</main>

    <div class="modal-section">
        <div class="align-block">
            <div class="modal-sizeset">
                <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/cancel.svg" alt="cancel" class="modal-cancel">
                <select name="" id="">
                    <option value="0">Ролети Тканинні Льон Білий</option>
                    <option value="1">Ролети Тканинні Льон Синій</option>
                    <option value="2">Ролети Тканинні Льон Зелений</option>
                    <option value="3">Ролети Тканинні Льон Жовтий</option>
                    <option value="4">Ролети Тканинні Льон Червоний</option>
                </select>

                <div class="rangeslider-sect">
                    <div>
                        <div class="rangebox">
                            <p class="range__title">Ширина</p>
                            <input type="range" min="0" max="5000" value="1640" step="1" data-rangeslider>
                            <output class="widthrange"></output>
                        </div>
                        <div class="rangebox">
                            <p class="range__title">Висота</p>
                            <input type="range" min="0" max="5000" value="2740" step="1" data-rangeslider>
                            <output class="heighthrange"></output>
                        </div>
                    </div>
                </div>

                <div class="modalrange__bottsect">
                    <div class="row">
                        <div class="col-sm-6 col-6">
                            <p class="lefttext">Вартість / шт.</p>
                        </div>
                        <div class="col-sm-6 col-6">
                            <p class="righttext">1220 грн</p>
                        </div>
                    </div>
                    <a href="#" class="black-btn modalbtn">Додати розмір</a>
                </div>
            </div>
        </div>
    </div>

<?php
/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
//do_action( 'woocommerce_before_main_content' );
?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php wc_get_template_part( 'content', 'single-product' ); ?>

<?php endwhile; // end of the loop. ?>

<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
?>

<?php
/**
 * woocommerce_sidebar hook.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );
?>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
