<?php

namespace Kernl;

class ShortcodeVideo
{
    private $parameters;
    private $default_atts = [
        'site' => 'youtube',
        'player' => 'https://www.youtube.com/embed/',
        'id' => '',
        'class' => 'ar--16x9 mb--1'
    ];

    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        $this->shortcodeVideo();
    }

    /**
     * Shortcode to craft a video embed
     * @return void add_shortcode()
     */
    protected function shortcodeVideo()
    {
        add_shortcode('vid', function ($atts) {
            $this->parameters = shortcode_atts($this->default_atts, $atts);

            if ($this->parameters['site'] == 'vimeo') {
                $this->parameters['player'] = 'https://player.vimeo.com/video/';
            }

            return '
                <div class="ar '. $this->parameters['class'] .'">
                    <iframe class="ar--object w--100" src="'. $this->parameters['player'] . $this->parameters['id'] . '?title=0&byline=0&portrait=0&color=#cc0000" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
            ';
        });
    }
}
