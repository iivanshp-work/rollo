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

function custom_find_matching_product_variation( $product, $match_attributes = array() ) {
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
    foreach ( $sorted_meta as $variation_id => $variation ) {
        $match = false;

        // Loop over the variation meta keys and values i.e. what is saved to the products. Note: $attribute_value is empty when 'any' is in use.
        foreach ( $variation as $attribute_key => $attribute_value ) {
            if ( array_key_exists( $attribute_key, $match_attributes ) && $match_attributes[ $attribute_key ] == $attribute_value ) {
                $match = true; // match
            }
        }

        if ( true === $match ) {
            return $variation_id;
        }
    }

    return 0;
}

function recalculate_product_price() {
    $hasError = false;
    $errorMessage = '';
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : 0;
    $product_attributes = isset($_POST['product_attribute']) ? $_POST['product_attribute'] : [];
    $attributes = [];

    $title = $image = '';
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

        $basePrice = $variant->get_price();
        $basePrice = calculate_product_price($variant->get_id());

        $sizesData = [
            'not_standard_sizes' => get_field('not_standard_sizes', $product->get_id()),
            'standard_sizes' => get_field('standard_sizes', $product->get_id()),
        ];
        $product_attributes['sizes'] = $sizesData;
        $price = calculatePrice($basePrice, $product_attributes);

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
        'title' => $title,
        'image' => $image
    ]);
    wp_die();
}
add_action('wp_ajax_recalculate_price', 'recalculate_product_price');
add_action('wp_ajax_nopriv_recalculate_price', 'recalculate_product_price');


function calculatePrice($basePrice = 0, $attributes = []) {
    $price = $basePrice;
    $additinalPriceAttributes = ['pa_kolory-systemy'];
    foreach($additinalPriceAttributes as $additinalPriceAttribute) {
        if (isset($attributes[$additinalPriceAttribute])) {
            $term_obj = get_term_by('slug', $attributes[$additinalPriceAttribute], $additinalPriceAttribute);
            $additinalPrice = get_field('additinal_price', $term_obj);
            $additinalPrice = $additinalPrice ? $additinalPrice : 0;
            $price += $additinalPrice;
        }
    }
    $width = isset($attributes['width']) ? $attributes['width'] : 0;
    $height = isset($attributes['height']) ? $attributes['height'] : 0;
    if (isset($attributes['sizes']['standard_sizes']) && !empty($attributes['sizes']['standard_sizes']) && is_array($attributes['sizes']['standard_sizes'])) {
        foreach($attributes['sizes']['standard_sizes'] as $size) {
            if (isset($size['price']) && isset($size['width']) && isset($size['height']) && $size['width'] == $width && $size['height'] == $height) {
                $price = $size['price'];
                return $price;
            }
        }
    }

    if ($width && $height) {
        $price = calculatePriceFunction($price, $width, $height);
    }
    return $price;
}

function calculatePriceFunction($price, $width, $height) {
    if ($width < 400) {
        $width = 400;
    }
    $price = $price * ($width/1000);
    if ($height > 2500) {
        $price = $price + (0.8 * $price);
    } else if ($height > 2300  && $height <= 2500) {
        $price = $price + (0.6 * $price);
    } else if ($height > 1750  && $height <= 2300) {
        $price = $price + (0.4 * $price);
    }

    if ($width > 1800) {
        $price += 250;
    } else if ($width > 1300  && $height <= 1800) {
        $price += 150;
    } else {
        $price += 75;
    }
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
        if (isset($product_attributes['pa_kolory-modeli'])) {
            $attributes['attribute_pa_kolory-modeli'] = $product_attributes['pa_kolory-modeli'];
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
        $basePrice = $variant->get_price();
        $basePrice = calculate_product_price($variant->get_id());

        $sizesData = [
            'not_standard_sizes' => get_field('not_standard_sizes', $product->get_id()),
            'standard_sizes' => get_field('standard_sizes', $product->get_id()),
        ];
        $product_attributes['sizes'] = $sizesData;
        $price = calculatePrice($basePrice, $product_attributes);

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
    echo json_encode([
        'has_error' => false,
        'redirect_link' => esc_url((pll_current_language() == 'uk' ? '' : '/ru') . '/checkout/'),
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
    $html .= '</p>';
    echo $html;
}
add_action( 'woocommerce_product_after_variable_attributes', 'variation_settings_fields', 10, 3 );

/**
 * Save new fields for variations
 *
 */
function save_variation_settings_fields( $post_id ) {
    $text_field = $_POST['_mini_image'][ $post_id ];
    test($_REQUEST);
    if( ! empty( $text_field ) ) {
        update_post_meta( $post_id, '_mini_image', esc_attr( $text_field ) );
    }
}
add_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );


function load_variation_settings_fields( $variations ) {
    $variations['_mini_image'] = get_post_meta( $variations[ 'variation_id' ], '_mini_image', true );
    return $variations;
}
add_filter( 'woocommerce_available_variation', 'load_variation_settings_fields' );

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

// fix for checkout update localization
add_filter('woocommerce_ajax_get_endpoint',  function ($result, $request){
    return esc_url_raw( add_query_arg( 'wc-ajax', $request, remove_query_arg( array( 'remove_item', 'add-to-cart', 'added-to-cart' ) ) ) );
}, 10, 2);

/*if ($_SERVER["REMOTE_ADDR"] == '93.175.195.69') {
    test([pll__('Особисті дані'), pll_current_language()]);
}*/
/*global $_wp_additional_image_sizes;
print '<pre>';
test( get_intermediate_image_sizes() );
print '</pre>';*/
/* CHANGES RELATED TO WC PRODUCTS END */
