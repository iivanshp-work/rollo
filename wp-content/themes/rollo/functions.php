<?php
/**
 * rollo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rollo
 */

if ( ! function_exists( 'rollo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rollo_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on rollo, use a find and replace
		 * to change 'rollo' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'rollo', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'rollo' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'rollo_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'rollo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rollo_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'rollo_content_width', 640 );
}
add_action( 'after_setup_theme', 'rollo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rollo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'rollo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'rollo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name' => __( 'Сортування', '' ),
        'id' => 'prod-sort',
        'description' => __( 'Сотрування товарів', '' ),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ) );

    register_sidebar( array(
        'name' => __( 'Фільтр ТИП', '' ),
        'id' => 'prod-filtr-1',
        'description' => __( 'Фільтр по типу', '' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '',
		'after_title'   => '',
    ) );

	register_sidebar( array(
        'name' => __( 'Фільтр Колір', '' ),
        'id' => 'prod-filtr-color',
        'description' => __( 'Фільтр по кольору', '' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '',
		'after_title'   => '',
    ) );


	register_sidebar( array(
        'name' => __( 'Фільтр затемнення', '' ),
        'id' => 'prod-filtr-temno',
        'description' => __( 'Фільтр затемнення', '' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '',
		'after_title'   => '',
    ) );

	register_sidebar( array(
        'name' => __( 'Фільтр фактура', '' ),
        'id' => 'prod-filtr-faktura',
        'description' => __( 'Фільтр фактура', '' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '',
		'after_title'   => '',
    ) );

	register_sidebar( array(
        'name' => __( 'Фільтр малюнок', '' ),
        'id' => 'prod-filtr-mal',
        'description' => __( 'Фільтр малюнок', '' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '',
		'after_title'   => '',
    ) );

	register_sidebar( array(
        'name' => __( 'Фільтр виробник', '' ),
        'id' => 'prod-filtr-vyr',
        'description' => __( 'Фільтр виробник', '' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '',
		'after_title'   => '',
    ) );
}
add_action( 'widgets_init', 'rollo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rollo_scripts() {
    wp_enqueue_style( 'rollo-style', get_stylesheet_uri() );
    wp_enqueue_style('rollo-style-slick', get_template_directory_uri() . '/assets/css/slick.css');
    wp_enqueue_style('rollo-style-slicklightbox', get_template_directory_uri() . '/assets/css/slick-lightbox.css');
    wp_enqueue_style('rollo-style-bootstrap-grid.min', get_template_directory_uri() . '/assets/css/bootstrap-grid.min.css');
    wp_enqueue_style('rollo-style-jquery.formstyler', get_template_directory_uri() . '/assets/css/jquery.formstyler.css');
    wp_enqueue_style('rollo-style-jquery.formstyler.theme', get_template_directory_uri() . '/assets/css/jquery.formstyler.theme.css');
    /* CHANGES RELATED TO WC PRODUCTS */
    wp_enqueue_style('rollo-style-rangeslider', get_template_directory_uri() . '/assets/css/rangeslider.css');
    wp_enqueue_style('rollo-style-common', get_template_directory_uri() . '/assets/css/common.css');
    wp_enqueue_style('rollo-style-responsive', get_template_directory_uri() . '/assets/css/responsive.css');
    wp_enqueue_style('rollo-style-font', "https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&display=swap&subset=cyrillic");


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rollo_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


require get_template_directory() . '/inc/woo-func.php';
require get_template_directory() . '/inc/lang.php';

remove_action('wp_head', 'wp_generator');

////////////*************/////////////
/**
 * Хлебные крошки для WordPress (breadcrumbs)
 *
 * @param  string [$sep  = '']      Разделитель. По умолчанию ' » '
 * @param  array  [$l10n = array()] Для локализации. См. переменную $default_l10n.
 * @param  array  [$args = array()] Опции. См. переменную $def_args
 * @return string Выводит на экран HTML код
 *
 * version 3.3.2
 */
 function kama_breadcrumbs( $sep = ' » ', $l10n = array(), $args = array() ){
    $kb = new Kama_Breadcrumbs;
    echo $kb->get_crumbs( $sep, $l10n, $args );
}

class Kama_Breadcrumbs {

    public $arg;

    // Локализация
    static $l10n = array(
        'home'       => 'Главная',
        'paged'      => 'Страница %d',
        '_404'       => 'Ошибка 404',
        'search'     => 'Результаты поиска по запросу - <b>%s</b>',
        'author'     => 'Архив автора: <b>%s</b>',
        'year'       => 'Архив за <b>%d</b> год',
        'month'      => 'Архив за: <b>%s</b>',
        'day'        => '',
        'attachment' => 'Медиа: %s',
        'tag'        => 'Записи по метке: <b>%s</b>',
        'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
        // tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
        // Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
    );

    // Параметры по умолчанию
    static $args = array(
        'on_front_page'   => true,  // выводить крошки на главной странице
        'show_post_title' => true,  // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
        'show_term_title' => true,  // показывать ли название элемента таксономии в конце (последний элемент). Для меток, рубрик и других такс
        'title_patt'      => '<li>%s</li>', // шаблон для последнего заголовка. Если включено: show_post_title или show_term_title
        'last_sep'        => false,  // показывать последний разделитель, когда заголовок в конце не отображается
        'markup'          => 'schema.org', // 'markup' - микроразметка. Может быть: 'rdf.data-vocabulary.org', 'schema.org', '' - без микроразметки
        // или можно указать свой массив разметки:
        // array( 'wrappatt'=>'<div class="kama_breadcrumbs">%s</div>', 'linkpatt'=>'<a href="%s">%s</a>', 'sep_after'=>'', )
        'priority_tax'    => array('category'), // приоритетные таксономии, нужно когда запись в нескольких таксах
        'priority_terms'  => array(), // 'priority_terms' - приоритетные элементы таксономий, когда запись находится в нескольких элементах одной таксы одновременно.
        // Например: array( 'category'=>array(45,'term_name'), 'tax_name'=>array(1,2,'name') )
        // 'category' - такса для которой указываются приор. элементы: 45 - ID термина и 'term_name' - ярлык.
        // порядок 45 и 'term_name' имеет значение: чем раньше тем важнее. Все указанные термины важнее неуказанных...
        'nofollow' => false, // добавлять rel=nofollow к ссылкам?

        // служебные
        'sep'             => '',
        'linkpatt'        => '',
        'pg_end'          => '',
    );

    function get_crumbs( $sep, $l10n, $args ){
        global $post, $wp_query, $wp_post_types;

        self::$args['sep'] = $sep;

        // Фильтрует дефолты и сливает
        $loc = (object) array_merge( apply_filters('kama_breadcrumbs_default_loc', self::$l10n ), $l10n );
        $arg = (object) array_merge( apply_filters('kama_breadcrumbs_default_args', self::$args ), $args );

        $arg->sep = '<span class="kb_sep">'. $arg->sep .'</span>'; // дополним

        // упростим
        $sep = & $arg->sep;
        $this->arg = & $arg;

        // микроразметка ---
        if(1){
            $mark = & $arg->markup;

            // Разметка по умолчанию
            if( ! $mark ) $mark = array(
                'wrappatt'  => '',
                'linkpatt'  => '<a href="%s">%s</a>',
                'sep_after' => '',
            );
            // rdf
            elseif( $mark === 'rdf.data-vocabulary.org' ) $mark = array(
                'wrappatt'   => '<div class="kama_breadcrumbs" prefix="v: http://rdf.data-vocabulary.org/#">%s</div>',
                'linkpatt'   => '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">%s</a>',
                'sep_after'  => '</span>', // закрываем span после разделителя!
            );
            // schema.org
            elseif( $mark === 'schema.org' )
				{$mark = array(
                'wrappatt'   => '%s',
                'linkpatt'   => '<li><a href="%s" itemprop="item"><span itemprop="name">%s</span><meta itemprop="position" content="$d"></a></li>',
                'sep_after'  => '',
            );

				 }

            elseif( ! is_array($mark) )
                die( __CLASS__ .': "markup" parameter must be array...');

            $wrappatt  = $mark['wrappatt'];
            $arg->linkpatt  = $arg->nofollow ? str_replace('<a ','<a rel="nofollow"', $mark['linkpatt']) : $mark['linkpatt'];
            $arg->sep      .= $mark['sep_after']."\n";
        }

        $linkpatt = $arg->linkpatt; // упростим

        $q_obj = get_queried_object();

        // может это архив пустой таксы?
        $ptype = null;
        if( empty($post) ){
            if( isset($q_obj->taxonomy) )
                $ptype = & $wp_post_types[ get_taxonomy($q_obj->taxonomy)->object_type[0] ];
        }
        else $ptype = & $wp_post_types[ $post->post_type ];

        // paged
        $arg->pg_end = '';
        if( ($paged_num = get_query_var('paged')) || ($paged_num = get_query_var('page')) )
            $arg->pg_end = $sep . sprintf( $loc->paged, (int) $paged_num );

        $pg_end = $arg->pg_end; // упростим

        // ну, с богом...
        $out = '';

        if( is_front_page() ){
            return $arg->on_front_page ? sprintf( $wrappatt, ( $paged_num ? sprintf($linkpatt, get_home_url(), $loc->home) . $pg_end : $loc->home ) ) : '';
        }
        // страница записей, когда для главной установлена отдельная страница.
        elseif( is_home() ) {
            $out = $paged_num ? ( sprintf( $linkpatt, get_permalink($q_obj), esc_html($q_obj->post_title) ) . $pg_end ) : esc_html($q_obj->post_title);
        }
        elseif( is_404() ){
            $out = $loc->_404;
        }
        elseif( is_search() ){
            $out = sprintf( $loc->search, esc_html( $GLOBALS['s'] ) );
        }
        elseif( is_author() ){
            $tit = sprintf( $loc->author, esc_html($q_obj->display_name) );
            $out = ( $paged_num ? sprintf( $linkpatt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) . $pg_end, $tit ) : $tit );
        }
        elseif( is_year() || is_month() || is_day() ){
            $y_url  = get_year_link( $year = get_the_time('Y') );

            if( is_year() ){
                $tit = sprintf( $loc->year, $year );
                $out = ( $paged_num ? sprintf($linkpatt, $y_url, $tit) . $pg_end : $tit );
            }
            // month day
            else {
                $y_link = sprintf( $linkpatt, $y_url, $year);
                $m_url  = get_month_link( $year, get_the_time('m') );

                if( is_month() ){
                    $tit = sprintf( $loc->month, get_the_time('F') );
                    $out = $y_link . $sep . ( $paged_num ? sprintf( $linkpatt, $m_url, $tit ) . $pg_end : $tit );
                }
                elseif( is_day() ){
                    $m_link = sprintf( $linkpatt, $m_url, get_the_time('F'));
                    $out = $y_link . $sep . $m_link . $sep . get_the_time('l');
                }
            }
        }
        // Древовидные записи
        elseif( is_singular() && $ptype->hierarchical ){
            $out = $this->_add_title( $this->_page_crumbs($post), $post );
        }
        // Таксы, плоские записи и вложения
        else {
            $term = $q_obj; // таксономии

            // определяем термин для записей (включая вложения attachments)
            if( is_singular() ){
                // изменим $post, чтобы определить термин родителя вложения
                if( is_attachment() && $post->post_parent ){
                    $save_post = $post; // сохраним
                    $post = get_post($post->post_parent);
                }

                // учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
                $taxonomies = get_object_taxonomies( $post->post_type );
                // оставим только древовидные и публичные, мало ли...
                $taxonomies = array_intersect( $taxonomies, get_taxonomies( array('hierarchical' => true, 'public' => true) ) );

                if( $taxonomies ){
                    // сортируем по приоритету
                    if( ! empty($arg->priority_tax) ){
                        usort( $taxonomies, function($a,$b)use($arg){
                            $a_index = array_search($a, $arg->priority_tax);
                            if( $a_index === false ) $a_index = 9999999;

                            $b_index = array_search($b, $arg->priority_tax);
                            if( $b_index === false ) $b_index = 9999999;

                            return ( $b_index === $a_index ) ? 0 : ( $b_index < $a_index ? 1 : -1 ); // меньше индекс - выше
                        } );
                    }

                    // пробуем получить термины, в порядке приоритета такс
                    foreach( $taxonomies as $taxname ){
                        if( $terms = get_the_terms( $post->ID, $taxname ) ){
                            // проверим приоритетные термины для таксы
                            $prior_terms = & $arg->priority_terms[ $taxname ];
                            if( $prior_terms && count($terms) > 2 ){
                                foreach( (array) $prior_terms as $term_id ){
                                    $filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
                                    $_terms = wp_list_filter( $terms, array($filter_field=>$term_id) );

                                    if( $_terms ){
                                        $term = array_shift( $_terms );
                                        break;
                                    }
                                }
                            }
                            else
                                $term = array_shift( $terms );

                            break;
                        }
                    }
                }

                if( isset($save_post) ) $post = $save_post; // вернем обратно (для вложений)
            }

            // вывод

            // все виды записей с терминами или термины
            if( $term && isset($term->term_id) ){
                $term = apply_filters('kama_breadcrumbs_term', $term );

                // attachment
                if( is_attachment() ){
                    if( ! $post->post_parent )
                        $out = sprintf( $loc->attachment, esc_html($post->post_title) );
                    else {
                        if( ! $out = apply_filters('attachment_tax_crumbs', '', $term, $this ) ){
                            $_crumbs    = $this->_tax_crumbs( $term, 'self' );
                            $parent_tit = sprintf( $linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent) );
                            $_out = implode( $sep, array($_crumbs, $parent_tit) );
                            $out = $this->_add_title( $_out, $post );
                        }
                    }
                }
                // single
                elseif( is_single() ){
                    if( ! $out = apply_filters('post_tax_crumbs', '', $term, $this ) ){
                        $_crumbs = $this->_tax_crumbs( $term, 'self' );
                        $out = $this->_add_title( $_crumbs, $post );
                    }
                }
                // не древовидная такса (метки)
                elseif( ! is_taxonomy_hierarchical($term->taxonomy) ){
                    // метка
                    if( is_tag() )
                        $out = $this->_add_title('', $term, sprintf( $loc->tag, esc_html($term->name) ) );
                    // такса
                    elseif( is_tax() ){
                        $post_label = $ptype->labels->name;
                        $tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
                        $out = $this->_add_title('', $term, sprintf( $loc->tax_tag, $post_label, $tax_label, esc_html($term->name) ) );
                    }
                }
                // древовидная такса (рибрики)
                else {
                    if( ! $out = apply_filters('term_tax_crumbs', '', $term, $this ) ){
                        $_crumbs = $this->_tax_crumbs( $term, 'parent' );
                        $out = $this->_add_title( $_crumbs, $term, esc_html($term->name) );
                    }
                }
            }
            // влоежния от записи без терминов
            elseif( is_attachment() ){
                $parent = get_post($post->post_parent);
                $parent_link = sprintf( $linkpatt, get_permalink($parent), esc_html($parent->post_title) );
                $_out = $parent_link;

                // вложение от записи древовидного типа записи
                if( is_post_type_hierarchical($parent->post_type) ){
                    $parent_crumbs = $this->_page_crumbs($parent);
                    $_out = implode( $sep, array( $parent_crumbs, $parent_link ) );
                }

                $out = $this->_add_title( $_out, $post );
            }
            // записи без терминов
            elseif( is_singular() ){
                $out = $this->_add_title( '', $post );
            }
        }

        // замена ссылки на архивную страницу для типа записи
        $home_after = apply_filters('kama_breadcrumbs_home_after', '', $linkpatt, $sep, $ptype );

        if( '' === $home_after ){
            // Ссылка на архивную страницу типа записи для: отдельных страниц этого типа; архивов этого типа; таксономий связанных с этим типом.
            if( $ptype && $ptype->has_archive && ! in_array( $ptype->name, array('post','page','attachment') )
                && ( is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)) )
            ){
                $pt_title = $ptype->labels->name;

                // первая страница архива типа записи
                if( is_post_type_archive() && ! $paged_num )
                    $home_after = sprintf( $this->arg->title_patt, $pt_title );
                // singular, paged post_type_archive, tax
                else{
                    $home_after = sprintf( $linkpatt, get_post_type_archive_link($ptype->name), $pt_title );

                    $home_after .= ( ($paged_num && ! is_tax()) ? $pg_end : $sep ); // пагинация
                }
            }
        }

        $before_out = sprintf( $linkpatt, home_url(), $loc->home ) . ( $home_after ? $sep.$home_after : ($out ? $sep : '') );

        $out = apply_filters('kama_breadcrumbs_pre_out', $out, $sep, $loc, $arg );

        $out = sprintf( $wrappatt, $before_out . $out );

		 $count_link = count(explode('$d',$out));

            $iii= 1;
            foreach (explode('$d',$out) as $value) {
              $replace_out .= $value.$iii++;

            }
             $out =  substr($replace_out, 0, -1);

        return apply_filters('kama_breadcrumbs', $out, $sep, $loc, $arg );
    }

    function _page_crumbs( $post ){
        $parent = $post->post_parent;

        $crumbs = array();
        while( $parent ){
            $page = get_post( $parent );
            $crumbs[] = sprintf( $this->arg->linkpatt, get_permalink($page), esc_html($page->post_title) );
            $parent = $page->post_parent;
        }

        return implode( $this->arg->sep, array_reverse($crumbs) );
    }

    function _tax_crumbs( $term, $start_from = 'self' ){
        $termlinks = array();
        $term_id = ($start_from === 'parent') ? $term->parent : $term->term_id;
        while( $term_id ){
            $term       = get_term( $term_id, $term->taxonomy );
            $termlinks[] = sprintf( $this->arg->linkpatt, get_term_link($term), esc_html($term->name) );
            $term_id    = $term->parent;
        }

        if( $termlinks )
            return implode( $this->arg->sep, array_reverse($termlinks) ) /*. $this->arg->sep*/;
        return '';
    }

    // добалвяет заголовок к переданному тексту, с учетом всех опций. Добавляет разделитель в начало, если надо.
    function _add_title( $add_to, $obj, $term_title = '' ){
        $arg = & $this->arg; // упростим...
        $title = $term_title ? $term_title : esc_html($obj->post_title); // $term_title чиститься отдельно, теги моугт быть...
        $show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

        // пагинация
        if( $arg->pg_end ){
            $link = $term_title ? get_term_link($obj) : get_permalink($obj);
            $add_to .= ($add_to ? $arg->sep : '') . sprintf( $arg->linkpatt, $link, $title ) . $arg->pg_end;
        }
        // дополняем - ставим sep
        elseif( $add_to ){
            if( $show_title )
                $add_to .= $arg->sep . sprintf( $arg->title_patt, $title );
            elseif( $arg->last_sep )
                $add_to .= $arg->sep;
        }
        // sep будет потом...
        elseif( $show_title )
            $add_to = sprintf( $arg->title_patt, $title );

        return $add_to;
    }

} // Kama_Breadcrumbs


## CSS стили для админ-панели. Нужно создать файл 'wp-admin.css' в папке темы
add_action('admin_enqueue_scripts', 'my_admin_css', 99);
function my_admin_css(){
	wp_enqueue_style('my-wp-admin', get_template_directory_uri() .'/wp-admin.css' );
}


/* CHANGES RELATED TO WC PRODUCTS START */

function test($var = null, $exit = 1)
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    if ($exit) {
        exit;
    }
    return true;
}

function custom_find_matching_product_variation( $product, $match_attributes = array(), $multiple = false ) {
    global $wpdb;

    $meta_attribute_names = array();

    // Get attributes to match in meta.
    foreach ( $product->get_attributes() as $attribute ) {
        if ( ! $attribute->get_variation() ) {
            continue;
        }
        $meta_attribute_names[] = 'attribute_' . sanitize_title( $attribute->get_name() );
    }
    // Get the attributes of the variations.
    $query = $wpdb->prepare(
        "
			SELECT postmeta.post_id, postmeta.meta_key, postmeta.meta_value, posts.menu_order FROM {$wpdb->postmeta} as postmeta
			LEFT JOIN {$wpdb->posts} as posts ON postmeta.post_id=posts.ID
			WHERE postmeta.post_id IN (
				SELECT ID FROM {$wpdb->posts}
				WHERE {$wpdb->posts}.post_parent = %d
				AND {$wpdb->posts}.post_status = 'publish'
				AND {$wpdb->posts}.post_type = 'product_variation'
			)
			",
        $product->get_id()
    );


    $query .= ' AND postmeta.meta_key IN ( "' . implode( '","', array_map( 'esc_sql', $meta_attribute_names ) ) . '" )';

    $query.=' ORDER BY posts.menu_order ASC, postmeta.post_id ASC;';

    $attributes = $wpdb->get_results( $query ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared

    if ( ! $attributes ) {
        return 0;
    }

    $sorted_meta = array();

    foreach ( $attributes as $m ) {
        $sorted_meta[ $m->post_id ][ $m->meta_key ] = $m->meta_value; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
    }

    /**
     * Check each variation to find the one that matches the $match_attributes.
     *
     * Note: Not all meta fields will be set which is why we check existance.
     */
    $multipleMatches = [];
    foreach ( $sorted_meta as $variation_id => $variation ) {
        $match = false;

        // Loop over the variation meta keys and values i.e. what is saved to the products. Note: $attribute_value is empty when 'any' is in use.
        foreach ( $variation as $attribute_key => $attribute_value ) {
            if ( array_key_exists( $attribute_key, $match_attributes ) && $match_attributes[ $attribute_key ] == $attribute_value ) {
                $match = true; // match
            }
        }

        if ( true === $match ) {
            if (!$multiple) {
                return $variation_id;
            } else {
                $multipleMatches[] = $variation_id;
            }
        }
    }

    if (!$multiple) {
        return 0;
    } else {
        return $multipleMatches;
    }

}

function recalculate_product_price() {
    $hasError = false;
    $errorMessage = '';
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : 0;
    $product_attributes = isset($_POST['product_attribute']) ? $_POST['product_attribute'] : [];
    $attributes = [];

    $title = $image = '';
    $productImages = [];
    if ($product_id) {
        if (isset($product_attributes['pa_kolory-modeli'])) {
            $attributes['attribute_pa_kolory-modeli'] = $product_attributes['pa_kolory-modeli'];
        }
        /*$var =  (new \WC_Product_Data_Store_CPT())->find_matching_product_variation( new \WC_Product($product_id), $attributes);*/
        $var = custom_find_matching_product_variation(new \WC_Product($product_id), $attributes);

        if ($var) {
            //if exist variant used it
            $variant = wc_get_product($var);
            $product = wc_get_product($product_id);
        } else {
            //if not exist variant then used original troduct
            $variant = wc_get_product($product_id);
            $product = wc_get_product($product_id);
        }
        $title = $variant->get_name();
        if ( $variant->get_image_id() ) {
            $image = wp_get_attachment_image($variant->get_image_id(), 'medium_large');
        } else if ( $product->get_image_id() ) {
            $image = wp_get_attachment_image($product->get_image_id(), 'medium_large');
        }
        $fields = ['_var_image_1', '_var_image_2', '_var_image_3'];
        foreach ($fields as $field) {
            $varImage = get_post_meta($variant->get_id(), $field, true);
            if ($varImage) {
                $varImage = [
                    'thumb' => wp_get_attachment_image_url($varImage),
                    'large' => wp_get_attachment_image_url($varImage, 'large')
                ];
                $productImages[] = $varImage;
            }
        }

        $width = isset($product_attributes['width']) ? $product_attributes['width'] : 0;
        $height = isset($product_attributes['height']) ? $product_attributes['height'] : 0;
        if ($width && $height) {
            $basePrice = $variant->get_price();
        } else {
            $basePrice = calculate_product_price($variant->get_id());
        }

        $sizesData = [
            'not_standard_sizes' => get_field('not_standard_sizes', $product->get_id()),
            'standard_sizes' => get_field('standard_sizes', $product->get_id()),
        ];
        $product_attributes['sizes'] = $sizesData;
        $product_attributes['calculate_price_type'] = get_field('calculate_price_type', $product->get_id());
        $product_attributes['box_price'] = get_field('box_price', $product->get_id());
        $product_attributes['mechanism_price_type_1'] = get_field('mechanism_price_type_1', $product->get_id());
        $product_attributes['mechanism_price_type_2'] = get_field('mechanism_price_type_2', $product->get_id());

        $hasAdditionalPriceAttributes = false;
        $additinalPriceAttributes = ['pa_kolory-systemy'];
        foreach ($additinalPriceAttributes as $additinalPriceAttribute) {
            if (isset($product_attributes[$additinalPriceAttribute])) {
                $hasAdditionalPriceAttributes = true;
            }
        }
        if (($width && $height) || $hasAdditionalPriceAttributes) {
            $price = calculatePrice($basePrice, $product_attributes);
        } else {
            $price = $basePrice;
        }
    } else {
        echo json_encode([
            'has_error' => true,
            'error_message' => pll__('Сталась помилка. Продукт не знайдено.')
        ]);
        wp_die();
    }
    echo json_encode([
        'has_error' => false,
        'price' => wc_price($price),
        'product_id' => $variant->get_id(),
        'variant_id' => isset($var) && $var ? $var : 0,
        'title' => $title,
        'image' => $image,
        'product_images' => $productImages
    ]);
    wp_die();
}
add_action('wp_ajax_recalculate_price', 'recalculate_product_price');
add_action('wp_ajax_nopriv_recalculate_price', 'recalculate_product_price');


function calculatePrice($basePrice = 0, $attributes = []) {
    $price = $basePrice;

    $width = isset($attributes['width']) ? $attributes['width'] : 0;
    $height = isset($attributes['height']) ? $attributes['height'] : 0;

    $generalAdditionPrice = 0;
    $hasGeneralAdditionPrice = false;
    //general additional price start
    $additinalPriceAttributes = ['pa_kolory-systemy'];
    foreach ($additinalPriceAttributes as $additinalPriceAttribute) {
        if (isset($attributes[$additinalPriceAttribute])) {
            $term_obj = get_term_by('slug', $attributes[$additinalPriceAttribute], $additinalPriceAttribute);
            $additinalPrice = get_field('additinal_price', $term_obj);
            $additinalPrice = $additinalPrice ? $additinalPrice : 0;
            $generalAdditionPrice += $additinalPrice;
            $hasGeneralAdditionPrice = true;
        }
    }

    if (!($width && $height) && $hasGeneralAdditionPrice) {
        $price += $generalAdditionPrice;
        return $price;
    }

    //general additional price end
    if (isset($attributes['sizes']['standard_sizes']) && !empty($attributes['sizes']['standard_sizes']) && is_array($attributes['sizes']['standard_sizes'])) {
        foreach($attributes['sizes']['standard_sizes'] as $size) {
            if (isset($size['price']) && isset($size['width']) && isset($size['height']) && $size['width'] == $width && $size['height'] == $height) {
                $price = $size['price'];
                $price += $generalAdditionPrice;
                return $price;
            }
        }
    }

    $calculatePriceType = isset($attributes['calculate_price_type']) ? trim($attributes['calculate_price_type']) : '';
    if ($calculatePriceType) {
        $method = 'calculatePriceFunction' . ucfirst($calculatePriceType);
        $price = $method($price, $width, $height, $attributes);
        $price += $generalAdditionPrice;
    } else {
        //default price calculation start
        $price += $generalAdditionPrice;
        if ($width && $height) {
            $price = calculatePriceFunction($price, $width, $height);
        }
        //default price calculation end
    }
    return $price;
}

function calculatePriceFunction($price, $width, $height) {
    if ($width < 500) {
        $width = 500;
    }
    $price = $price * ($width/1000);
    if ($height > 2500) {
        $price = $price + (0.8 * $price);
    } else if ($height > 2300  && $height <= 2500) {
        $price = $price + (0.6 * $price);
    } else if ($height > 1950  && $height <= 2300) {
        $price = $price + (0.4 * $price);
    }

    if ($width > 1800) {
        $price += 280;
    } else if ($width > 1250  && $width <= 1800) {
        $price += 115;
    } else {
        $price += 45;
    }
    return $price;
}
/*
 * calculatePriceFunctionType1
//Тканинні ролети
//Формула: ((Вартість тканини х (Ширина/1000)) + Умова 2) + Умова 3
//Вартість тканини - ціна, яку ми вказуємо як вартість варіації.
//Ширина - вводить клієнт в поп-ап вікні, ділю на 1000 щоб перевести з міліметрів в метри погонні.
//Умова 1 - Якщо ширина менше 500, тоді рахуємо як 500, якщо більше тоді значення яке ввів клієнт.
//Умова 2 - Якщо висота менше 1650 тоді 0, від 1650 до 2300 тоді 40%, від 2300 до 2500 тоді 60%, від 2500 до 2800 тоді 80%.
//Умова 3 - Якщо ширина менше 1250 тоді [48], від 1250 до 1800 тоді [108], від 1800 до 2800 тоді [220].
//Вартість тканини і значення в квадратних дужках (Умова 3) можуть змінюватись залежно від партії товару.
*/
function calculatePriceFunctionType1($price, $width, $height, $attributes = []) {
    if ($width < 500) {
        $width = 500;
    }
    $price = $price * ($width / 1000);
    if ($height >= 2500) {
        $price = $price + (0.8 * $price);
    } else if ($height >= 2300  && $height < 2500) {
        $price = $price + (0.6 * $price);
    } else if ($height >= 1650  && $height < 2300) {
        $price = $price + (0.4 * $price);
    }
    $mechanism_price_type_1 = isset($attributes['mechanism_price_type_1']) ? $attributes['mechanism_price_type_1'] : null;
    if ($width >= 1800 && isset($mechanism_price_type_1['price_1800_2800'])) {
        $price += $mechanism_price_type_1['price_1800_2800'];
    } else if ($width >= 1250  && $width < 1800 && isset($mechanism_price_type_1['price_1250_1800'])) {
        $price += $mechanism_price_type_1['price_1250_1800'];
    } elseif (isset($mechanism_price_type_1['price_0_1250'])) {
        $price += $mechanism_price_type_1['price_0_1250'];
    }
    return $price;
}
/*
//День-Ніч
//Формула: (Вартість тканини х ((Ширина/1000) х (Висота/1000))) + Умова 2
//Вартість тканини - ціна, яку ми вказуємо як вартість варіації.
//Ширина і Висота - вводить клієнт в поп-ап вікні, ділю на 1000 щоб перевести з міліметрів в метри квадратні.
//Умова 1 - Якщо ширина менше 500, тоді рахуємо як 500, якщо більше тоді значення яке ввів клієнт.
//Умова 2 - Якщо ширина менше 1250 тоді [0], від 1250 до 1800 тоді [115], від 1800 до 2500 тоді [170].
//Вартість тканини і значення в квадратних дужках (Умова 2) можуть змінюватись залежно від партії товару.
*/
function calculatePriceFunctionType2($price, $width, $height, $attributes = []) {
    if ($width < 500) {
        $width = 500;
    }
    $price = $price * ($width / 1000) * ($height / 1000);
    $mechanism_price_type_2 = isset($attributes['mechanism_price_type_2']) ? $attributes['mechanism_price_type_2'] : null;
    if ($width >= 1800 && isset($mechanism_price_type_2['price_1800_2500'])) {
        $price += $mechanism_price_type_2['price_1800_2500'];
    } else if ($width >= 1250  && $width < 1800 && isset($mechanism_price_type_2['price_1250_1800'])) {
        $price += $mechanism_price_type_2['price_1250_1800'];
    } elseif (isset($mechanism_price_type_2['price_0_1250'])) {
        $price += $mechanism_price_type_2['price_0_1250'];
    }
    return $price;
}
/*
//Вертикальні жалюзі
//Формула: Вартість тканини х ((Ширина/1000) х (Висота/1000))
//Вартість тканини - ціна, яку ми вказуємо як вартість варіації.
//Ширина і Висота - вводить клієнт в поп-ап вікні, ділю на 1000 щоб перевести з міліметрів в метри квадратні.
//Тільки вартість тканини може змінюватись залежно від партії товару, додаткових умов немає.
*/
function calculatePriceFunctionType3($price, $width, $height, $attributes = []) {
	if ($height <1600) {
        $height = 1600;
    }
    $price = $price * ($width / 1000) * ($height / 1000);
    return $price;
}
/*
//Плісе
//Формула: Вартість тканини х ((Ширина/1000) х (Висота/1000))
//Вартість тканини - ціна, яку ми вказуємо як вартість варіації.
//Ширина і Висота - вводить клієнт в поп-ап вікні, ділю на 1000 щоб перевести з міліметрів в метри квадратні.
//Умова 1 - Якщо площа (Ширина/1000) х (Висота/1000) менше ніж 0,7 тоді рахуємо як 0,7.
//Тільки вартість тканини може змінюватись залежно від партії товару.
*/
function calculatePriceFunctionType4($price, $width, $height, $attributes = []) {
    $area = ($width / 1000) * ($height / 1000);
    if ($area < 0.7) {
        $area = 0.7;
    }
    $price = $price * $area;
    return $price;
}
/*
//Тканинні ролети у коробі
//Формула: ((Вартість тканини х (Ширина/1000)) + Умова 2) + (Вартість короба х (Ширина/1000))
//Вартість тканини - ціна, яку ми вказуємо як вартість варіації.
//Вартість короба - ціна короба як додаткової фурнітури, такого поля ще немає.
//Ширина - вводить клієнт в поп-ап вікні, ділю на 1000 щоб перевести з міліметрів в метри погонні.
//Умова 1 - Якщо ширина менше 500, тоді рахуємо як 500, якщо більше тоді значення яке ввів клієнт.
//Умова 2 - Якщо висота менше 1650 тоді 0, від 1650 до 2300 тоді 40%, від 2300 до 2500 тоді 60%, від 2800 до 2800 тоді 80%.
//Тільки вартість може змінюватись залежно від партії товару.
*/
function calculatePriceFunctionType5($price, $width, $height, $attributes = []) {
    if ($width < 500) {
        $width = 500;
    }
    $price = $price * ($width / 1000);
    if ($height >= 2500) {
        $price = $price + (0.8 * $price);
    } else if ($height >= 2300  && $height < 2500) {
        $price = $price + (0.6 * $price);
    } else if ($height >= 1650  && $height < 2300) {
        $price = $price + (0.4 * $price);
    }
    $box_price = isset($attributes['box_price']) ? $attributes['box_price'] : 0;
    $price = $price + $box_price * ($width / 1000);
    return $price;
}
/*
//День-Ніч у коробі
//Формула: (Вартість тканини х ((Ширина/1000) х (Висота/1000))) + (Вартість короба х (Ширина/1000))
//Вартість тканини - ціна, яку ми вказуємо як вартість варіації.
//Вартість короба - ціна короба як додаткової фурнітури, такого поля ще немає.
//Ширина і Висота - вводить клієнт в поп-ап вікні, ділю на 1000 щоб перевести з міліметрів в метри погонні.
//Умова 1 - Якщо ширина менше 500, тоді рахуємо як 500, якщо більше тоді значення яке ввів клієнт.
//Тільки вартість може змінюватись залежно від партії товару.
*/
function calculatePriceFunctionType6($price, $width, $height, $attributes = []) {
    if ($width < 500) {
        $width = 500;
    }
    $price = $price * ($width / 1000) * ($height / 1000);
    $box_price = isset($attributes['box_price']) ? $attributes['box_price'] : 0;
    $price = $price + $box_price * ($width / 1000);
    return $price;
}

function calculate_product_price($product_id = null) {

    $price = 0;
    $product = wc_get_product($product_id);
    $parent_id = $product->get_parent_id();
    if ($parent_id) {
        $product = wc_get_product($parent_id);
    }
    $standardSizes = get_field('standard_sizes', $product->get_id());
    $standardPrice = 0;
    $hasStandardSize = false;
    if (!empty($standardSizes) && is_array($standardSizes)) {
        $standardSizeArea = 0;
        foreach($standardSizes as $size) {
            if (isset($size['price']) && isset($size['width']) && isset($size['height'])) {
                $sizeArea = $size['width'] * $size['height'];
                if ((!$standardSizeArea && $sizeArea) || ($standardSizeArea && $sizeArea < $standardSizeArea)) {
                    $standardPrice = $size['price'];
                    $standardSizeArea = $sizeArea;
                    $hasStandardSize = true;
                }
            }
        }
    }
    if ($hasStandardSize && $standardPrice) {
        $price = $standardPrice;
    } else {
        $price = $product->get_price();
    }
    return $price;
}

function product_review() {
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : 0;
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';
    $hasError = false;
    $errorMessage = '';

    if ($product_id) {
        if (!$name) {
            $hasError = true;
            $errorMessage .= pll__('Ім\'я не задано.') . '<br>';
        }
        if (!$email) {
            $hasError = true;
            $errorMessage .= pll__('Email не задано.') . '<br>';
        }
        if (!$comment) {
            $hasError = true;
            $errorMessage .= pll__('Відгук не задано.') . '<br>';
        }
        if (!$hasError) {
            //save comment
            $comment_id = wp_insert_comment( array(
                'comment_post_ID'      => $product_id, // <=== The product ID where the review will show up
                'comment_author'       => $name,
                'comment_author_email' => $email, // <== Important
                'comment_author_url'   => '',
                'comment_content'      => $comment,
                'comment_type'         => '',
                'comment_parent'       => 0,
                'user_id'              => 0, // <== Important
                'comment_author_IP'    => $_SERVER["REMOTE_ADDR"],
                'comment_agent'        => '',
                'comment_date'         => date('Y-m-d H:i:s'),
                'comment_approved'     => 0,
            ) );
            if ($comment_id) {
                $errorMessage = pll__('Дякуємо за Ваш відгук.');
                update_comment_meta( $comment_id, 'rating', 5 );
            } else {
                $hasError = true;
                $errorMessage = pll__('Сталась помилка, спробуйте пізніше.');
            }
        }
    } else {
        $hasError = true;
        $errorMessage .= pll__('Сталась помилка. Продукт не знайдено.') . '<br>';
    }

    echo json_encode([
        'has_error' => $hasError,
        'message' => $errorMessage,
    ]);
    wp_die();
}
add_action('wp_ajax_product_review', 'product_review');
add_action('wp_ajax_nopriv_product_review', 'product_review');


function ajax_add_to_cart() {
    $hasError = false;
    $errorMessage = '';
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : 0;
    $product_attributes = isset($_POST['product_attribute']) ? $_POST['product_attribute'] : [];
    $attributes = [];
    if ($product_id) {
        if (isset($product_attributes['pa_kolory-modeli']) && $product_attributes['pa_kolory-modeli']) {
            $attributes['attribute_pa_kolory-modeli'] = $product_attributes['pa_kolory-modeli'];
        }
        if (!isset($attributes['attribute_pa_kolory-modeli'])) {
            echo json_encode([
                'has_error' => true,
                'error_message' => pll__('Виберіть колір моделі'),
                'show_select_color_popup' => true,
            ]);
            wp_die();
        }
        /*$var =  (new \WC_Product_Data_Store_CPT())->find_matching_product_variation( new \WC_Product($product_id), $attributes);*/
        $variation_id = custom_find_matching_product_variation(new \WC_Product($product_id), $attributes);

        if ($variation_id) {
            //if exist variant used it
            $variant = wc_get_product($variation_id);
            $product = wc_get_product($product_id);
        } else {
            //if not exist variant then used original troduct
            $variant = wc_get_product($product_id);
            $product = wc_get_product($product_id);
        }

        $width = isset($product_attributes['width']) ? $product_attributes['width'] : 0;
        $height = isset($product_attributes['height']) ? $product_attributes['height'] : 0;
        if ($width && $height) {
            $basePrice = $variant->get_price();
        } else {
            $basePrice = calculate_product_price($variant->get_id());
        }

        $sizesData = [
            'not_standard_sizes' => get_field('not_standard_sizes', $product->get_id()),
            'standard_sizes' => get_field('standard_sizes', $product->get_id()),
        ];
        $product_attributes['sizes'] = $sizesData;
        $product_attributes['calculate_price_type'] = get_field('calculate_price_type', $product->get_id());
        $product_attributes['box_price'] = get_field('box_price', $product->get_id());
        $product_attributes['mechanism_price_type_1'] = get_field('mechanism_price_type_1', $product->get_id());
        $product_attributes['mechanism_price_type_2'] = get_field('mechanism_price_type_2', $product->get_id());

        $hasAdditionalPriceAttributes = false;
        $additinalPriceAttributes = ['pa_kolory-systemy'];
        foreach ($additinalPriceAttributes as $additinalPriceAttribute) {
            if (isset($product_attributes[$additinalPriceAttribute])) {
                $hasAdditionalPriceAttributes = true;
            }
        }
        if (($width && $height) || $hasAdditionalPriceAttributes) {
            $price = calculatePrice($basePrice, $product_attributes);
        } else {
            $price = $basePrice;
        }
    } else {
        echo json_encode([
            'has_error' => true,
            'error_message' => pll__('Сталась помилка. Продукт не знайдено.')
        ]);
        wp_die();
    }
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    //there will be attributes
    $cart_item_data['attributes'] = $product_attributes;
    $cart_item_data['price'] = $price;

    $variation = wc_get_product_variation_attributes( $variation_id );
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation, $cart_item_data) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
    } else {
        echo json_encode([
            'has_error' => true,
            'error_message' => pll__('Сталась помилка. Продукт не може бути доданий в корзину.')
        ]);
        wp_die();
    }
    $args = [
        'prod_id' => $product_id,
        'var_id' => $variation_id,

    ];
    $html = wc_get_template_html('single-product/add_to_cart_popup.php', $args, "", get_template_directory_uri() . "/woocommerce/");
    echo json_encode([
        'has_error' => false,
        'redirect_link' => esc_url((pll_current_language() == 'uk' ? '' : '/ru') . '/checkout/'),
        'html' => $html
    ]);
    wp_die();
}
add_action('wp_ajax_ajax_add_to_cart', 'ajax_add_to_cart');
add_action('wp_ajax_nopriv_ajax_add_to_cart', 'ajax_add_to_cart');

add_filter( 'woocommerce_add_cart_item', function( $cart_item )
{
    if ( isset( $cart_item['price'] ) )
    {
        $product = $cart_item['data'];
        $product->set_price( $cart_item['price'] );
        $product->set_regular_price( $cart_item['price'] );
        $cart_item['data'] = $product;
        /*$product->set_sale_price( $cart_item['new_price'] );*/
    }
    return $cart_item;
}, 11, 1 );

add_filter( 'woocommerce_get_cart_item_from_session', function( $cart_item, $values )
{
    if ( isset( $cart_item['price'] ) )
    {
        $product = $cart_item['data'];
        $product->set_price( $cart_item['price'] );
        $product->set_regular_price( $cart_item['price'] );
        $cart_item['data'] = $product;
        /*$product->set_sale_price( $cart_item['new_price'] );*/
    }
    return $cart_item;

}, 11, 2 );

function ajax_product_remove()
{
    ob_start();
    $cart_item_key = isset($_POST['cart_item_key']) ? trim($_POST['cart_item_key']) : '';
    if (!$cart_item_key) {
        echo json_encode([
            'has_error' => true,
            'error_message' => pll__('Сталась помилка. Продукт не може бути видалений.')
        ]);
        wp_die();
    }
    $delete = WC()->cart->remove_cart_item($cart_item_key);

    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();
    // Get order review fragment.
    ob_start();
    woocommerce_order_review();
    $woocommerce_order_review = ob_get_clean();
    // Get checkout payment fragment.
    ob_start();
    woocommerce_checkout_payment();
    $woocommerce_checkout_payment = ob_get_clean();
    woocommerce_mini_cart();
    $mini_cart = ob_get_clean();
    // Fragments and mini cart are returned
    $data = array(
        'fragments' => apply_filters(
            'woocommerce_update_order_review_fragments',
            array(
                '.woocommerce-checkout-review-order-table' => $woocommerce_order_review,
                '.woocommerce-checkout-payment' => $woocommerce_checkout_payment,
            )
        ),
        'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() ),
        'total_products' => WC()->cart->get_cart_contents_count(),
        'total' => WC()->cart->get_total()
    );
    wp_send_json( $data );
    die();
}
add_action( 'wp_ajax_product_remove', 'ajax_product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'ajax_product_remove' );

function set_quantity() {
    $cart_item_key = isset($_POST['cart_item_key']) ? trim($_POST['cart_item_key']) : '';
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if (!$cart_item_key) {
        echo json_encode([
            'has_error' => true,
            'error_message' => pll__('Сталась помилка. Неможливо змінити кількість.')
        ]);
        wp_die();
    }

    WC()->cart->set_quantity($cart_item_key, $quantity);

    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();
    // Get order review fragment.
    ob_start();
    woocommerce_order_review();
    $woocommerce_order_review = ob_get_clean();
    // Get checkout payment fragment.
    ob_start();
    woocommerce_checkout_payment();
    $woocommerce_checkout_payment = ob_get_clean();
    woocommerce_mini_cart();
    $mini_cart = ob_get_clean();
    // Fragments and mini cart are returned
    $data = array(
        'fragments' => apply_filters(
            'woocommerce_update_order_review_fragments',
            array(
                '.woocommerce-checkout-review-order-table' => $woocommerce_order_review,
                '.woocommerce-checkout-payment' => $woocommerce_checkout_payment,
            )
        ),
        'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() ),
        'total_products' => WC()->cart->get_cart_contents_count(),
        'total' => WC()->cart->get_total()
    );
    wp_send_json( $data );
    die();
}
add_action('wp_ajax_set_quantity', 'set_quantity');
add_action('wp_ajax_nopriv_set_quantity', 'set_quantity');


function redirect_cart_page() {
    if (is_checkout() && !is_wc_endpoint_url( 'order-received' )) {
        $totalCartItems = WC()->cart->get_cart_contents_count();
        if (!$totalCartItems) {
            wp_redirect((pll_current_language() == 'uk' ? '' : '/ru') . '/');
        }
    }
    if (is_cart()) {
        $totalCartItems = WC()->cart->get_cart_contents_count();
        if ($totalCartItems) {
            wp_redirect(esc_url((pll_current_language() == 'uk' ? '' : '/ru') . '/checkout/'));
        } else {
            wp_redirect((pll_current_language() == 'uk' ? '' : '/ru') . '/');
        }
    }
    if (is_checkout() && !is_wc_endpoint_url( 'order-received' )) {
        wc_setcookie('pll_current_lang_custom', pll_current_language(), time() + 60*10);
    }

    if (is_wc_endpoint_url( 'order-received')) {
        $pll_current_lang_custom = array_key_exists('pll_current_lang_custom', $_COOKIE) ? trim($_COOKIE['pll_current_lang_custom']) : null;
        $pll_current_lang = pll_current_language();
        if ($pll_current_lang_custom && $pll_current_lang_custom != $pll_current_lang) {
            $url = $_SERVER['REQUEST_URI'];
            if ($pll_current_lang_custom == 'ru') {
                $url = '/ru' . $url;
            } else {
                $url = str_replace('/ru/', '/', $url);
            }
            wc_setcookie('pll_current_lang_custom', pll_current_language(), time() - 60*100);
            wp_redirect($url);
        }

    }
}
add_action('template_redirect', 'redirect_cart_page');


function add_order_item_custom_meta($item, $cart_item_key, $cart_item, $order) {
    if (isset($cart_item['price'])) {
        $item->update_meta_data( '_product_price', $cart_item['price'] );
    }
    if (isset($cart_item['attributes'])) {
        $item->update_meta_data( '_product_attributes', $cart_item['attributes'] );
        foreach($cart_item['attributes'] as $key => $attribute) {
            $item->update_meta_data( '_product_attribute_' . $key,  $attribute);
        }
    }
}
add_action('woocommerce_checkout_create_order_line_item', 'add_order_item_custom_meta', 10, 4 );

function change_order_item_meta_title( $key, $meta, $item ) {

    // By using $meta-key we are sure we have the correct one.
    if ( '_product_price' == $key ) { $key = 'Ціна'; }
    if ( '_product_width' == $key ) { $key = 'Ширина'; }
    if ( '_product_height' == $key ) { $key = 'Висота'; }
    if ( '_product_pa_kolory-modeli' == $key ) { $key = 'Колір моделі'; }
    if ( '_product_pa_storona-upravlinnya' == $key ) { $key = 'Сторона управління'; }
    if ( '_product_pa_kolory-systemy' == $key ) { $key = 'Колір системи'; }
    return $key;
}
add_filter( 'woocommerce_order_item_display_meta_key', 'change_order_item_meta_title', 20, 3 );

function change_order_item_meta_value( $value, $meta, $item ) {

    // By using $meta-key we are sure we have the correct one.
    if ( '_product_attribute_width' === $meta->key ) { $value = $value . ' мм'; }
    if ( '_product_attribute_height' === $meta->key ) { $value = $value . ' мм'; }
    if ( '_product_attribute_pa_kolory-modeli' === $meta->key ) {
        $term_obj = get_term_by('slug', $value, "pa_kolory-modeli");
        if ($term_obj) {
            $value = $term_obj->name;
        }
    }
    if ( '_product_attribute_pa_kolory-systemy' === $meta->key ) {
        $term_obj = get_term_by('slug', $value, "pa_kolory-systemy");
        if ($term_obj) {
            $value = $term_obj->name;
        } }
    if ( '_product_attribute_pa_storona-upravlinnya' === $meta->key ) {
        $term_obj = get_term_by('slug', $value, "pa_storona-upravlinnya");
        if ($term_obj) {
            $value = $term_obj->name;
        }
    }
    return $value;
}
add_filter( 'woocommerce_order_item_display_meta_value', 'change_order_item_meta_value', 20, 3 );

function hide_my_item_meta( $hidden_meta ) {
    $hidden_meta[] = '_product_price';
    return $hidden_meta;
}
add_filter( 'woocommerce_hidden_order_itemmeta', 'hide_my_item_meta' );
//nova poshta api key: 5dc29908a8b509da998f8600c919ba7f

add_filter('wc_ukr_shipping_language', function ($lang) {
    if (pll_current_language() === 'uk') {
        return 'ua';
    }
    return 'ru';
});

add_filter('wc_ukr_shipping_get_nova_poshta_translates', function ($translates) {
    $currentLanguage = wp_doing_ajax() ? $_COOKIE['pll_language'] : pll_current_language();
    if ($currentLanguage === 'uk') {
        return [
            'method_title' => 'Нова Пошта',
            'block_title' => 'Вкажіть відділення доставки',
            'placeholder_area' => 'Оберіть область',
            'placeholder_city' => 'Оберіть місто',
            'placeholder_warehouse' => 'Оберіть відділення',
            'address_title' => 'Доставка кур\'ером',
            'address_placeholder' => 'Введіть адресу доставки'
        ];
    }
    return [
        'method_title' => 'Новая почта',
        'block_title' => 'Укажите отделение доставки',
        'placeholder_area' => 'Выберите область',
        'placeholder_city' => 'Выберите город',
        'placeholder_warehouse' => 'Выберите отделение',
        'address_title' => 'Доставка курьером',
        'address_placeholder' => 'Введите адрес доставки'
    ];
});

add_filter('woocommerce_add_error', function ($message){
    if ($message == 'Укажите отделение Новой Почты') {
        $currentLanguage = wp_doing_ajax() ? $_COOKIE['pll_language'] : pll_current_language();
        if ($currentLanguage === 'uk') {
            $message = 'Вкажіть відділення Нової Пошти';
        }
    }
    return $message;
}, 20, 3);

function wc_display_item_meta_custom( $item, $args = array() ) {
    $strings = array();
    $html    = '';
    $args    = wp_parse_args(
        $args,
        array(
            'before'       => '<ul class="wc-item-meta"><li>',
            'after'        => '</li></ul>',
            'separator'    => '</li><li>',
            'echo'         => true,
            'autop'        => false,
            'label_before' => '<strong class="wc-item-meta-label">',
            'label_after'  => ':</strong> ',
        )
    );
    $skipKeys = ['_product_price', '_product_attribute_pa_kolory-modeli'];
    foreach ( $item->get_formatted_meta_data("", true) as $meta_id => $meta ) {
        if (in_array($meta->key, $skipKeys)) continue;
        $meta->display_value = trim($meta->display_value);
        $meta->display_value = '<p2>' . pll__(strip_tags($meta->display_value)) . '</p2>';
        $meta->display_key = pll__($meta->display_key);
        $value     = $args['autop'] ? wp_kses_post( $meta->display_value ) : wp_kses_post( make_clickable( trim( $meta->display_value ) ) );
        $strings[] = $args['label_before'] . wp_kses_post( $meta->display_key ) . $args['label_after'] . $value;
    }
    if ( $strings ) {
        $html = $args['before'] . implode( $args['separator'], $strings ) . $args['after'];
    }

    $html = apply_filters( 'woocommerce_display_item_meta', $html, $item, $args );

    if ( $args['echo'] ) {
        echo $html; // WPCS: XSS ok.
    } else {
        return $html;
    }
}

function variation_settings_fields( $loop, $variation_data, $variation ) {
    $html =  '<p class="form-row upload_image">';
    $html .=     '<label>Фото мініатюри</label>';
    $html .=     '<a href="#" class="upload_image_button ' . (get_post_meta( $variation->ID, '_mini_image', true ) ? 'remove' : '') . ' ">';
    $html .=        '<img src="' .  (get_post_meta( $variation->ID, '_mini_image', true ) ?  esc_url( wp_get_attachment_thumb_url( get_post_meta( $variation->ID, '_mini_image', true ) ) ) : esc_url( wc_placeholder_img_src() )) . '" />';
    $html .=        '<input type="hidden" name="_mini_image[' . $variation->ID . ']" class="upload_image_id" value="' . get_post_meta( $variation->ID, '_mini_image', true ) . '" />';
    $html .=     '</a>';
    $html .= '</p><br><br>';
    $html .=  '<p class="form-row upload_image">';
    $html .=     '<a href="#" class="upload_image_button ' . (get_post_meta( $variation->ID, '_var_image_1', true ) ? 'remove' : '') . ' ">';
    $html .=        '<img src="' .  (get_post_meta( $variation->ID, '_var_image_1', true ) ?  esc_url( wp_get_attachment_thumb_url( get_post_meta( $variation->ID, '_var_image_1', true ) ) ) : esc_url( wc_placeholder_img_src() )) . '" />';
    $html .=        '<input type="hidden" name="_var_image_1[' . $variation->ID . ']" class="upload_image_id" value="' . get_post_meta( $variation->ID, '_var_image_1', true ) . '" />';
    $html .=     '</a>';
    $html .= '</p>';
    $html .=  '<p class="form-row upload_image">';
    $html .=     '<a href="#" class="upload_image_button ' . (get_post_meta( $variation->ID, '_var_image_2', true ) ? 'remove' : '') . ' ">';
    $html .=        '<img src="' .  (get_post_meta( $variation->ID, '_var_image_2', true ) ?  esc_url( wp_get_attachment_thumb_url( get_post_meta( $variation->ID, '_var_image_2', true ) ) ) : esc_url( wc_placeholder_img_src() )) . '" />';
    $html .=        '<input type="hidden" name="_var_image_2[' . $variation->ID . ']" class="upload_image_id" value="' . get_post_meta( $variation->ID, '_var_image_2', true ) . '" />';
    $html .=     '</a>';
    $html .= '</p>';
    $html .=  '<p class="form-row upload_image">';
    $html .=     '<label>Фото товару</label>';
    $html .=     '<a href="#" class="upload_image_button ' . (get_post_meta( $variation->ID, '_var_image_3', true ) ? 'remove' : '') . ' ">';
    $html .=        '<img src="' .  (get_post_meta( $variation->ID, '_var_image_3', true ) ?  esc_url( wp_get_attachment_thumb_url( get_post_meta( $variation->ID, '_var_image_3', true ) ) ) : esc_url( wc_placeholder_img_src() )) . '" />';
    $html .=        '<input type="hidden" name="_var_image_3[' . $variation->ID . ']" class="upload_image_id" value="' . get_post_meta( $variation->ID, '_var_image_3', true ) . '" />';
    $html .=     '</a>';
    $html .= '</p>';
    echo $html;
}
add_action( 'woocommerce_product_after_variable_attributes', 'variation_settings_fields', 10, 3 );

function save_variation_settings_fields( $variation_id, $i ) {
    $fields = ['_mini_image', '_var_image_1', '_var_image_2', '_var_image_3'];
    foreach ($fields as $field) {
        $text_field = $_POST[$field][$variation_id];
        if (!empty($text_field)) {
            update_post_meta($variation_id, $field, esc_attr($text_field));
        }
    }
    update_post_meta($variation_id, '_test_field', 'test_field2');

    $variant = wc_get_product($variation_id);
    $variant_product_attributes = $variant->get_attributes();
    if (isset($variant_product_attributes['pa_kolory-modeli']) && $variant_product_attributes['pa_kolory-modeli'] && isset($variant_product_attributes['pa_kolory-modeli-main']) && $variant_product_attributes['pa_kolory-modeli-main']) {
        $term_obj = get_term_by('slug', $variant_product_attributes['pa_kolory-modeli'], "pa_kolory-modeli");
        if ($term_obj && $term_obj->term_id) {
            $variant_name = $variant->get_name() . ' - ' . $term_obj->name;
            $variant->set_name($variant_name);
        }
    }
    $variation_post_title = $variant->get_name();
    $variation_post_title .= ' s';

    wp_update_post( [
        'ID' => $variation_id,
        'post_title' => $variation_post_title,
    ] );

    clean_post_cache( $variation_id );

}
add_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );

function woocommerce_product_variation_title_action( $variation_id ) {
    $variant = wc_get_product($variation_id);
    $variant_product_attributes = $variant->get_attributes();
    if (isset($variant_product_attributes['pa_kolory-modeli']) && $variant_product_attributes['pa_kolory-modeli'] && isset($variant_product_attributes['pa_kolory-modeli-main']) && $variant_product_attributes['pa_kolory-modeli-main']) {
        $term_obj = get_term_by('slug', $variant_product_attributes['pa_kolory-modeli'], "pa_kolory-modeli");
        if ($term_obj && $term_obj->term_id) {
            $variant_name = $variant->get_name() . ' - ' . $term_obj->name;
            $variant->set_name($variant_name);
        }
    }
    $variation_post_title = $variant->get_name();
    wp_update_post( [
        'ID' => $variation_id,
        'post_title' => $variation_post_title,
    ] );
};
function filter_woocommerce_product_variation_title( $rtrim, $product, $title_base, $title_suffix ) {
    $variant_product_attributes = $product->get_attributes();
    if (isset($variant_product_attributes['pa_kolory-modeli']) && $variant_product_attributes['pa_kolory-modeli'] && isset($variant_product_attributes['pa_kolory-modeli-main']) && $variant_product_attributes['pa_kolory-modeli-main']) {
        $term_obj = get_term_by('slug', $variant_product_attributes['pa_kolory-modeli'], "pa_kolory-modeli");
        if ($term_obj && $term_obj->term_id) {
            $rtrim .= ' - ' . $term_obj->name;
        }
    }
    return $rtrim;
};
add_filter( 'woocommerce_product_variation_title', 'filter_woocommerce_product_variation_title', 10, 4 );

function load_variation_settings_fields( $variations ) {
    $fields = ['_mini_image', '_var_image_1', '_var_image_2', '_var_image_3'];
    foreach ($fields as $field) {
        $variations[$field] = get_post_meta($variations['variation_id'], $field, true);
    }
    return $variations;
}
add_filter( 'woocommerce_available_variation', 'load_variation_settings_fields' );

function the_posts_variations( $posts, $query = false ) {
    $koloryModeli = isset($_REQUEST['filter_kolory-modeli-main']) ? trim($_REQUEST['filter_kolory-modeli-main']) : null;
    if ($koloryModeli && $posts) {
        $koloryModeli = explode(',', $koloryModeli);
        $postsNew = [];
        foreach ($posts as $post) {
            if ($post->post_type != 'product') continue;
            $variant = null;
            foreach($koloryModeli as $kolorModeli) {
                $attributes = [];
                $attributes['attribute_pa_kolory-modeli-main'] = $kolorModeli;
                /*$var =  (new \WC_Product_Data_Store_CPT())->find_matching_product_variation( new \WC_Product($product_id), $attributes);*/
                $varIDs = custom_find_matching_product_variation(new \WC_Product($post->ID), $attributes, true);
                if (!empty($varIDs)) {
                    foreach ($varIDs as $varID) {
                        if ($varID) {
                            //if exist variant used it
                            //$variant = wc_get_product($varID);
                            $variant = get_post($varID);
                            $postsNew[] = $variant;
                        }
                    }
                }
            }
            if (!$variant) {
                $postsNew[] = $post;
            }
        }
        $posts = $postsNew;
    }
    return $posts;
}
add_action( 'the_posts', 'the_posts_variations', 15, 2 );


/*Export orders to xlsx start */
add_action('admin_footer', 'export_orders_to_xlsx_btn');
function export_orders_to_xlsx_btn() {
    $screen = get_current_screen();
    if ( $screen->id != "edit-shop_order" )   // Only add to users.php page
        return;
    ?>
    <script type="text/javascript">
        jQuery(document).ready( function($)
        {
            $('.tablenav.top .clear, .tablenav.bottom .clear').before('<form action="#" method="POST"><input type="hidden" id="mytheme_export_xlsx" name="mytheme_export_xlsx" value="1" /><input class="button button-primary user_export_button" style="" type="submit" value="<?php esc_attr_e('Експорт XLSX', 'mytheme');?>" /></form>');
        });
    </script>
    <?php
}
add_action('admin_init', 'export_orders_to_xlsx');

function export_orders_to_xlsx() {
    if (!empty($_POST['mytheme_export_xlsx'])) {
        if (current_user_can('manage_options')) {
            if ( defined('CBXPHPSPREADSHEET_PLUGIN_NAME') && file_exists( CBXPHPSPREADSHEET_ROOT_PATH . 'lib/vendor/autoload.php' ) ) {
                //Include PHPExcel
                require_once( CBXPHPSPREADSHEET_ROOT_PATH . 'lib/vendor/autoload.php' );
                //now take instance
                $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
                $fields = [
                    "ID" => "Номер",
                    "date" => "Дата",
                    "name" => "ПІБ",
                    "phone" => "Телефон",
                    "email" => "Email",
                    "address" => "Адреса",
                    "shipping_method" => "Спосіб доставки",
                    "payment_method" => "Оплата",
                    "product_name" => "Назва товару",
                    "quantity" => "Кількість",
                    "total" => "Сума",
                    "status" => "Статус",
                ];

                $args = array(
                    'paginate' => false,
                    'limit' => -1,
                );
                $orders = wc_get_orders($args);
                $records = [];
                if ($orders) {
                    foreach ($orders as $order) {
                        $record = [];
                        $record['ID'] = $order->get_id();
                        $record['date'] = date("d.m.Y H:i", strtotime($order->get_date_created()));
                        $record['name'] = $order->get_formatted_billing_full_name();
                        $record['phone'] = $order->get_billing_phone();
                        $record['email'] = $order->get_billing_email();
                        $address = '';
                        if ($order->get_billing_address_1()) {
                            $address .= $order->get_billing_address_1() . ' ';
                        }
                        if ($order->get_billing_city()) {
                            $address .= $order->get_billing_city() . ' ';
                        }
                        if ($order->get_billing_state()) {
                            $address .= '(' . $order->get_billing_state() . ' обл.) ';
                        }
                        if ($order->get_billing_postcode()) {
                            $address .= ', ' . $order->get_billing_postcode() . ' ';
                        }
                        $record['address'] = trim($address);
                        $record['shipping_method'] = $order->get_shipping_method();
                        $record['payment_method'] = $order->get_payment_method_title();
                        //TODO
                        $orderItems = $order->get_items();
                        $countItems = $orderItems ? count($order->get_items()) : 0;
                        $orderTitle = "";
                        if ($orderItems) {
                            foreach($orderItems as $orderItem) {
                                if ($countItems > 1) {
                                    $orderTitle .= $orderItem->get_name() . " - " . $orderItem->get_quantity() .  "шт.\n";
                                } else {
                                    $orderTitle .= $orderItem->get_name();
                                }
                            }
                        }
                        $record['product_name'] = $orderTitle;
                        $record['quantity'] = $order->get_item_count();
                        $record['total'] = strip_tags($order->get_formatted_order_total());
                        $record['status'] = wc_get_order_status_name($order->get_status());
                        $records[] = $record;
                    }
                }

                // filename
                $filename = 'rollo-orders-export-' . time();
                // Create new Spreadsheet object
                $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
                // Set document properties
                $spreadsheet->getProperties()
                    ->setCreator('Rollo')
                    ->setLastModifiedBy('Rollo')
                    ->setTitle('Rollo Orders Export')
                    ->setSubject($filename)
                    ->setDescription($filename);
                // Scheduler Spreadsheet Start
                $worksheet = $spreadsheet->setActiveSheetIndex(0);
                // Rename worksheet to Scheduler
                $spreadsheet->getActiveSheet()->setTitle('Rollo Orders Export');
                //add column titles to spreadsheet
                $r = 1;
                $c = 0;
                foreach ($fields as $item => $label) {
                    $c++;
                    $worksheet->setCellValueByColumnAndRow($c, $r, $label)
                        ->getStyleByColumnAndRow($c, $r)
                        ->getFont()
                        ->setBold(true);
                    $worksheet->getColumnDimensionByColumn($c)->setAutoSize(true);
                }
                if (!empty($records)) {
                    //add order items to spreadsheet
                    $r = 2;
                    foreach($records as $record) {
                        $c = 0;
                        foreach ($fields as $item => $label) {
                            $c++;
                            $worksheet->setCellValueByColumnAndRow($c, $r, $record[$item])
                                ->getStyleByColumnAndRow($c, $r)
                                ->getFont()
                                ->setBold(false);
                            $worksheet->getColumnDimensionByColumn($c)->setAutoSize(true);
                        }
                        $worksheet->getRowDimension($r)->setCollapsed(false);

                        $r++;
                    }
                }
                // General Settings for saving
                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $spreadsheet->setActiveSheetIndex(0);
                // Redirect output to a clientвЂ™s web browser (Xlsx)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');
                // If you're serving to IE over SSL, then the following may be needed
                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header('Pragma: public'); // HTTP/1.0
                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
                $writer->save('php://output');
                exit();
            }
        }
    }
}
/*Export orders to xlsx end */

add_action('woocommerce_u_poshta_shipping_method', 'woocommerce_u_poshta_shipping_method');

function woocommerce_u_poshta_shipping_method($checkout) {
    global $wpdb;
    $areas = translateAreas($wpdb->get_results("SELECT * FROM wc_ukr_shipping_np_areas", ARRAY_A));
    $options = [];
    if ($areas) {
        foreach ($areas as $area) {
            $options[$area['ref']] = $area['description'];
        }
    }
    $defaultOption = '71508131-9b87-11de-822f-000c2965ae0e';
    define('WC_UKRPOSHTA_SHIPPING_NAME', 'ukrposhta_shipping');
    ?>
    <div id="<?= WC_UKRPOSHTA_SHIPPING_NAME; ?>_fields" class="wc-shipping-ukrposhta-fields">
        <div id="ukrposhta-poshta-shipping-info">
          <?php
          //Region
          woocommerce_form_field(WC_UKRPOSHTA_SHIPPING_NAME . '_area', [
            'type' => 'select',
            'options' => $options,
            'input_class' => [
              'wc-ukr-shipping-select'
            ],
            'label' => '',
            'default' => $defaultOption
          ]);

          //City
          woocommerce_form_field(WC_UKRPOSHTA_SHIPPING_NAME . '_city', [
            'type' => 'text',
            'input_class' => [
              'wc-ukr-shipping-text'
            ],
            'label' => '',
            'default' => '',
            'placeholder' => pll__('Введіть населений пункт'),
          ]);

          //Warehouse
          woocommerce_form_field(WC_UKRPOSHTA_SHIPPING_NAME . '_postalcode', [
            'type' => 'text',
            'input_class' => [
              'wc-ukr-shipping-text'
            ],
            'label' => '',
            'default' => '',
            'placeholder' => pll__('Введіть поштовий індекс'),
          ]);

          ?>
        </div>
    </div>
    <?php
}

add_action('woocommerce_checkout_process', 'woocommerce_u_poshta_shipping_method_validate_fields', 10, 2);

function woocommerce_u_poshta_shipping_method_validate_fields() {
    if ( ! defined('WC_UKRPOSHTA_SHIPPING_NAME')) {
        define('WC_UKRPOSHTA_SHIPPING_NAME', 'ukrposhta_shipping');
    }
    if (isset($_POST['shipping_method'])) {
        if (preg_match('/^u_poshta_shipping_method/i', $_POST['shipping_method'][0])) {

            if (( ! $_POST[WC_UKRPOSHTA_SHIPPING_NAME . '_area'] ||
                  ! $_POST[WC_UKRPOSHTA_SHIPPING_NAME . '_city'] ||
                  ! $_POST[WC_UKRPOSHTA_SHIPPING_NAME . '_postalcode']
                )) {
                wc_add_notice(pll__('Вкажіть всі дані відділення Укрпошти.'), 'error');
            }
        }
    }
}

add_action('woocommerce_checkout_create_order', 'woocommerce_u_poshta_shipping_method_create_order', 10, 2);

function woocommerce_u_poshta_shipping_method_create_order($order) {
    if ( ! defined('WC_UKRPOSHTA_SHIPPING_NAME')) {
        define('WC_UKRPOSHTA_SHIPPING_NAME', 'ukrposhta_shipping');
    }
    global $wpdb;
    if (isset($_POST['shipping_method'][0]) && preg_match('/^u_poshta_shipping_method/i', $_POST['shipping_method'][0])) {

        $order->set_shipping_address_1('');
        $order->set_billing_address_1('');
        $order->set_shipping_address_2('');
        $order->set_billing_address_2('');
        if (isset($_POST[WC_UKRPOSHTA_SHIPPING_NAME . '_area']) && $_POST[WC_UKRPOSHTA_SHIPPING_NAME . '_area']) {
            $npArea = $wpdb->get_row("SELECT description FROM wc_ukr_shipping_np_areas WHERE ref = '" . esc_attr($_POST[WC_UKRPOSHTA_SHIPPING_NAME . '_area']) . "'", ARRAY_A);
            if ($npArea) {
                $order->set_shipping_state($npArea['description']);
                $order->set_billing_state($npArea['description']);
            }
        }

        if (isset($_POST[WC_UKRPOSHTA_SHIPPING_NAME . '_city']) && $_POST[WC_UKRPOSHTA_SHIPPING_NAME . '_city']) {
            $city = sanitize_text_field(trim($_POST[WC_UKRPOSHTA_SHIPPING_NAME . '_city']));
            $order->set_shipping_city($city);
            $order->set_billing_city($city);
        }
        if (isset($_POST[WC_UKRPOSHTA_SHIPPING_NAME . '_postalcode']) && $_POST[WC_UKRPOSHTA_SHIPPING_NAME . '_postalcode']) {
            $postalcode = sanitize_text_field(trim($_POST[WC_UKRPOSHTA_SHIPPING_NAME . '_postalcode']));
            $order->set_shipping_postcode($postalcode);
            $order->set_billing_postcode($postalcode);
        }
    }

}

function translateAreas($areas)
{
    $areaTranslates = [
        '71508128-9b87-11de-822f-000c2965ae0e' => 'АРК',
        '71508129-9b87-11de-822f-000c2965ae0e' => 'Винницкая',
        '7150812a-9b87-11de-822f-000c2965ae0e' => 'Волынская',
        '7150812b-9b87-11de-822f-000c2965ae0e' => 'Днепропетровская',
        '7150812c-9b87-11de-822f-000c2965ae0e' => 'Донецкая',
        '7150812d-9b87-11de-822f-000c2965ae0e' => 'Житомирская',
        '7150812e-9b87-11de-822f-000c2965ae0e' => 'Закарпатская',
        '7150812f-9b87-11de-822f-000c2965ae0e' => 'Запорожская',
        '71508130-9b87-11de-822f-000c2965ae0e' => 'Ивано-Франковская',
        '71508131-9b87-11de-822f-000c2965ae0e' => 'Киевская',
        '71508132-9b87-11de-822f-000c2965ae0e' => 'Кировоградская',
        '71508133-9b87-11de-822f-000c2965ae0e' => 'Луганская',
        '71508134-9b87-11de-822f-000c2965ae0e' => 'Львовская',
        '71508135-9b87-11de-822f-000c2965ae0e' => 'Николаевская',
        '71508136-9b87-11de-822f-000c2965ae0e' => 'Одесская',
        '71508137-9b87-11de-822f-000c2965ae0e' => 'Полтавская',
        '71508138-9b87-11de-822f-000c2965ae0e' => 'Ровенская',
        '71508139-9b87-11de-822f-000c2965ae0e' => 'Сумская',
        '7150813a-9b87-11de-822f-000c2965ae0e' => 'Тернопольская',
        '7150813b-9b87-11de-822f-000c2965ae0e' => 'Харьковская',
        '7150813c-9b87-11de-822f-000c2965ae0e' => 'Херсонская',
        '7150813d-9b87-11de-822f-000c2965ae0e' => 'Хмельницкая',
        '7150813e-9b87-11de-822f-000c2965ae0e' => 'Черкасская',
        '7150813f-9b87-11de-822f-000c2965ae0e' => 'Черновицкая',
        '71508140-9b87-11de-822f-000c2965ae0e' => 'Черниговская'
    ];

    if (apply_filters('wc_ukr_shipping_language', get_option('wc_ukr_shipping_np_lang', 'ru')) === 'ru') {
        foreach ($areas as &$area) {
            if (isset($areaTranslates[ $area['ref'] ])) {
                $area['description'] = $areaTranslates[ $area['ref'] ];
            }
        }
    }

    return $areas;
}

/**
 * Custom fields
 */
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5e1ab7916d0ad',
        'title' => 'HEX Колір',
        'fields' => array(
            array(
                'key' => 'field_5e1ab7b8ccbb1',
                'label' => 'HEX Колір',
                'name' => 'hex_color',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'pa_kolory-modeli',
                ),
            ),
            array(
                array(
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'pa_kolory-systemy',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_5e19d0243314b',
        'title' => 'Додаткова ціна кольору системи',
        'fields' => array(
            array(
                'key' => 'field_5e19d0428e021',
                'label' => 'Додаткова ціна',
                'name' => 'additinal_price',
                'type' => 'number',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'pa_kolory-systemy',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_5e1d4a82df683',
        'title' => 'Опис - зображення',
        'fields' => array(
            array(
                'key' => 'field_5e1d4a9e11223',
                'label' => 'Опис - зображення',
                'name' => 'description_image',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'url',
                'preview_size' => 'full',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'side',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_5e19ca1068102',
        'title' => 'Розміри',
        'fields' => array(
            array(
                'key' => 'field_5e19ca2402c90',
                'label' => 'Стандартні розміри',
                'name' => 'standard_sizes',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5e19ca6c02c91',
                        'label' => 'Ширина',
                        'name' => 'width',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => 150,
                        'max' => 2800,
                        'step' => 1,
                    ),
                    array(
                        'key' => 'field_5e19cb808a856',
                        'label' => 'Висота',
                        'name' => 'height',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => 1000,
                        'max' => 2800,
                        'step' => 1,
                    ),
                    array(
                        'key' => 'field_5e19cb9e8a857',
                        'label' => 'Ціна',
                        'name' => 'price',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => 0,
                        'max' => '',
                        'step' => '',
                    ),
                ),
            ),
            array(
                'key' => 'field_5e19cbcb8a858',
                'label' => 'Нестандартні розміри',
                'name' => 'not_standard_sizes',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5e19cbed8a859',
                        'label' => 'Ширина',
                        'name' => 'width',
                        'type' => 'group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_5e19cc178a85a',
                                'label' => 'Мін. ширина',
                                'name' => 'min_width',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => 150,
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'min' => 150,
                                'max' => 2800,
                                'step' => 1,
                            ),
                            array(
                                'key' => 'field_5e19cc5d8a85b',
                                'label' => 'Макс. ширина',
                                'name' => 'max_width',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => 2800,
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'min' => 150,
                                'max' => 2800,
                                'step' => 1,
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_5e19cc9b8a85c',
                        'label' => 'Висота',
                        'name' => 'height',
                        'type' => 'group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_5e19ccb58a85d',
                                'label' => 'Мін. висота',
                                'name' => 'min_height',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => 1000,
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'min' => 1000,
                                'max' => 2800,
                                'step' => 1,
                            ),
                            array(
                                'key' => 'field_5e19cce78a85e',
                                'label' => 'Макс. висота',
                                'name' => 'max_height',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => 2800,
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'min' => 1000,
                                'max' => 2800,
                                'step' => 1,
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                ),
            ),
        ),
        'menu_order' => 100,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_5e802c38a9bab',
        'title' => 'Формула розрахунку',
        'fields' => array(
            array(
                'key' => 'field_5e802c4f5e344',
                'label' => 'Формула розрахунку',
                'name' => 'calculate_price_type',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'type1' => 'Формула 1 (Тканинні ролети)',
                    'type2' => 'Формула 2 (День-Ніч)',
                    'type3' => 'Формула 3 (Вертикальні жалюзі)',
                    'type4' => 'Формула 4 (Плісе)',
                    'type5' => 'Формула 5 (Тканинні ролети у коробі)',
                    'type6' => 'Формула 6 (День-Ніч у коробі)',
                ),
                'default_value' => array(
                ),
                'allow_null' => 1,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_5e802da85e345',
                'label' => 'Вартість короба',
                'name' => 'box_price',
                'type' => 'number',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_5e802c4f5e344',
                            'operator' => '==',
                            'value' => 'type5',
                        ),
                    ),
                    array(
                        array(
                            'field' => 'field_5e802c4f5e344',
                            'operator' => '==',
                            'value' => 'type6',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => 0,
                'max' => '',
                'step' => '',
            ),
            array(
                'key' => 'field_5e802ec55e347',
                'label' => 'Вартість механізму',
                'name' => 'mechanism_price_type_1',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_5e802c4f5e344',
                            'operator' => '==',
                            'value' => 'type1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5e802fa35e348',
                        'label' => 'Ширина менше 1250',
                        'name' => 'price_0_1250',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 48,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => 0,
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_5e802fea5e349',
                        'label' => 'Ширина від 1250 до 1800',
                        'name' => 'price_1250_1800',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 108,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => 0,
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_5e80301a5e34a',
                        'label' => 'Ширина від 1800 до 2800',
                        'name' => 'price_1800_2800',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 220,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => 0,
                        'max' => '',
                        'step' => '',
                    ),
                ),
            ),
            array(
                'key' => 'field_5e8030975e34b',
                'label' => 'Вартість механізму',
                'name' => 'mechanism_price_type_2',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_5e802c4f5e344',
                            'operator' => '==',
                            'value' => 'type2',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5e8030b85e34c',
                        'label' => 'Ширина менше 1250',
                        'name' => 'price_0_1250',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 0,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => 0,
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_5e8030e95e34d',
                        'label' => 'Ширина від 1250 до 1800',
                        'name' => 'price_1250_1800',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 115,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => 0,
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_5e8031f85e34e',
                        'label' => 'Ширина від 1800 до 2500',
                        'name' => 'price_1800_2500',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 170,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => 0,
                        'max' => '',
                        'step' => '',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));


endif;

/**
 * Translate string
 */
pll_register_string("Сталась помилка. Продукт не знайдено.", "Сталась помилка. Продукт не знайдено.");
pll_register_string("Ім'я не задано.", "Ім'я не задано.");
pll_register_string("Email не задано.", "Email не задано.");
pll_register_string("Відгук не задано.", "Відгук не задано.");
pll_register_string("Дякуємо за Ваш відгук.", "Дякуємо за Ваш відгук.");
pll_register_string("Сталась помилка, спробуйте пізніше.", "Сталась помилка, спробуйте пізніше.");
pll_register_string("Сталась помилка. Продукт не може бути доданий в корзину.", "Сталась помилка. Продукт не може бути доданий в корзину.");
pll_register_string("Сталась помилка. Продукт не може бути видалений.", "Сталась помилка. Продукт не може бути видалений.");
pll_register_string("Сталась помилка. Неможливо змінити кількість.", "Сталась помилка. Неможливо змінити кількість.");
pll_register_string("Кольори моделі", "Кольори моделі");
pll_register_string("Кількість", "Кількість");
pll_register_string("Обраний розмір", "Обраний розмір");
pll_register_string("Стандартні розміри", "Стандартні розміри");
pll_register_string("Ширина", "Ширина");
pll_register_string("Висота", "Висота");
pll_register_string("Сторона управління", "Сторона управління");
pll_register_string("Кольори системи", "Кольори системи");
pll_register_string("Інший розмір вікон", "Інший розмір вікон");
pll_register_string("Додати до корзини", "Додати до корзини");
pll_register_string("Немає в наявності", "Немає в наявності");
pll_register_string("Можливо вас зацікавлять", "Можливо вас зацікавлять");
pll_register_string("Опис", "Опис");
pll_register_string("Всі", "Всі");
pll_register_string("Ще немає відгуків.", "Ще немає відгуків.");
pll_register_string("Залишити відгук", "Залишити відгук");
pll_register_string("Ім’я", "Ім’я");
pll_register_string("Email", "Email");
pll_register_string("Відгук", "Відгук");
pll_register_string("Надіслати", "Надіслати");

pll_register_string("сторона управління", "сторона управління");
pll_register_string("ліва", "ліва");
pll_register_string("права", "права");
pll_register_string("колір системи", "колір системи");
pll_register_string("Колір системи", "Колір системи");
pll_register_string("чорний", "чорний");
pll_register_string("білий", "білий");
pll_register_string("До оплати", "До оплати");
pll_register_string("Особисті дані", "Особисті дані");
pll_register_string("Доставка", "Доставка");
pll_register_string("У вашій корзині", "У вашій корзині");

pll_register_string("Ім’я та прізвище", "Ім’я та прізвище");
pll_register_string("Місто / Село", "Місто / Село");
pll_register_string("Телефон", "Телефон");

pll_register_string("Самовивіз", "Самовивіз");
pll_register_string("Готівка при отриманні", "Готівка при отриманні");
pll_register_string("Прямий банківський переказ", "Прямий банківський переказ");
pll_register_string("Оплатити карткою Visa/Mastercard", "Оплатити карткою Visa/Mastercard");
pll_register_string("Спосіб доставки", "Спосіб доставки");
pll_register_string("Відгуки", "Відгуки");
pll_register_string("Вартість / шт.", "Вартість / шт.");
pll_register_string("Додати розмір", "Додати розмір");
pll_register_string("Виберіть колір моделі.", "Виберіть колір моделі.");
pll_register_string("Виберіть колір тканини", "Виберіть колір тканини");
pll_register_string("Замовити в 1 клік", "Замовити в 1 клік");
pll_register_string("Вам потрібно дати згоду", "Вам потрібно дати згоду");
pll_register_string("<strong>Опис</strong> - обов'язкове поле.", "<strong>Опис</strong> - обов'язкове поле.");
pll_register_string("<strong>Телефон</strong> - обов'язкове поле.", "<strong>Телефон</strong> - обов'язкове поле.");
pll_register_string("<strong>Ім’я та прізвище</strong> - обов'язкове поле.", "<strong>Ім’я та прізвище</strong> - обов'язкове поле.");
pll_register_string("<strong>Email</strong> - обов'язкове поле.", "<strong>Email</strong> - обов'язкове поле.");
pll_register_string("Дякуємо. Ваше замовлення було отримано.", "Дякуємо. Ваше замовлення було отримано.");
pll_register_string("Моя корзина", "Моя корзина");
pll_register_string("Продовжити покупки", "Продовжити покупки");
pll_register_string("Додатково", "Додатково");

pll_register_string("Інформація по замовленню:", "Інформація по замовленню:");
pll_register_string("фурнітура", "фурнітура");
pll_register_string("Сума замовлення:", "Сума замовлення:");
pll_register_string("Адреса:", "Адреса:");
pll_register_string("Отримувач:", "Отримувач:");
pll_register_string("Введіть населений пункт", "Введіть населений пункт");
pll_register_string("Введіть поштовий індекс", "Введіть поштовий індекс");
pll_register_string("Вкажіть відділення Укрпошти.", "Вкажіть відділення Укрпошти.Вкажіть відділення Укрпошти.");

pll_register_string("Оформити замовлення", "Оформити замовлення");
pll_register_string("Фільтри", "Фільтри");

// fix for checkout update localization
add_filter('woocommerce_ajax_get_endpoint',  function ($result, $request){
    return esc_url_raw( add_query_arg( 'wc-ajax', $request, remove_query_arg( array( 'remove_item', 'add-to-cart', 'added-to-cart' ) ) ) );
}, 10, 2);

/*if ($_SERVER["REMOTE_ADDR"] == '93.175.195.69') {
    test([pll__('Особисті дані'), pll_current_language()]);
}*/
/* CHANGES RELATED TO WC PRODUCTS END */

// filter to remove product-category from url
// and replace 'holovna' to '.' and permalink setting for 'base category url' field
/*add_filter('request', function( $vars ) {
    global $wpdb;

    if( ! empty( $vars['pagename'] ) || ! empty( $vars['category_name'] ) || ! empty( $vars['name'] ) || ! empty( $vars['attachment'] ) ) {
        $slug = ! empty( $vars['pagename'] ) ? $vars['pagename'] : ( ! empty( $vars['name'] ) ? $vars['name'] : ( !empty( $vars['category_name'] ) ? $vars['category_name'] : $vars['attachment'] ) );
        $exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s" ,array( $slug )));
        if( $exists ){
            $old_vars = $vars;
            $vars = array('product_cat' => $slug );
            if ( !empty( $old_vars['paged'] ) || !empty( $old_vars['page'] ) )
                $vars['paged'] = ! empty( $old_vars['paged'] ) ? $old_vars['paged'] : $old_vars['page'];
            if ( !empty( $old_vars['orderby'] ) )
                $vars['orderby'] = $old_vars['orderby'];
            if ( !empty( $old_vars['order'] ) )
                $vars['order'] = $old_vars['order'];
        }
    }
    return $vars;
});*/