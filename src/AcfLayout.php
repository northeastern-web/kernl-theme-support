<?php

namespace Kernl\Support\Theme;

use StoutLogic\AcfBuilder\FieldsBuilder;

class AcfLayout
{
    // kernl(ui) column width options
    protected $column_options = [
        ['measure'   => 'width: measure'],
        ['measure--narrow' => 'width: measure narrow'],
        ['measure--wide' => 'width: measure wide'],
        ['w--auto'   => 'width: auto'],
        ['w--auto@t' => 'width: auto@t'],
        ['w--auto@d' => 'width: auto@d'],
        ['w--auto@w' => 'width: auto@w'],
        ['w--fit'    => 'width: fit'],
        ['w--fit@t'  => 'width: fit@t'],
        ['w--fit@d'  => 'width: fit@d'],
        ['w--fit@w'  => 'width: fit@w'],
        ['w--10'     => 'width: 10'],
        ['w--10@t'   => 'width: 10@t'],
        ['w--10@d'   => 'width: 10@d'],
        ['w--10@w'   => 'width: 10@w'],
        ['w--20'     => 'width: 20'],
        ['w--20@t'   => 'width: 20@t'],
        ['w--20@d'   => 'width: 20@d'],
        ['w--20@w'   => 'width: 20@w'],
        ['w--25'     => 'width: 25'],
        ['w--25@t'   => 'width: 25@t'],
        ['w--25@d'   => 'width: 25@d'],
        ['w--25@w'   => 'width: 25@w'],
        ['w--30'     => 'width: 30'],
        ['w--30@t'   => 'width: 30@t'],
        ['w--30@d'   => 'width: 30@d'],
        ['w--30@w'   => 'width: 30@w'],
        ['w--40'     => 'width: 40'],
        ['w--40@t'   => 'width: 40@t'],
        ['w--40@d'   => 'width: 40@d'],
        ['w--40@w'   => 'width: 40@w'],
        ['w--50'     => 'width: 50'],
        ['w--50@t'   => 'width: 50@t'],
        ['w--50@d'   => 'width: 50@d'],
        ['w--50@w'   => 'width: 50@w'],
        ['w--60'     => 'width: 60'],
        ['w--60@t'   => 'width: 60@t'],
        ['w--60@d'   => 'width: 60@d'],
        ['w--60@w'   => 'width: 60@w'],
        ['w--70'     => 'width: 70'],
        ['w--70@t'   => 'width: 70@t'],
        ['w--70@d'   => 'width: 70@d'],
        ['w--70@w'   => 'width: 70@w'],
        ['w--75'     => 'width: 75'],
        ['w--75@t'   => 'width: 75@t'],
        ['w--75@d'   => 'width: 75@d'],
        ['w--75@w'   => 'width: 75@w'],
        ['w--80'     => 'width: 80'],
        ['w--80@t'   => 'width: 80@t'],
        ['w--80@d'   => 'width: 80@d'],
        ['w--80@w'   => 'width: 80@w'],
        ['w--90'     => 'width: 90'],
        ['w--90@t'   => 'width: 90@t'],
        ['w--90@d'   => 'width: 90@d'],
        ['w--90@w'   => 'width: 90@w'],
        ['w--100'    => 'width: 100'],
        ['w--100@t'  => 'width: 100@t'],
        ['w--100@d'  => 'width: 100@d'],
        ['w--100@w'  => 'width: 100@w'],
        ['w--1/3'    => 'width: 1/3'],
        ['w--1/3@t'  => 'width: 1/3@t'],
        ['w--1/3@d'  => 'width: 1/3@d'],
        ['w--1/3@w'  => 'width: 1/3@w'],
        ['w--2/3'    => 'width: 2/3'],
        ['w--2/3@t'  => 'width: 2/3@t'],
        ['w--2/3@d'  => 'width: 2/3@d'],
        ['w--2/3@w'  => 'width: 2/3@w'],
        ['w--1/4'    => 'width: 1/4'],
        ['w--1/4@t'  => 'width: 1/4@t'],
        ['w--1/4@d'  => 'width: 1/4@d'],
        ['w--1/4@w'  => 'width: 1/4@w'],
        ['w--1/2'    => 'width: 1/2'],
        ['w--1/2@t'  => 'width: 1/2@t'],
        ['w--1/2@d'  => 'width: 1/2@d'],
        ['w--1/2@w'  => 'width: 1/2@w'],
        ['w--3/4'    => 'width: 3/4'],
        ['w--3/4@t'  => 'width: 3/4@t'],
        ['w--3/4@d'  => 'width: 3/4@d'],
        ['w--3/4@w'  => 'width: 3/4@w'],
        ['w--1/6'    => 'width: 1/6'],
        ['w--1/6@t'  => 'width: 1/6@t'],
        ['w--1/6@d'  => 'width: 1/6@d'],
        ['w--1/6@w'  => 'width: 1/6@w'],
        ['w--5/6'    => 'width: 5/6'],
        ['w--5/6@t'  => 'width: 5/6@t'],
        ['w--5/6@d'  => 'width: 5/6@d'],
        ['w--5/6@w'  => 'width: 5/6@w']
    ];

    // kernl(ui) grid options
    protected $column_pos_options = [
        // margin
        ['ml--0'     => 'offset: 0 (reset)'],
        ['ml--0@t'   => 'offset: 0@t (reset)'],
        ['ml--0@d'   => 'offset: 0@d (reset)'],
        ['ml--0@w'   => 'offset: 0@w (reset)'],
        ['mx--auto'   => 'center column'],
        ['mx--auto@t'   => 'center column @t'],
        ['mx--auto@d'   => 'center column @d'],
        ['mx--auto@w'   => 'center column @w'],

        // order
        ['order--0'   => 'order: 0'],
        ['order--0@t' => 'order: 0@t'],
        ['order--0@d' => 'order: 0@d'],
        ['order--0@w' => 'order: 0@w'],
        ['order--1'   => 'order: 1'],
        ['order--1@t' => 'order: 1@t'],
        ['order--1@d' => 'order: 1@d'],
        ['order--1@w' => 'order: 1@w'],
        ['order--2'   => 'order: 2'],
        ['order--2@t' => 'order: 2@t'],
        ['order--2@d' => 'order: 2@d'],
        ['order--2@w' => 'order: 2@w'],
        ['order--3'   => 'order: 3'],
        ['order--3@t' => 'order: 3@t'],
        ['order--3@d' => 'order: 3@d'],
        ['order--3@w' => 'order: 3@w'],
        ['order--4'   => 'order: 4'],
        ['order--4@t' => 'order: 4@t'],
        ['order--4@d' => 'order: 4@d'],
        ['order--4@w' => 'order: 4@w'],
        ['order--5'   => 'order: 5'],
        ['order--5@t' => 'order: 5@t'],
        ['order--5@d' => 'order: 5@d'],
        ['order--5@w' => 'order: 5@w'],
        ['order--6'   => 'order: 6'],
        ['order--6@t' => 'order: 6@t'],
        ['order--6@d' => 'order: 6@d'],
        ['order--6@w' => 'order: 6@w'],
        ['order--7'   => 'order: 7'],
        ['order--7@t' => 'order: 7@t'],
        ['order--7@d' => 'order: 7@d'],
        ['order--7@w' => 'order: 7@w'],
        ['order--8'   => 'order: 8'],
        ['order--8@t' => 'order: 8@t'],
        ['order--8@d' => 'order: 8@d'],
        ['order--8@w' => 'order: 8@w'],
        ['order--9'   => 'order: 9'],
        ['order--9@t' => 'order: 9@t'],
        ['order--9@d' => 'order: 9@d'],
        ['order--9@w' => 'order: 9@w'],

        // offset margin left
        ['ow--10'    => 'offset: 10'],
        ['ow--10@t'  => 'offset: 10@t'],
        ['ow--10@d'  => 'offset: 10@d'],
        ['ow--10@w'  => 'offset: 10@w'],
        ['ow--20'    => 'offset: 20'],
        ['ow--20@t'  => 'offset: 20@t'],
        ['ow--20@d'  => 'offset: 20@d'],
        ['ow--20@w'  => 'offset: 20@w'],
        ['ow--25'    => 'offset: 25'],
        ['ow--25@t'  => 'offset: 25@t'],
        ['ow--25@d'  => 'offset: 25@d'],
        ['ow--25@w'  => 'offset: 25@w'],
        ['ow--30'    => 'offset: 30'],
        ['ow--30@t'  => 'offset: 30@t'],
        ['ow--30@d'  => 'offset: 30@d'],
        ['ow--30@w'  => 'offset: 30@w'],
        ['ow--40'    => 'offset: 40'],
        ['ow--40@t'  => 'offset: 40@t'],
        ['ow--40@d'  => 'offset: 40@d'],
        ['ow--40@w'  => 'offset: 40@w'],
        ['ow--50'    => 'offset: 50'],
        ['ow--50@t'  => 'offset: 50@t'],
        ['ow--50@d'  => 'offset: 50@d'],
        ['ow--50@w'  => 'offset: 50@w'],
        ['ow--60'    => 'offset: 60'],
        ['ow--60@t'  => 'offset: 60@t'],
        ['ow--60@d'  => 'offset: 60@d'],
        ['ow--60@w'  => 'offset: 60@w'],
        ['ow--70'    => 'offset: 70'],
        ['ow--70@t'  => 'offset: 70@t'],
        ['ow--70@d'  => 'offset: 70@d'],
        ['ow--70@w'  => 'offset: 70@w'],
        ['ow--75'    => 'offset: 75'],
        ['ow--75@t'  => 'offset: 75@t'],
        ['ow--75@d'  => 'offset: 75@d'],
        ['ow--75@w'  => 'offset: 75@w'],
        ['ow--80'    => 'offset: 80'],
        ['ow--80@t'  => 'offset: 80@t'],
        ['ow--80@d'  => 'offset: 80@d'],
        ['ow--80@w'  => 'offset: 80@w'],
        ['ow--90'    => 'offset: 90'],
        ['ow--90@t'  => 'offset: 90@t'],
        ['ow--90@d'  => 'offset: 90@d'],
        ['ow--90@w'  => 'offset: 90@w'],
        ['ow--1/3'   => 'offset: 1/3'],
        ['ow--1/3@t' => 'offset: 1/3@t'],
        ['ow--1/3@d' => 'offset: 1/3@d'],
        ['ow--1/3@w' => 'offset: 1/3@w'],
        ['ow--2/3'   => 'offset: 2/3'],
        ['ow--2/3@t' => 'offset: 2/3@t'],
        ['ow--2/3@d' => 'offset: 2/3@d'],
        ['ow--2/3@w' => 'offset: 2/3@w'],
        ['ow--1/4'   => 'offset: 1/4'],
        ['ow--1/4@t' => 'offset: 1/4@t'],
        ['ow--1/4@d' => 'offset: 1/4@d'],
        ['ow--1/4@w' => 'offset: 1/4@w'],
        ['ow--1/2'   => 'offset: 1/2'],
        ['ow--1/2@t' => 'offset: 1/2@t'],
        ['ow--1/2@d' => 'offset: 1/2@d'],
        ['ow--1/2@w' => 'offset: 1/2@w'],
        ['ow--3/4'   => 'offset: 3/4'],
        ['ow--3/4@t' => 'offset: 3/4@t'],
        ['ow--3/4@d' => 'offset: 3/4@d'],
        ['ow--3/4@w' => 'offset: 3/4@w'],
        ['ow--1/6'   => 'offset: 1/6'],
        ['ow--1/6@t' => 'offset: 1/6@t'],
        ['ow--1/6@d' => 'offset: 1/6@d'],
        ['ow--1/6@w' => 'offset: 1/6@w'],
        ['ow--5/6'   => 'offset: 5/6'],
        ['ow--5/6@t' => 'offset: 5/6@t'],
        ['ow--5/6@d' => 'offset: 5/6@d'],
        ['ow--5/6@w' => 'offset: 5/6@w']
    ];

    // kernl(ui) pre-defined section options
    protected $section_options = [
        ['--hero'           => 'Hero default'],
        ['--center'         => 'Header center'],
        ['--measure'        => 'Header with measure'],
        ['--measure-narrow' => 'Header with narrow measure'],
        ['--measure-wide'   => 'Header with wide measure'],
        ['--bal'            => 'Header with line after title'],

        ['bg--fixed'  => 'bg attachment: fixed'],
        ['bg--local'  => 'bg attachment: local'],
        ['bg--scroll' => 'bg attachment: scroll'],

        ['bg--none'        => 'bg color: None'],
        ['bg--white'       => 'bg color: white'],
        ['bg--white-alpha' => 'bg color: white-alpha'],
        ['bg--black'       => 'bg color: black'],
        ['bg--black-alpha' => 'bg color: black-alpha'],
        ['bg--gray'        => 'bg color: gray'],
        ['bg--gray-50'     => 'bg color: gray-50'],
        ['bg--gray-100'    => 'bg color: gray-100'],
        ['bg--gray-200'    => 'bg color: gray-200'],
        ['bg--gray-300'    => 'bg color: gray-300'],
        ['bg--gray-400'    => 'bg color: gray-400'],
        ['bg--gray-500'    => 'bg color: gray-500'],
        ['bg--gray-600'    => 'bg color: gray-600'],
        ['bg--gray-700'    => 'bg color: gray-700'],
        ['bg--gray-800'    => 'bg color: gray-800'],
        ['bg--gray-900'    => 'bg color: gray-900'],
        ['bg--red'         => 'bg color: red'],
        ['bg--red-dark'    => 'bg color: red-dark'],
        ['bg--red-light'   => 'bg color: red-light'],
        ['bg--orange'      => 'bg color: orange'],
        ['bg--yellow'      => 'bg color: yellow'],
        ['bg--green'       => 'bg color: green'],
        ['bg--teal'        => 'bg color: teal'],
        ['bg--blue'        => 'bg color: blue'],
        ['bg--blue-dark'   => 'bg color: blue-dark'],
        ['bg--purple'      => 'bg color: purple'],
        ['bg--beige'       => 'bg color: beige'],

        ['bgo--none' => 'bg overlay: none'],
        ['bgo--10'   => 'bg overlay: 10%'],
        ['bgo--20'   => 'bg overlay: 20%'],
        ['bgo--30'   => 'bg overlay: 30%'],
        ['bgo--40'   => 'bg overlay: 40%'],
        ['bgo--50'   => 'bg overlay: 50%'],
        ['bgo--60'   => 'bg overlay: 60%'],
        ['bgo--70'   => 'bg overlay: 70%'],
        ['bgo--80'   => 'bg overlay: 80%'],
        ['bgo--90'   => 'bg overlay: 90%'],

        ['bg--lt'    => 'bg position: left top'],
        ['bg--l'     => 'bg position: left'],
        ['bg--lb'    => 'bg position: left bottom'],
        ['bg--rt'    => 'bg position: right top'],
        ['bg--r'     => 'bg position: right'],
        ['bg--rb'    => 'bg position: right bottom'],
        ['bg--t'     => 'bg position: top'],

        ['bg--auto'    => 'bg size: auto'],
        ['bg--cover'   => 'bg size: cover'],
        ['bg--contain' => 'bg size: contain'],

        ['vh--10'  => 'height: 10vh'],
        ['vh--20'  => 'height: 20vh'],
        ['vh--30'  => 'height: 30vh'],
        ['vh--40'  => 'height: 40vh'],
        ['vh--50'  => 'height: 50vh'],
        ['vh--60'  => 'height: 60vh'],
        ['vh--70'  => 'height: 70vh'],
        ['vh--80'  => 'height: 80vh'],
        ['vh--90'  => 'height: 90vh'],
        ['vh--100' => 'height: 100vh']
    ];

    // Page location (not in use)
    protected $location;

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
        // Boolean for title fields
        $field_add_titles = new FieldsBuilder('add_titles');
        $field_add_titles->addTrueFalse('bool_titles', [
            'label' => 'Add Titles',
            'wrapper' => ['width' => '15'],
            "ui" => 1,
            "ui_on_text" => "Yes",
            "ui_off_text" => "No",
            "default_value" => 0
        ]);

        // Title, Pretitle and Subtitle fields
        $fields_titles = new FieldsBuilder('titles');
        $fields_titles
            ->addText('txt_pretitle', ['label' => 'Pre Title', 'wrapper' => ['width' => '15']])
                ->conditional('bool_titles', '==', '1')
            ->addText('txt_title', ['label' => 'Title', 'wrapper' => ['width' => '35']])
                ->conditional('bool_titles', '==', '1')
            ->addTextarea('txt_subtitle', ['label' => 'Sub title', 'rows' => 1, 'wrapper' => ['width' => '35']])
                ->conditional('bool_titles', '==', '1');

        // Boolean to override interior navigation label
        $field_add_nav_override = new FieldsBuilder('field_add_nav_override');
        $field_add_nav_override->addTrueFalse('bool_nav_override', [
            'label' => 'Override interior nav label',
            "ui" => 1,
            "ui_on_text" => "Yes",
            "ui_off_text" => "No",
            "default_value" => 0
        ]);

        // Override for interior navigation label
        $field_nav_label = new FieldsBuilder('nav_label');
        $field_nav_label
            ->addText('txt_nav_label', ['label' => 'Interior navigation label', 'wrapper' => ['width' => '100']])
                ->conditional('bool_nav_override', '==', '1');

        // Boolean for section styles
        $field_custom_styles = new FieldsBuilder('custom_styles');
        $field_custom_styles->addTrueFalse('bool_customize', [
            'label' => 'Customize Styles',
            'wrapper' => ['width' => '17'],
            "ui" => 1,
            "ui_on_text" => "Yes",
            "ui_off_text" => "No",
            "default_value" => 0
        ]);

        // Bg image, Predefined styles to select (multi) and Class property
        $fields_styles = new FieldsBuilder('styles');
        $fields_styles
            ->addImage('med_bgimg', ['label' => 'Bg Image', 'preview_size' => 'thumbnail', 'wrapper' => ['width' => '20'], 'max_width' => 2000])
                ->conditional('bool_customize', '==', '1')
            ->addSelect('opt_section', [
                'label' => 'Options',
                'allow_null' => 1,
                'multiple' => 1,
                'return_format' => 'value',
                'ui' => 1,
                'default_value' => 'bg--black',
                'wrapper' => ['width' => '33']
            ])
                ->addChoices($this->section_options)
                ->conditional('bool_customize', '==', '1')
            ->addText('txt_class', ['label' => 'Class', 'placeholder' => 'custom-classes', 'wrapper' => ['width' => '30']])
                ->conditional('bool_customize', '==', '1');

        // WYSIWYG for generic copy
        $field_copy = new FieldsBuilder('copy');
        $field_copy->addWysiwyg('txt_copy', ['label' => 'Copy']);

        // Select (multi) for columns and a paired Class property
        $fields_columns = new FieldsBuilder('columns');
        $fields_columns
            ->addSelect('opt_column', [
                'label' => 'Column Size',
                'allow_null' => 1,
                'multiple' => 1,
                'return_format' => 'value',
                'ui' => 1,
                'wrapper' => ['width' => '40']
            ])
                ->addChoices($this->column_options)
                ->setDefaultValue('')
            ->addSelect('opt_column_pos', [
                'label' => 'Column Position',
                'allow_null' => 1,
                'multiple' => 1,
                'return_format' => 'value',
                'ui' => 1,
                'wrapper' => ['width' => '30']
            ])
                ->addChoices($this->column_pos_options)
                ->setDefaultValue('')
            ->addText('txt_class', ['label' => 'Class', 'placeholder' => 'custom-classes', 'wrapper' => ['width' => '30']]);

        // Tabs and Accordion repeater with appropriate options
        $fields_toggle = new FieldsBuilder('toggle');
        $fields_toggle
            ->addRadio('opt_type', ['label' => 'Type', 'layout' => 'horizontal', 'wrapper' => ['width' => '40'],])
                ->addChoices(['accordion' => 'Accordion'], ['tabs' => 'Tabs'])
            ->addSelect('opt_toggle_class', [
                'label' => 'Options',
                'allow_null' => 1,
                'multiple' => 1,
                'return_format' => 'value',
                'ui' => 1,
                'default_value' => '',
                'wrapper' => ['width' => '60']
            ])
                ->addChoices([
                    [ '--white' =>  'Accordion: White'],
                    [ '--dark' =>   'Accordion: Dark'],
                    [ '--spaced' =>   'Accordion: Spaced'],
                    [ '--bordered' =>  'Tabs: Bordered'],
                    [ '--buttons' =>  'Tabs: Buttons'],
                ])
            ->addRepeater('lay_toggle', [
                'min' => 1,
                'button_label' => 'Add toggle',
                'layout' => 'block',
                'collapsed' => 'txt_title'
            ])
                ->addText('txt_title', ['label' => 'Title', 'wrapper' => ['width' => '30']])
                ->addWysiwyg('txt_copy', ['label' => 'Copy', 'wrapper' => ['width' => '70']]);

        // Nested content (ie. columns in columns) repeater for Copy, Tabs and Accordions
        $fields_nested_content = new FieldsBuilder('nested_content');
        $fields_nested_content
            ->addFlexibleContent('lay_content', [
                'label' => 'Nested Content',
                'max' => 1,
                'wrapper' => ['class' => 'm--left']
            ])
                ->addLayout($field_copy)
                ->addLayout($fields_toggle);

        // Nested row repeater (sets stage for nested content field above)
        $fields_nested_row = new FieldsBuilder('nested_row');
        $fields_nested_row
            ->addFields($field_custom_styles)
            ->addFields($fields_styles)
            // ->addFields($header)
            ->addRepeater('lay_nested', [
                'label' => 'Nested Row',
                'min' => 1,
                'button_label' => 'Add Nested Column',
                'layout' => 'block',
                'wrapper' => ['class' => 'm--right'],
                'collapsed' => 'opt_column'
            ])
                ->addFields($fields_columns)
                ->addFields($fields_nested_content);

        // Content flexible layout container with Copy, Toggle and Nested Row
        $fields_content = new FieldsBuilder('content');
        $fields_content
            ->addFlexibleContent('lay_content', [
                'label' => 'Content',
                'max' => 1,
                'wrapper' => ['class' => 'm--left']
            ])
                ->addLayout($field_copy)
                ->addLayout($fields_toggle)
                ->addLayout($fields_nested_row);

        // Row repeater for top most level layouts
        $fields_row = new FieldsBuilder('row');
        $fields_row
            ->addRepeater('lay_row', [
                'label' => 'Row',
                'layout' => 'block',
                'wrapper' => ['class' => 'kernl-section__row'],
                'button_label' => 'Add Column',
                'collapsed' => 'opt_column',
                'min' => 1
            ])
                ->addFields($fields_columns)
                ->addFields($fields_content);

        // Sections container, putting them all together
        $fields_sections = new FieldsBuilder('sections');
        $fields_sections
            ->addRepeater('lay_section', [
                'label' => 'Layout',
                'layout' => 'block',
                'wrapper' => ['class' => 'kernl-section'],
                'min' => 1,
                'collapsed' => 'txt_title',
            ])
                ->addMessage('- Section', '', ['wrapper' => ['class' => 'kernl-section__msg']])
                ->addFields($field_add_titles)
                ->addFields($fields_titles)
                ->addFields($field_custom_styles)
                ->addFields($fields_styles)
                ->addFields($fields_row);


        /**
            Below we build out ACF views on specific WP locations
        */

        // Homepage only view
        add_action('acf/init', function () {
            $homepage = new FieldsBuilder('homepage', ['style' => 'seamless']);
            $homepage
                ->addTrueFalse('bool_masthead_overylay', ['label' => 'Overlay Masthead', 'wrapper' => ['width' => '50'], 'ui' => 1]);

            $homepage->setLocation('options_page', '==', 'acf-options-homepage');

            acf_add_local_field_group($homepage->build());
        });

        // Views with Banner and Sections
        // - pages and homepage
        add_action('acf/init', function () use ($field_add_titles, $fields_titles, $field_custom_styles, $fields_styles, $fields_sections, $field_add_nav_override, $field_nav_label) {
            // --
            // Create structure for "section banner"
            $banner = new FieldsBuilder('banner', [
                'title' => 'Banner',
                'hide_on_screen' => ['the_content', 'discussion', 'comments', 'featured_image', 'send-trackbacks']
            ]);

            // add banner fields
            $banner
                ->addFields($field_add_titles)
                ->addFields($fields_titles)
                ->addFields($field_custom_styles)
                ->addFields($fields_styles)
                ->addTrueFalse('bool_header_nav', ['label' => 'Add page navigation to header', 'wrapper' => ['width' => '25'], 'ui' => 1])
                    ->conditional('bool_customize', '==', '1')
                ->addTrueFalse('bool_masthead_overylay', ['label' => 'Overlay Masthead', 'wrapper' => ['width' => '25'], 'ui' => 1])
                    ->conditional('bool_customize', '==', '1')
                ->setLocation('post_type', '==', 'page');

            // Build banner field group
            acf_add_local_field_group($banner->build());

            // * Override the default options select which is set to 'bg--black' for banners
            // prior to creating generic sections
            $fields_styles->modifyField('opt_section', ['default_value' => '']);

            // --
            // Create structure for generic sections
            $sections = new FieldsBuilder('sections', [
                'title' => 'Layout',
                'style' => 'seamless',
                'hide_on_screen' => ['the_content', 'discussion', 'comments', 'featured_image', 'send-trackbacks']]);

            // Add section fields
            $sections
                ->addFields($fields_sections)
                ->setLocation('options_page', '==', 'acf-options-homepage');

            // Setup loop for Customized layout options (defaults to 'page' post_type)
            if (get_field('opt_post_sections', 'option')) {
                foreach (get_field('opt_post_sections', 'option') as $posttype) {
                    $sections->getLocation()->or('post_type', '==', $posttype);
                }
            } else {
                $sections->getLocation()->or('post_type', '==', 'page');
            }

            // Build sections field group
            acf_add_local_field_group($sections->build());

            // --
            // Create structure for sidebar
            $sidebar = new FieldsBuilder('sidebar', [
                'title' => 'Page Options',
                'position' => 'side',
                'hide_on_screen' => ['the_content', 'discussion', 'comments', 'featured_image', 'send-trackbacks']]);

            // Add sidebar fields
            $sidebar
                ->addFields($field_add_nav_override)
                ->addFields($field_nav_label)
                ->setLocation('post_type', '==', 'page');

            // Build sidebar field group
            acf_add_local_field_group($sidebar->build());
        });

        // Views with Banner only
        // - posts, tribe_events and taxonomies
        add_action('acf/init', function () use ($field_add_titles, $fields_titles, $field_custom_styles, $fields_styles) {
            $banner = new FieldsBuilder('banner_only', [
                'title' => 'Banner',
                'hide_on_screen' => ['discussion', 'comments', 'send-trackbacks'],
                'position' => 'acf_after_title'
            ]);
            $banner
                ->addFields($field_add_titles)
                ->addFields($fields_titles)
                ->addFields($field_custom_styles)
                ->addFields($fields_styles)
                ->addTrueFalse('bool_masthead_overylay', ['label' => 'Overlay Masthead', 'wrapper' => ['width' => '50'], 'ui' => 1])
                    ->conditional('bool_customize', '==', '1')
                ->setLocation('post_type', '==', 'post')
                    ->or('post_type', '==', 'tribe_events')
                    ->or('taxonomy', '==', 'all');

            acf_add_local_field_group($banner->build());
        });
    }
}
