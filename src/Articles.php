<?php

namespace Kernl\Lib;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Articles
{
    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        if (get_field('bool_articles', 'option')) {
            $this->registerPostType();
            $this->registerTaxonomies();
            $this->defineFields();
        }
    }

    /**
     * Register custom post types
     * @return void
     */
    protected function registerPostType()
    {
        add_action('init', function () {
            // Custom Post Type
            register_post_type('article', [
                'labels'                => [
                    'name'                => __('Articles'),
                    'singular_name'       => __('Article'),
                    'add_new'             => __('Add Article'),
                    'add_new_item'        => __('Add New Article'),
                    'edit_item'           => __('Edit Article'),
                ],
                'public'                => true,
                'has_archive'           => 'articles',
                'rewrite'               => ['slug' => 'article'],
                'supports'              => ['title', 'excerpt', 'thumbnail'],
                'taxonomies'            => [],
                'hierarchical'          => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'menu_icon'             => 'dashicons-media-document',
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'post',
                'show_in_rest'          => true
            ]);
        });
    }

    /**
     * Register custom taxonomies
     * @return void
     */
    protected function registerTaxonomies()
    {
        add_action('init', function () {
            register_taxonomy('group', 'article', [
                'meta_box_cb'     => false,
                'show_ui'         => true,
                'query_var'       => true,
                'public'          => true,
                'has_archive'     => true,
                'hierarchical'    => true,
                'show_in_rest'    => true,
                'rest_base'       => 'group',
                'rewrite'         => [
                    'slug'          => 'group',
                    'with_front'    => true,
                    'heirarchical'  => true
                ],
                'labels' => [
                    'name'                       => _x('Groups', 'taxonomy general name'),
                    'singular_name'              => _x('Group', 'taxonomy singular name'),
                    'search_items'               => __('Search Groups'),
                    'popular_items'              => __('Popular Groups'),
                    'all_items'                  => __('All Groups'),
                    'parent_item'                => null,
                    'parent_item_colon'          => null,
                    'edit_item'                  => __('Edit Group'),
                    'update_item'                => __('Update Group'),
                    'add_new_item'               => __('Add New Group'),
                    'new_item_name'              => __('New Group'),
                    'separate_items_with_commas' => __('Separate group tags with commas'),
                    'add_or_remove_items'        => __('Add or remove group tags'),
                    'choose_from_most_used'      => __('Choose from the most used group tags'),
                    'menu_name'                  => __('Groups'),
                ]
            ]);

            register_taxonomy('audience', 'article', [
                'meta_box_cb'     => false,
                'show_ui'         => true,
                'query_var'       => true,
                'public'          => true,
                'has_archive'     => true,
                'hierarchical'    => true,
                'show_in_rest'    => true,
                'rest_base'       => 'audience',
                'rewrite'         => [
                    'slug'          => 'audience',
                    'with_front'    => true,
                    'heirarchical'  => true
                ],
                'labels' => [
                    'name'                       => _x('Audiences', 'taxonomy general name'),
                    'singular_name'              => _x('Audience', 'taxonomy singular name'),
                    'search_items'               => __('Search Audiences'),
                    'popular_items'              => __('Popular Audiences'),
                    'all_items'                  => __('All Audiences'),
                    'parent_item'                => null,
                    'parent_item_colon'          => null,
                    'edit_item'                  => __('Edit Audience'),
                    'update_item'                => __('Update Audience'),
                    'add_new_item'               => __('Add New Audience'),
                    'new_item_name'              => __('New Audience'),
                    'separate_items_with_commas' => __('Separate audience tags with commas'),
                    'add_or_remove_items'        => __('Add or remove audience tags'),
                    'choose_from_most_used'      => __('Choose from the most used audience tags'),
                    'menu_name'                  => __('Audiences'),
                ]
            ]);

            register_taxonomy('collection', 'article', [
                'meta_box_cb'     => false,
                'show_ui'         => true,
                'query_var'       => true,
                'public'          => true,
                'has_archive'     => true,
                'hierarchical'    => true,
                'show_in_rest'    => true,
                'rest_base'       => 'collection',
                'rewrite'         => [
                    'slug'          => 'collections',
                    'with_front'    => true,
                    'heirarchical'  => true
                ],
                'labels' => [
                    'name'                       => _x('Collections', 'taxonomy general name'),
                    'singular_name'              => _x('Collection', 'taxonomy singular name'),
                    'search_items'               => __('Search Collections'),
                    'popular_items'              => __('Popular Collections'),
                    'all_items'                  => __('All Collections'),
                    'parent_item'                => null,
                    'parent_item_colon'          => null,
                    'edit_item'                  => __('Edit Collection'),
                    'update_item'                => __('Update Collection'),
                    'add_new_item'               => __('Add New Collection'),
                    'new_item_name'              => __('New Collection'),
                    'separate_items_with_commas' => __('Separate article tags with commas'),
                    'add_or_remove_items'        => __('Add or remove article tags'),
                    'choose_from_most_used'      => __('Choose from the most used article tags'),
                    'menu_name'                  => __('Collections'),
                ]
            ]);
        });
    }

    /**
     * Register ACF custom fields
     * @return void
     */
    protected function defineFields()
    {
        add_action('wp_loaded', function () {
            // --
            // TAXONOMIES
            $tax_group = new FieldsBuilder('group');
            $tax_group->addTaxonomy('rel_group', [
                'label' => 'Group Taxonomy',
                'instructions' => 'Assign this article to a group.',
                'required' => 0,
                'wrapper' => [
                    'width' => '33',
                    'class' => '',
                    'id' => ''
                ],
                'taxonomy' => 'group',
                'field_type' => 'select',
                'allow_null' => 1,
                'add_term' => 0,
                'save_terms' => 1,
                'load_terms' => 1,
                'return_format' => 'object',
                'multiple' => 0
            ]);

            $tax_audience = new FieldsBuilder('audience');
            $tax_audience->addTaxonomy('rel_audience', [
                'label' => 'Audience Taxonomy',
                'instructions' => 'Select the target audience.',
                'required' => 0,
                'wrapper' => [
                    'width' => '33',
                    'class' => '',
                    'id' => ''
                ],
                'taxonomy' => 'audience',
                'field_type' => 'multi_select',
                'allow_null' => 0,
                'add_term' => 0,
                'save_terms' => 1,
                'load_terms' => 1,
                'return_format' => 'object',
                'multiple' => 1
            ]);

            $tax_collection = new FieldsBuilder('collection');
            $tax_collection->addTaxonomy('rel_collection', [
                'label' => 'Collections',
                'instructions' => 'Assign custom collection taxonomies.',
                'required' => 0,
                'wrapper' => [
                    'width' => '33',
                    'class' => '',
                    'id' => ''
                ],
                'taxonomy' => 'collection',
                'field_type' => 'multi_select',
                'allow_null' => 0,
                'add_term' => 0,
                'save_terms' => 1,
                'load_terms' => 1,
                'return_format' => 'object',
                'multiple' => 1
            ]);

            $build_taxonomies = new FieldsBuilder('build_taxonomies', [
                'title' => 'Article Taxonomies',
                'style' => 'seamless',
                'position' => 'acf_after_title',
            ]);
            $build_taxonomies
                ->addFields($tax_group)
                ->addFields($tax_audience)
                ->addFields($tax_collection)
                ->setLocation('post_type', '==', 'article');
            acf_add_local_field_group($build_taxonomies->build());

            // --
            // RELATED ARTICLES
            $rel_related = new FieldsBuilder('related');
            $rel_related->addRelationship('rel_related', [
                'label' => 'Related Articles',
                'required' => 0,
                'type' => 'post_object',
                'post_type' => ['article'],
                'taxonomy' => [],
                'filters' => [
                    0 => 'search'
                ],
                'elements' => '',
                'allow_null' => 0,
                'add_term' => 0,
                'save_terms' => 1,
                'load_terms' => 1,
                'return_format' => 'object',
                'multiple' => 1
            ]);

            // --
            // Build the related articles group
            $build_rel_related = new FieldsBuilder('build_related', [
                'title' => 'Related Articles',
                'position' => 'side',
            ]);
            $build_rel_related
                ->addFields($rel_related)
                ->setLocation('post_type', '==', 'article');
            acf_add_local_field_group($build_rel_related->build());

            // --
            // ARTICLE ACTIONS
            $lay_actions = new FieldsBuilder('actions');
            $lay_actions->addRepeater('lay_actions_group', [
                    'label' => 'Action Group',
                    'instructions' => 'Add links to external webpages or documents to appear alongside this article.',
                    'layout' => 'block'
                ])->addText('txt_group_title', [
                        'label' => 'Group Title',
                        'default_value' => 'Important Actions',
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => ''
                        ],
                    ])
                ->addRepeater('lay_actions', [
                        'label' => 'Action',
                        'instructions' => 'Add links to external webpages or documents to appear alongside this article.',
                        'layout' => 'block'
                    ])
                    ->addText('txt_title', [
                        'label' => 'Link Title',
                        'wrapper' => [
                            'width' => '40',
                            'class' => '',
                            'id' => ''
                        ],
                    ])
                    ->addRadio('opt_type', [
                        'label' => 'Type',
                        'wrapper' => [
                            'width' => '20',
                            'class' => '',
                            'id' => ''
                        ],
                        'choices' => ['File', 'URL'],
                        'return_format' => 'value',
                        'layout' => 'horizontal'
                    ])
                    ->addFile('med_file', [
                        'label' => 'File',
                        'instructions' => '',
                        'wrapper' => [
                            'width' => '40',
                            'class' => '',
                            'id' => ''
                        ],
                        'required' => 0,
                        'return_format' => 'array',
                        'library' => 'all',
                        'min_size' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ])->conditional('opt_type', '==', 'File')
                    ->addUrl('txt_url', [
                        'label' => 'URL',
                        'wrapper' => [
                            'width' => '40',
                            'class' => '',
                            'id' => ''
                        ],
                        'default_value' => '',
                        'placeholder' => 'https://',
                    ])->conditional('opt_type', '==', 'URL');

            // --
            // Build the article actions group
            $build_lay_actions = new FieldsBuilder('build_actions', [
                'title' => 'Article Actions',
                'position' => 'normal',
            ]);
            $build_lay_actions
                ->addFields($lay_actions)
                    ->setLocation('post_type', '==', 'article');

            acf_add_local_field_group($build_lay_actions->build());

            // --
            // ARTICLE ARCHIVE ADSPACE
            $lay_adspace = new FieldsBuilder('adspace', [
                'title' => 'Adspace'
            ]);
            $lay_adspace->addWysiwyg('txt_adspace', ['label' => 'Adspace Content'])
                ->setLocation('taxonomy', '==', 'group')
                    ->or('taxonomy', '==', 'audience')
                    ->or('taxonomy', '==', 'collection');

            acf_add_local_field_group($lay_adspace->build());
        });
    }
}
