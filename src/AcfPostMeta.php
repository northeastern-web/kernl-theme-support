<?php

namespace Kernl\Lib;

use StoutLogic\AcfBuilder\FieldsBuilder;

class AcfPostMeta
{
    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        $this->defineFields();
    }

    /**
     * Defines ACF fields
     * @return void
     */
    protected function defineFields()
    {
        add_action('wp_loaded', function () {
            // Boolean for News@NU
            $field_nunews = new FieldsBuilder('nunews');
            $field_nunews
                ->addTrueFalse('bool_nunews', ['label' => 'Is News@Northeastern article?', 'wrapper' => ['width' => '20'], 'ui' => true]);

            // Boolean for author
            $field_hide_author = new FieldsBuilder('hide_author');
            $field_hide_author->addTrueFalse('bool_hide_author', ['label' => 'Hide Author on Post', 'wrapper' => ['width' => '20'], 'ui' => true]);

            // Boolean to show author
            $field_override_author = new FieldsBuilder('override_author');
            $field_override_author->addTrueFalse('bool_override_author', ['label' => 'Override Author', 'wrapper' => ['width' => '20'], 'ui' => true])
                ->conditional('bool_hide_author', '!=', '1')
                    ->or('bool_nunews', '!=', '1');

            // Text field for author name
            $field_author = new FieldsBuilder('author');
            $field_author
                ->addText('txt_author', ['label' => 'Author Full Name', 'wrapper' => ['width' => '50']])
                    ->conditional('bool_nunews', '==', '1')
                        ->or('bool_override_author', '==', '1');

            // External URL field
            $field_external_url = new FieldsBuilder('external_url');
            $field_external_url
                ->addText('txt_external_url', ['label' => 'External URL', 'wrapper' => ['width' => '50']])
                    ->conditional('bool_nunews', '==', '1');

            // Boolean for hide/show date
            $field_date = new FieldsBuilder('date');
            $field_date
                ->addTrueFalse('bool_date', ['label' => 'Show Date?', 'wrapper' => ['width' => '20'], 'ui' => true]);

            // --
            // Build the post meta group
            $builder = new FieldsBuilder('builder', [
                'title' => 'Post Meta'
            ]);
            $builder
                ->addFields($field_hide_author)
                ->addFields($field_nunews)
                ->addFields($field_override_author)
                ->addFields($field_author)
                ->addFields($field_external_url)
                ->addFields($field_date)
                    ->setLocation('post_type', '==', 'post');

            acf_add_local_field_group($builder->build());
        });
    }
}
