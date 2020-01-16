<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 ?>




	<section class="loginpage">
		<ul id="scene" class="scene">
			<li class="layer" data-depth="0.25">
				<div class="trigbox1">
					<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/logtrig1.svg" />
				</div>
			</li>
			<li class="layer" data-depth="0.15">
				<div class="trigbox2">
					<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/logtrig2.svg" />
				</div>
			</li>
			<li class="layer" data-depth="-0.10">
				<div class="trigbox3">
					<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/logtrig3.svg" />
				</div>
			</li>
			<li class="layer" data-depth="0.10">
				<div class="trigbox4">
					<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/logtrig4.svg" />
				</div>
			</li>
			<li class="layer" data-depth="-0.25">
				<div class="trigbox5">
					<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/logtrig5.svg" />
				</div>
			</li>
			<li class="layer" data-depth="0.15">
				<div class="trigbox6">
					<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/logtrig6.svg" />
				</div>
			</li>
			<li class="layer" data-depth="-0.25">
				<div class="trigbox7">
					<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/logtrig7.svg" />
				</div>
			</li>
			<li class="layer" data-depth="0.25">
				<div class="trigbox8">
					<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/logtrig8.svg" />
				</div>
			</li>
			
		</ul>
		<div class="log-forms">
		<? do_action( 'woocommerce_before_customer_login_form' ); ?>
			<div class="logintab">
			
			
			
				<form class="woocommerce-form woocommerce-form-login login signforms" method="post" id="login">
					<?php do_action( 'woocommerce_login_form_start' ); ?>
					<p class="title">Вхід</p>
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</p>
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
					</p>
					
					<?php do_action( 'woocommerce_login_form' ); ?>
					
					<p class="form-row">
						<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
							<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
						</label>
						<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
						
					</p>
					<p class="woocommerce-LostPassword lost_password">
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
					</p>
					
					<div class="signforms__btnsbox">
						<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
						<span class="registration">Реєстрація</span>
					</div>
					<?php do_action( 'woocommerce_login_form_end' ); ?>
				</form>
				
				<div class="soc-login">
					<div >
						<p class = "d-none">Ввійти через</p>
						<div class="signforms__btnsbox d-none">
							<a href="#" class="google-btn">
								<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/google-plus.svg" alt="google">
								<span>google</span>
							</a>
							<a href="#" class="facebook-btn">
								<img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/fb.svg" alt="facebook">
								<span>facebook</span>
							</a>
						</div>
						
						<? echo do_shortcode('[yith_wc_social_login] '); ?>
						
					</div>
				</div>
			</div>
			<div class="regtab">
				<form method="post" class="woocommerce-form woocommerce-form-register register signforms" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
			<p class="title">Реєстрація</p>
			<?php do_action( 'woocommerce_register_form_start' ); ?>
			
			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
			
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			
			<?php endif; ?>
			
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			
			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
			
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
			</p>
			
			<?php else : ?>
			
			<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>
			
			<?php endif; ?>
			
			<?php do_action( 'woocommerce_register_form' ); ?>
			
			<p class="woocommerce-FormRow form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				
			</p>
			<div class="signforms__btnsbox">
						<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
						<span class="back">
						</span>
					</div>
			<?php do_action( 'woocommerce_register_form_end' ); ?>
			
		</form>
			</div>
			
		</div>
	</section>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
