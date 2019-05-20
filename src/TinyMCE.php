<?php

namespace Kernl;

class TinyMCE
{
    // Available size options
    public $sizes = [
        'xs' => 'xs',
        'sm' => 'sm',
        'lg' => 'lg',
    ];

    // Available positions
    public $positions = [
        'all sides' => 'a',
        'y-axis' => 'y',
        'x-axis' => 'x',
        'top' => 't',
        'right' => 'r',
        'bottom' => 'b',
        'left' => 'l'
    ];

    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        $this->customizeTinymce();
        $this->editTinymceButtons();
    }

    /**
     * Customize the default Wordpress TinyMCE
     * @return void
     */
    public function customizeTinymce()
    {
        add_filter('tiny_mce_before_init', function ($settings) {
            $style_type = [
                'title' => 'Typography',
                'items' => [
                    [
                        'title' => 'Alignment',
                        'items' => [
                            [
                                'title' => 'Left',
                                'selector' => '*',
                                'classes' => 'ta--l',
                                'wrapper' => false
                            ],
                            [
                                'title' => 'Right',
                                'selector' => '*',
                                'classes' => 'ta--r',
                                'wrapper' => false
                            ],
                            [
                                'title' => 'Center',
                                'selector' => '*',
                                'classes' => 'ta--c',
                                'wrapper' => false
                            ]
                        ]
                    ],
                    [
                        'title' => 'Weight',
                        'items' => [
                            [
                                'title' => '300',
                                'selector' => '*',
                                'classes' => 'fw--300',
                                'wrapper' => false
                            ],
                            [
                                'title' => '400',
                                'selector' => '*',
                                'classes' => 'fw--400',
                                'wrapper' => false
                            ],
                            [
                                'title' => '700',
                                'selector' => '*',
                                'classes' => 'fw--700',
                                'wrapper' => false
                            ],
                            [
                                'title' => '900',
                                'selector' => '*',
                                'classes' => 'fw--900',
                                'wrapper' => false
                            ],
                        ]
                    ],
                    [
                        'title' => 'Sizing',
                        'items' => [
                            [
                                'title' => 'font size xs',
                                'selector' => '*',
                                'classes' => 'fs--xs',
                                'exact' => true,
                                'wrapper' => false
                            ],
                            [
                                'title' => 'font size sm',
                                'selector' => '*',
                                'classes' => 'fs--sm',
                                'exact' => true,
                                'wrapper' => false
                            ],
                            [
                                'title' => 'Lead',
                                'selector' => '*',
                                'classes' => 'fs--lead',
                                'wrapper' => false
                            ],
                            [
                                'title' => 'Display 1',
                                'selector' => '*',
                                'classes' => 'fs--d1',
                                'exact' => true,
                                'wrapper' => false
                            ],
                            [
                                'title' => 'Display 2',
                                'selector' => '*',
                                'classes' => 'fs--d2',
                                'exact' => true,
                                'wrapper' => false
                            ],
                            [
                                'title' => 'Display 3',
                                'selector' => '*',
                                'classes' => 'fs--d3',
                                'exact' => true,
                                'wrapper' => false
                            ],
                            [
                                'title' => 'Display 4',
                                'selector' => '*',
                                'classes' => 'fs--d4',
                                'exact' => true,
                                'wrapper' => false
                            ],
                            [
                                'title' => 'Display 5',
                                'selector' => '*',
                                'classes' => 'fs--d5',
                                'exact' => true,
                                'wrapper' => false
                            ]
                        ]
                    ]
                ]
            ];

            $style_padding = [
                'title' => 'Padding',
                'items' => $this->spacing('p')
            ];

            $style_margin = [
                'title' => 'Margin',
                'items' => $this->spacing('m')
            ];

            $style_buttons = [
                'title' => 'Buttons',
                'items' => [
                    [
                       'title' => 'Type',
                       'items' => [
                           [
                               'title' => 'Basic',
                               'selector' => 'a',
                               'classes' => 'btn',
                               'wrapper' => false
                           ],
                           [
                               'title' => 'Marketing',
                               'selector' => 'a',
                               'classes' => 'btn --m',
                               'wrapper' => false
                           ],
                           [
                               'title' => 'Pill',
                               'selector' => 'a',
                               'classes' => 'btn br--pill',
                               'wrapper' => false
                           ],
                           [
                               'title' => 'Block',
                               'selector' => 'a',
                               'classes' => 'btn --block',
                               'wrapper' => false
                           ]
                        ]
                    ],
                    [
                        'title' => 'Background color',
                        'items' => $this->componentColors('btn', 'bg', null, 'a')
                    ],
                    [
                        'title' => 'Border color',
                        'items' => $this->componentColors('btn', 'bc', null, 'a')
                    ],
                    [
                       'title' => 'Sizes',
                       'items' => $this->componentSizes('btn', null, 'a')
                    ]
                ]
            ];

            $style_listgroups = [
                'title' => 'List Groups',
                'items' => [
                    [
                        'title' => 'Basic',
                        'selector' => 'ul,ol',
                        'classes' => 'list-group',
                        'wrapper' => true
                    ],
                    [
                        'title' => 'Striped',
                        'selector' => 'ul,ol',
                        'classes' => 'list-group --striped',
                        'wrapper' => true
                    ],
                    [
                        'title' => 'Outline',
                        'selector' => 'ul,ol',
                        'classes' => 'list-group --outline',
                        'wrapper' => true
                    ],
                ]
            ];

            $settings['style_formats'] = json_encode([$style_type, $style_buttons, $style_listgroups]);
            $settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;';

            return $settings;
        });
    }

    /**
     * Customize TinyMCE button rows
     * @param  array $buttons default buttons in row 1
     * @return void
     */
    public function editTinymceButtons()
    {
        add_filter('mce_buttons', function ($buttons) {
            // $buttons contains all current buttons
            // instead, return specific buttons to add to tiny mce
            return ['undo','redo','removeformat','|','bold','italic','superscript','blockquote','bullist','numlist','table','hr','link','unlink','|','formatselect','styleselect'];
        });

        add_filter('mce_buttons_2', function ($buttons) {
            return []; // clearing out row 2
        });
    }

    /**
     * Available component colors
     * @param  string $item
     * @param  string $block
     * @param  string $selector
     * @return string
     */
    private function componentColors($item, $prefix = 'bg', $block = 'div', $selector = null)
    {
        $colors = [
            'base' => $item,
            'gray' => $item . ' '. $prefix .'--gray',
            'gray 100' => $item . ' '. $prefix .'--gray-100',
            'gray 200' => $item . ' '. $prefix .'--gray-200',
            'gray 300' => $item . ' '. $prefix .'--gray-300',
            'gray 400' => $item . ' '. $prefix .'--gray-400',
            'gray 500' => $item . ' '. $prefix .'--gray-500',
            'gray 600' => $item . ' '. $prefix .'--gray-600',
            'gray 700' => $item . ' '. $prefix .'--gray-700',
            'gray 800' => $item . ' '. $prefix .'--gray-800',
            'gray 900' => $item . ' '. $prefix .'--gray-900',
            'red' => $item . ' '. $prefix .'--red',
            'blue' => $item . ' '. $prefix .'--blue',
            'blue dark' => $item . ' '. $prefix .'--blue-dark',
            'green' => $item . ' '. $prefix .'--green',
            'purple' => $item . ' '. $prefix .'--purple',
            'yellow' => $item . ' '. $prefix .'--yellow',
            'orange' => $item . ' '. $prefix .'--orange',
            'teal' => $item . ' '. $prefix .'--teal',
            'beige' => $item . ' '. $prefix .'--beige',
            'white' => $item . ' '. $prefix .'--white',
            'black alpha' => $item . ' '. $prefix .'--black-alpha',
            'black' => $item . ' '. $prefix .'--black',
            'white alpha' => $item . ' '. $prefix .'--white-alpha',
        ];

        $component_format = [];

        foreach ($colors as $color => $value) {
            $component_format[] = [
                'title' => $color,
                'block' => $block,
                'selector' => $selector,
                'classes' => $value,
                'wrapper' => false
            ];
        }

        return $component_format;
    }

    /**
     * Available component sizes
     * @param  string $item
     * @param  string $block
     * @param  string $selector
     * @return string
     */
    private function componentSizes($item, $block = 'div', $selector = null)
    {
        $component_format = [];

        foreach ($this->sizes as $size => $value) {
            $component_format[] = [
                'title' => $size,
                'block' => $block,
                'selector' => $selector,
                'classes' => ' --'. $value,
                'wrapper' => false
            ];
        }

        return $component_format;
    }

    /**
     * Spacing options for Kernl(UI)
     * @param  string $item
     * @return string
     */
    private function spacing($item)
    {
        $spacing_format = [];

        foreach ($this->positions as $position_label => $position) {
            $positions_format = [];

            foreach ($this->sizes as $size => $breakpoint) {
                $i = 10;
                while ($i >= 0) {
                    $positions_format[] = [
                        'title' => $i .' ('. $breakpoint .' and up)',
                        'selector' => '*',
                        'classes' => $item . $position .'--'. $i .'@'. $breakpoint,
                        'wrapper' => false
                    ];
                    $i--;
                }
            }

            $spacing_format[] = [
                'title' => $position_label,
                'items' => $positions_format
            ];
        }

        return $spacing_format;
    }
}
