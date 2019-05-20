<?php

namespace Kernl;

class ShortcodeAuth
{
    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        $this->shortcodeAuth();
    }

    /**
     * Shortcode to craft default authentication prompt
     * @return void add_shortcode()
     */
    protected function shortcodeAuth()
    {
        add_shortcode('auth', function ($atts) {
            $auth = new Auth($atts);
            return $auth->getLogin();
        });
    }
}
