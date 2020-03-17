<nav>
                <ul class="nostyle-list">

                    <?php if( function_exists('kama_breadcrumbs') ){
                        if (get_locale() == 'ru_RU') {
						 $myl10n = array(
                            'home'       => 'Главная',
                            'paged'      => 'Page %d',
                            '_404'       => 'Error 404',
                            'search'     => '<li>Результаты поиска - <b>%s</b></li>',
                            'author'     => 'Author archve: <b>%s</b>',
                            'year'       => 'Archive by <b>%d</b> год',
                            'month'      => 'Archive by: <b>%s</b>',
                            'day'        => '',
                            'attachment' => 'Media: %s',
                            'tag'        => 'Posts by tag: <b>%s</b>',
                            'tax_tag'    => '%1$s from "%2$s" by tag: <b>%3$s</b>',
                            // tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'. 
                            // Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
                        );
						} else {
                        $myl10n = array(
                            'home'       => 'Головна',
                            'paged'      => 'Page %d',
                            '_404'       => 'Error 404',
                            'search'     => '<li>Результати пошуку - <b>%s</b></li>',
                            'author'     => 'Author archve: <b>%s</b>',
                            'year'       => 'Archive by <b>%d</b> год',
                            'month'      => 'Archive by: <b>%s</b>',
                            'day'        => '',
                            'attachment' => 'Media: %s',
                            'tag'        => 'Posts by tag: <b>%s</b>',
                            'tax_tag'    => '%1$s from "%2$s" by tag: <b>%3$s</b>',
                            // tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'. 
                            // Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
                        );
                    }
                        kama_breadcrumbs('', $myl10n );

                        }?>
                </ul>

            </nav>