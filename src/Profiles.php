<?php

namespace Kernl;

class Profiles
{
    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        if (get_field('bool_profiles', 'option')) {
            $this->registerPostType();
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
            register_post_type('profile', [
                'labels'                => [
                    'name'                => __('Profiles'),
                    'singular_name'       => __('Profile'),
                    'add_new'             => __('Add Profile'),
                    'add_new_item'        => __('Add New Profile'),
                    'edit_item'           => __('Edit Profile'),
                ],
                'public'                => false,
                'has_archive'           => false,
                'rewrite'               => ['slug' => 'profile'],
                'supports'              => ['title', 'editor'],
                'taxonomies'            => [],
                'hierarchical'          => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 20,
                'menu_icon'             => 'dashicons-id-alt',
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => false,
                'can_export'            => true,
                'exclude_from_search'   => true,
                'publicly_queryable'    => true,
                'capability_type'       => 'post',
                'show_in_rest'          => true
            ]);

            // Custom Taxonomy
            register_taxonomy('profile-type', ['profile'], [
                'show_ui'         => true,
                'query_var'       => true,
                'public'          => true,
                'has_archive'     => true,
                'hierarchical'    => true,
                'show_in_rest'    => true,
                'rest_base'       => 'profile-type',
                'rewrite'         => [
                    'slug'          => 'profile-type',
                    'with_front'    => true,
                    'heirarchical'  => true
                ],
                'labels' => [
                    'name'                       => _x('Profile Types', 'taxonomy general name'),
                    'singular_name'              => _x('Profile Type', 'taxonomy singular name'),
                    'search_items'               => __('Search Types'),
                    'popular_items'              => __('Popular Types'),
                    'all_items'                  => __('All Types'),
                    'parent_item'                => null,
                    'parent_item_colon'          => null,
                    'edit_item'                  => __('Edit Type'),
                    'update_item'                => __('Update Type'),
                    'add_new_item'               => __('Add New Type'),
                    'new_item_name'              => __('New Type'),
                    'separate_items_with_commas' => __('Separate gallery tags with commas'),
                    'add_or_remove_items'        => __('Add or remove gallery tags'),
                    'choose_from_most_used'      => __('Choose from the most used gallery tags'),
                    'menu_name'                  => __('Profile Types'),
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
        add_action('init', function () {
            if (function_exists('acf_add_local_field_group')) {
                acf_add_local_field_group([
                    'key' => 'group_57eec1e5ec0c1',
                    'title' => '[post type] Profiles',
                    'fields' => [
                        [
                            'key' => 'field_58dbc7b37dd14',
                            'label' => 'Instructions',
                            'name' => '',
                            'type' => 'message',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ],
                            'message' => 'Fill in contact fields below. Post title should be "Last, First" name',
                            'new_lines' => 'wpautop',
                            'esc_html' => 0,
                        ],
                        [
                            'key' => 'field_58dbc4fd10a41',
                            'label' => 'First Name',
                            'name' => 'txt_fname',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '50',
                                'class' => '',
                                'id' => '',
                            ],
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ],
                        [
                            'key' => 'field_58dbc50a10a42',
                            'label' => 'Last Name',
                            'name' => 'txt_lname',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '50',
                                'class' => '',
                                'id' => '',
                            ],
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ],
                        [
                            'key' => 'field_58dbc58241d2f',
                            'label' => 'Title',
                            'name' => 'txt_title',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ],
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ],
                        [
                            'key' => 'field_58dbc58e41d30',
                            'label' => 'Email',
                            'name' => 'txt_email',
                            'type' => 'email',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '50',
                                'class' => '',
                                'id' => '',
                            ],
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                        ],
                        [
                            'key' => 'field_58dbc5b741d31',
                            'label' => 'Phone',
                            'name' => 'txt_phone',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '50',
                                'class' => '',
                                'id' => '',
                            ],
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ],
                        [
                            'key' => 'field_58dbc5fe41d32',
                            'label' => 'Headshot',
                            'name' => 'med_headshot',
                            'type' => 'image',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ],
                            'return_format' => 'array',
                            'preview_size' => 'thumbnail',
                            'library' => 'all',
                            'min_width' => '',
                            'min_height' => '',
                            'min_size' => '',
                            'max_width' => '500',
                            'max_height' => '500',
                            'max_size' => '',
                            'mime_types' => '',
                        ],
                    ],
                    'location' => [
                        [
                            [
                                'param' => 'post_type',
                                'operator' => '==',
                                'value' => 'profile',
                            ],
                        ],
                    ],
                    'menu_order' => 0,
                    'position' => 'acf_after_title',
                    'style' => 'seamless',
                    'label_placement' => 'top',
                    'instruction_placement' => 'label',
                    'hide_on_screen' => 'Config.php',
                    'active' => 1,
                    'description' => '',
                ]);
            }
        }, 20);
    }
}
