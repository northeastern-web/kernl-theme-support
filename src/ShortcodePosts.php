<?php

namespace Kernl\Support\Theme;

class ShortcodePosts
{
    private $parameters;
    private $query_results;
    private $default_atts = [
        'author'                   => '',
        'author_name'              => '',
        'author__in'               => '',
        'author__not_in'           => '',
        'cache_results'            => true,
        'cat'                      => '',
        'category__and'            => '',
        'category__in'             => '',
        'category__not_in'         => '',
        'category_name'            => '',
        'fields'                   => '',
        'ignore_sticky_posts'      => 'false',
        'meta_compare'             => '',
        'meta_key'                 => '',
        'meta_query'               => '',
        'meta_value'               => '',
        'meta_value_num'           => '',
        'menu_order'               => '',
        'name'                     => '',
        'nopaging'                 => '',
        'offset'                   => 0,
        'order'                    => 'DESC',
        'orderby'                  => 'date',
        'p'                        => '',
        'page'                     => '',
        'paged'                    => '',
        'page_id'                  => '',
        'pagename'                 => '',
        'perm'                     => '',
        'post__in'                 => '',
        'post__not_in'             => '',
        'post_parent'              => '',
        'post_parent__in'          => '',
        'post_parent__not_in'      => '',
        'post_type'                => 'post',
        'post_status'              => 'publish',
        'posts_per_page'           => 1,
        'post_name__in'            => '',
        's'                        => '',
        'tag'                      => '',
        'tax_query'                => '',
        'title'                    => '',
        'update_post_meta_cache'   => '',
        'update_post_term_cache'   => '',
        'lazy_load_term_meta'      => '',
        'taxonomy'                 => false, // custom: for building tax_query
        'tax_terms'                => '',
        'tax_field'                => 'slug',
        'tax_operator'             => 'IN',
        'tax_include_children'     => true,
        'tax_relation'             => 'AND',
        'template'                 => '', // custom: path to file
        'column_class'             => '', // custom: class on column
        'component_class'          => '', // custom: class on component
        'wrapper_class'            => 'row', // custom: class to wrap column/component
        'hide_excerpt'             => false, // custom: boolean for exceprt
        'hide_badge'               => false, // custom: boolean for badge
        'hide_column'              => false, // custom: boolean to remove column wrapper
        'no_results'               => 'No posts found.', // custom: message if no posts returned
    ];

    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        $this->shortcodePosts();
    }

    /**
     * Shortcode grabbing posts based on WP_Query arguments passed
     * @return void add_shortcode()
     */
    protected function shortcodePosts()
    {
        add_shortcode('posts', function ($atts) {
            $this->parameters = shortcode_atts($this->default_atts, $atts);

            // build up arguements for WP_Query
            $args = [
                'author'                   => sanitize_text_field($this->parameters['author']),
                'author_name'              => sanitize_text_field($this->parameters['author_name']),
                'author__in'               => sanitize_text_field($this->parameters['author__in']),
                'author__not_in'           => sanitize_text_field($this->parameters['author__not_in']),
                'cache_results'            => sanitize_text_field($this->parameters['cache_results']),
                'cat'                      => sanitize_text_field($this->parameters['cat']),
                'category__and'            => sanitize_text_field($this->parameters['category__and']),
                'category__in'             => sanitize_text_field($this->parameters['category__in']),
                'category__not_in'         => sanitize_text_field($this->parameters['category__not_in']),
                'category_name'            => sanitize_text_field($this->parameters['category_name']),
                'fields'                   => sanitize_text_field($this->parameters['fields']),
                'ignore_sticky_posts'      => sanitize_text_field($this->parameters['ignore_sticky_posts']),
                'meta_compare'             => sanitize_text_field($this->parameters['meta_compare']),
                'meta_key'                 => sanitize_text_field($this->parameters['meta_key']),
                'meta_query'               => sanitize_text_field($this->parameters['meta_query']),
                'meta_value'               => sanitize_text_field($this->parameters['meta_value']),
                'meta_value_num'           => sanitize_text_field($this->parameters['meta_value_num']),
                'menu_order'               => sanitize_text_field($this->parameters['menu_order']),
                'name'                     => sanitize_text_field($this->parameters['name']),
                'nopaging'                 => sanitize_text_field($this->parameters['nopaging']),
                'offset'                   => sanitize_text_field($this->parameters['offset']),
                'order'                    => sanitize_text_field($this->parameters['order']),
                'orderby'                  => sanitize_text_field($this->parameters['orderby']),
                'p'                        => sanitize_text_field($this->parameters['p']),
                'page'                     => sanitize_text_field($this->parameters['page']),
                'paged'                    => sanitize_text_field($this->parameters['paged']),
                'page_id'                  => sanitize_text_field($this->parameters['page_id']),
                'pagename'                 => sanitize_text_field($this->parameters['pagename']),
                'perm'                     => sanitize_text_field($this->parameters['perm']),
                'post__in'                 => sanitize_text_field($this->parameters['post__in']),
                'post__not_in'             => sanitize_text_field($this->parameters['post__not_in']),
                'post_parent'              => sanitize_text_field($this->parameters['post_parent']),
                'post_parent__in'          => sanitize_text_field($this->parameters['post_parent__in']),
                'post_parent__not_in'      => sanitize_text_field($this->parameters['post_parent__not_in']),
                'post_type'                => sanitize_text_field($this->parameters['post_type']),
                'post_status'              => sanitize_text_field($this->parameters['post_status']),
                'posts_per_page'           => sanitize_text_field($this->parameters['posts_per_page']),
                'post_name__in'            => sanitize_text_field($this->parameters['post_name__in']),
                's'                        => sanitize_text_field($this->parameters['s']),
                'tag'                      => sanitize_text_field($this->parameters['tag']),
                'tax_query'                => sanitize_text_field($this->parameters['tax_query']),
                'title'                    => sanitize_text_field($this->parameters['title']),
                'update_post_meta_cache'   => sanitize_text_field($this->parameters['update_post_meta_cache']),
                'update_post_term_cache'   => sanitize_text_field($this->parameters['update_post_term_cache']),
                'lazy_load_term_meta'      => sanitize_text_field($this->parameters['lazy_load_term_meta']),
            ];

            // build out tax_query argument array if taxonomy param passed
            if ($this->parameters['taxonomy']) {
                if (strpos($this->parameters['taxonomy'], '|')) {
                    // if multiple taxonomy query
                    $taxonomies = explode('|', $this->parameters['taxonomy']);
                    $terms = explode('|', $this->parameters['tax_terms']);

                    // Begin loop through mulitple tax query
                    $segments = [];
                    $i = 0;
                    foreach ($taxonomies as $taxonomy) {
                        $segments[] = [
                            'taxonomy'          => sanitize_text_field($taxonomies[$i]),
                            'field'             => sanitize_text_field($this->parameters['tax_field']),
                            'terms'             => sanitize_text_field($terms[$i]),
                        ];
                        $i++;
                    }

                    // Build tax_query argument with segments
                    $args['tax_query'] = [
                        'relation' => 'AND',
                        $segments
                    ];
                } else {
                    // one taxonomy query
                    $args['tax_query'] = [
                        [
                            'taxonomy'          => sanitize_text_field($this->parameters['taxonomy']),
                            'field'             => sanitize_text_field($this->parameters['tax_field']),
                            'terms'             => sanitize_text_field($this->parameters['tax_terms']),
                            'operator'          => sanitize_text_field($this->parameters['tax_operator']),
                            'include_children'  => sanitize_text_field($this->parameters['tax_include_children']),
                        ]
                    ];
                }
            }

            // grab results of WP_Query
            $this->query_results = new \WP_Query($args);

            // return formatted ouput
            return $this->formatOutput();
        });
    }

    /**
     * Formats output as HTML in row/col
     * @returns string
     */
    private function formatOutput()
    {
        $output = '';

        if ($this->query_results->have_posts()) {
            while ($this->query_results->have_posts()) {
                $this->query_results->the_post();

                $data = [
                    'class' => $this->parameters['component_class'],
                    'hide_excerpt' => $this->parameters['hide_excerpt'],
                    'hide_badge' => $this->parameters['hide_badge'],
                ];

                // Conditional for column wrapper
                if ($this->parameters['hide_column']) {
                    $output .= Utility::getTemplate($this->parameters['template'], $data);
                } else {
                    $output .= '
                    <div class="col '. $this->parameters['column_class'] .'">
                        '. Utility::getTemplate($this->parameters['template'], $data) .'
                    </div>';
                }
            }
            wp_reset_postdata();

            return '
            <div class="'. $this->parameters['wrapper_class'] .'">
                '. $output .'
            </div>';
        }
        return '
        <div class="noposts">
            '. $this->parameters['no_results'] .'
        </div>';
    }
}
