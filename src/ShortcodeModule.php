<?php

namespace Kernl\Lib;

class ShortcodeModule
{
    private $parameters;
    private $query_results;
    private $default_atts = [
        'id'  => '',
        'type'  => '',
        'class'  => '',
    ];

    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        $this->shortcodeModule();
    }

    /**
     * Shortcode grabbing Modules based on WP_Query arguments passed
     * @return void add_shortcode()
     */
    protected function shortcodeModule()
    {
        add_shortcode('module', function ($atts) {
            $this->parameters = shortcode_atts($this->default_atts, $atts);

            // build out tax_query argument array if taxonomy param passed
            if ($this->parameters['id']) {
                $data['type'] = $this->parameters['type'];
                $data['class'] = $this->parameters['class'];
                $data['module'] = get_post($this->parameters['id']);
                return \Kernl\Utility::getTemplate('module/'. $this->parameters['type'], $data);
            }

            return 'No module ID specified';
        });
    }
}
