<?php

namespace Kernl\Lib;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Modules
{
    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        if (get_field('bool_modules', 'option')) {
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
            register_post_type('module', [
                'labels'                => [
                    'name'                => __('Modules'),
                    'singular_name'       => __('Module'),
                    'add_new'             => __('Add Module'),
                    'add_new_item'        => __('Add New Module'),
                    'edit_item'           => __('Edit Module'),
                ],
                'public'                => false,
                'has_archive'           => 'modules',
                'rewrite'               => ['slug' => 'module'],
                'supports'              => ['title'],
                'taxonomies'            => [],
                'hierarchical'          => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 20,
                'menu_icon'             => 'dashicons-tagcloud',
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => false,
                'can_export'            => true,
                'exclude_from_search'   => true,
                'publicly_queryable'    => false,
                'capability_type'       => 'post'
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
            $field_gallery = new FieldsBuilder('gallery');
            $field_gallery
                ->addText('txt_gallery_columns', ['label' => 'Column Class', 'placeholder' => 'defaults to w--1/2 w--1/3@d'])
                ->addGallery('lay_gallery', ['label' => 'Images'])
                ->addWysiwyg('txt_gallery', ['label' => 'Gallery Description']);

            $field_carousel = new FieldsBuilder('carousel');
            $field_carousel
                ->addSelect('opt_options', ['label' => 'Options', 'multiple' => true, 'ui' => true])
                    ->addChoice('"autoAdvance":"true"', 'Auto advance')
                    ->addChoice('"infinite":"true"', 'Infinite loop')
                    ->addChoice('"controls":"true"', 'Add controls')
                    ->addChoice('"autoHeight":"true"', 'Adjust to visible item heights')
                    ->addChoice('"matchHeight":"true"', 'Match item heights')
                    ->addChoice('"pagination":"false"', 'Remove pagination')
                ->addRepeater('lay_carousel', [
                    'label' => 'Carousel items',
                    'min' => 2,
                    'button_label' => 'Add carousel',
                    'layout' => 'block',
                ])
                    ->addText('txt_class', ['label' => 'Class'])
                    ->addWysiwyg('txt_copy', ['label' => 'Copy']);

            $field_code = new FieldsBuilder('code');
            $field_code
                ->addMessage('NOTE', '<b>Do not</b> add opening and closing tags for PHP (<code>&lt;? ... ?&gt;</code>) or JavaScript (<code><script> .... </script></code>). They are already in place.')
                ->addRadio('opt_type', ['label' => 'Type'])
                    ->addChoice('php', 'PHP')
                    ->addChoice('js', 'JavaScript')
                ->addTextarea('txt_code', ['label' => 'Code', 'rows' => 50, 'class' => 'kernl--code']);

            $build_modules = new FieldsBuilder('build_modules', [
                'position' => 'normal',
                'style' => 'seamless'
            ]);

            $build_modules->addFlexibleContent('lay_module', [
                'label' => '',
                'button_label' => 'Select a module',
                'min' => 0,
                'max' => 1,
            ])
                ->addLayout('gallery')
                    ->addFields($field_gallery)
                ->addLayout('carousel')
                    ->addFields($field_carousel)
                ->addLayout('code')
                    ->addFields($field_code)
                ->setLocation('post_type', '==', 'module');

            acf_add_local_field_group($build_modules->build());
        });
    }
}
