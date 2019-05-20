<?php

namespace Kernl\Lib;

class ShortcodeMailchimp
{
    private $parameters;
    private $default_atts = [
        'domain' => '',
        'id' => '',
        'u' => '',
        'placeholder' => 'Enter your email address',
        'btn' => 'bg--black',
        'cta' => 'Subscribe',
    ];

    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        $this->shortcodeMailchimp();
    }

    /**
     * Shortcode to craft a video embed
     * @return void add_shortcode()
     */
    protected function shortcodeMailchimp()
    {
        add_shortcode('mailchimp', function ($atts) {
            $this->parameters = shortcode_atts($this->default_atts, $atts);

            return '
                <form action="https://'. $this->parameters['domain'] .'.list-manage.com/subscribe/post?u='. $this->parameters['u'] .'&amp;id='. $this->parameters['id'] .'" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate form mb--1h" target="_blank" novalidate>
                  <div class="form__enclosed">
                    <label for="mce-EMAIL"><span class="sr--only">'. $this->parameters['placeholder'] .'</span></label>
                    <input class="--lg" type="email" placeholder="'. $this->parameters['placeholder'] .'" name="EMAIL" id="mce-EMAIL" autocomplete="off" required>
                    <button type="submit" class="btn '. $this->parameters['btn'] .' px--1" name="subscribe" id="mc-embedded-subscribe">'. $this->parameters['cta'] .'</button>
                    <div style="position: absolute; left: -5000px;" aria-hidden="true">
                      <input type="text" name="'. $this->parameters['u'] .'_'. $this->parameters['id'] .'" tabindex="-1" value="">
                    </div>
                  </div>
                </form>
            ';
        });
    }
}
