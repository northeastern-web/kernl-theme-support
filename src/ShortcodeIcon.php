<?php

namespace Kernl\Support\Theme;

class ShortcodeIcon
{
    private $parameters;
    private $default_atts = [
        'id' => '',
        'class' => '',
    ];

    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        $this->shortcodeIcon();
    }

    /**
     * Shortcode to add a feather icon
     * @return void add_shortcode()
     */
    protected function shortcodeIcon()
    {
        add_shortcode('icon', function ($atts) {
            $this->parameters = shortcode_atts($this->default_atts, $atts);

            return '
                <i data-feather="'. $this->parameters['id'] .'" class="'. $this->parameters['class'] .'">
                    <span class="sr--only">'. $this->parameters['id'] . ' icon</span>
                </i>
            ';
        });
    }
}
