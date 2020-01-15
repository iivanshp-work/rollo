<?php
	/**
		* The header for our theme
		*
		* This is the template that displays all of the <head> section and everything up until <div id="content">
		*
		* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
		*
		* @package rollo
	*/
	
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		
		<?php wp_head(); 
			$main_page_id = pll_get_post(2, pll_current_language('slug'));
		?>
	</head>
	
	<body <?php body_class(); ?>>
		
		<header class="header">
			<!-- <header class="header login"> -->
			<div class="container">
				<div class="row">
					<div class="col-xl-2 col-lg-2 col-md-4 col-3 align-self-center">
						<div class="header__logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<? echo get_template_directory_uri() . '/assets/' ?>image/logo.svg" alt="logo"></a>
						</div>
					</div>
					<div class="col-xl-6 col-lg-5 align-self-center">
						<nav class="header__menu">
							<ul class="nostyle-list">
								<li class="showphone log">
									<span><img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/user.svg" alt="icon">
									Особистий кабінет</span>
									<ul class="submenu">
										<li><a href="#">Особисті дані</a></li>
										<li><a href="#">Мої замовлення</a></li>
										<li><a href="#">Корзина</a></li>
										<li><a href="#">Мої відгуки</a></li>
										<li><a href="#">Вихід</a></li>
									</ul>
								</li>
								<li class="showphone reg">
									<a href="#">Вхід</a>
								</li>
								<li class="showphone reg">
									<a href="#">Реєстрація</a>
								</li>
								<li>
									<span>Каталог</span>
									<div class="submenu megamenu">
										<div class="container">
											<div class="row">
												<div class="col-lg-3 col-md-4 col-sm-4">
													<p class="title"><a href="#">Ролети тканинні</a>
													</p>
													<ul>
														<li><a href="#" data-imghov="image/menucat-pic/categorypic.png"
                                                            data-texthov="Модель 1, Червоний">Льон</a>
														</li>
														<li><a href="#" data-imghov="image/menucat-pic/product3.png"
                                                            data-texthov="Модель 2, Синій">Акатн</a>
														</li>
														<li><a href="#" data-imghov="image/menucat-pic/product5.png"
														data-texthov="Модель 3, Чорний">Арабеска</a></li>
														<li><a href="#">Меланж</a></li>
														<li><a href="#">Люмініс</a></li>
														<li><a href="#">Каміла</a></li>
														<li><a href="#">Міракл</a></li>
														<li><a href="#">Маракеш</a></li>
														<li><a href="#">Лазур</a></li>
														<li><a href="#">Дмухавки</a></li>
														<li><a href="#">Геометрія</a></li>
														<li><a href="#">Ромашки</a></li>
														<li><a href="#">Соломка</a></li>
													</ul>
												</div>
												<div class="col-lg-3 col-md-4 col-sm-4">
													<p class="title"><a href="#">Ролети День-Ніч</a>
													</p>
													<ul>
														<li><a href="#">Secret</a></li>
														<li><a href="#">Imagine</a></li>
														<li><a href="#">Line</a></li>
														<li><a href="#">Magic</a></li>
														<li><a href="#">Льон</a></li>
														<li><a href="#">Квіти</a></li>
													</ul>
													<p class="title"><a href="#">Ролети Блекаут</a>
													</p>
													<ul>
														<li><a href="#">100% затемнення </a></li>
														<li><a href="#">Термо</a></li>
													</ul>
													<p class="title"><a href="#">Аксесуари</a></p>
												</div>
												<div class="col-lg-3 col-md-4 col-sm-4">
													<p class="title"><a href="#">Жалюзі Плісе</a>
													</p>
													<ul>
														<li><a href="#">Того</a></li>
													</ul>
													<p class="title"><a href="#">Вертикальні жалюзі</a>
													</p>
													<ul>
														<li><a href="#">Престиж</a></li>
														<li><a href="#">Класік</a></li>
													</ul>
													<p class="title"><a href="#">Коробові системи</a>
													</p>
													<ul>
														<li><a href="#">Арабеска</a></li>
														<li><a href="#">Блекаут</a></li>
														<li><a href="#">Льон</a></li>
														<li><a href="#">Акант</a></li>
														<li><a href="#">Дмухавки</a></li>
													</ul>
												</div>
												<div class="col-lg-3 col-md-12">
													<div class="header__categorypic">
														<figure>
															<div>
																<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/categorypic.png" alt="category">
															</div>
															<p class="category-name">Назва моделі орбаного товару, колір
															</p>
														</figure>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>
								<li>
									<span><?php pll_e("Інформація"); ?></span>
									<ul class="submenu">
										<? while (have_rows('menyu_informacziya', $main_page_id)) : the_row();
										$link = get_sub_field('item'); ?>
										<li><a href="<? echo $link['url'] ?>">
										<? echo $link['title'] ?> </a></li>
										<? endwhile;    ?>
									</ul>
								</li>
								<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>blog">Блог</a></li>
								<li>
									<span><?php pll_e("Про нас"); ?></span>
									<ul class="submenu sub_about">
										<? while (have_rows('menyu_about', $main_page_id)) : the_row();
										$link = get_sub_field('item'); ?>
										<li><a href="<? echo $link['url'] ?>">
										<? echo $link['title'] ?> </a></li>
										<? endwhile; ?>
									</ul>
								</li>
								
							</ul>
						</nav>
					</div>
					<div class="col-xl-1 col-lg-1 col-md-2 col-sm-2 col-4">
						<div class="header__lang">
							<ul>
								<?php pll_the_languages(); ?>
							</ul>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-md-6 col-sm-7 col-5 align-self-center text-right">
						<div class="header__search">
							<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/search.svg" alt="search">
							<form action="" id="header__searchform">
								<div class="header__searchform-row">
									<input type="text">
									<input type="submit" value="">
								</div>
							</form>
						</div>
						<div class="header__basket">
							<?php global $woocommerce; ?>
							<a href="<?php echo $woocommerce->cart->get_checkout_url() ?>">
								<div class="basket__box">
									<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/shopping-basket.svg" alt="basket">
									<span class="basket__icon basket-btn__counter"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></span>
								</div>
							</a>
						</div>
						
						
						
						<div class="header__login">
							<ul class="nostyle-list">
								<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>my-account/">Вхід</a></li>
								<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>my-account/">Реєстрація</a></li>
							</ul>
							<ul class="nostyle-list loginuser-listmenu">
								<li>
									<span><img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/user.svg" alt="icon">
									Особистий кабінет</span>
									<ul class="submenu">
										<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
										<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
											<a
												href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
										</li>

										<?  if ( $endpoint == 'orders') {?>
										<li class="<?php echo wc_get_account_menu_item_classes( 'my-cart' ); ?>">
											<?php global $woocommerce; ?>
											<a href="<?php echo $woocommerce->cart->get_cart_url() ?>"><?php echo 'Корзина' ?>
												(<?php echo sprintf($woocommerce->cart->cart_contents_count); ?>)</a>
										</li>
										<?}?>
										<?php endforeach; ?>
									</ul>
								</li>
							</ul>
						</div>
						<div class="burger"></div>
					</div>
				</div>
			</div>
		</header>		