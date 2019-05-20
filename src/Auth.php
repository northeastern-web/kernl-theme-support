<?php

namespace Kernl\Lib;

class Auth
{
    private $parameters;
    private $defaults = [
        'class' => '',
        'title' => 'Access Restricted',
        'body' => '',
        'cta' => 'Log in with myNortheastern',
        'login' => '',
    ];


    public function __construct($params = [])
    {
        $this->parameters = wp_parse_args($params, $this->defaults);
        if ($this->parameters['login']) {
            $this->parameters['login'] = add_query_arg('action', 'shibboleth', wp_login_url($this->parameters['login']));
        } else {
            $this->parameters['login'] = add_query_arg('action', 'shibboleth', wp_login_url(get_permalink()));
        }
    }

    public function getLogin()
    {
        return '
        <div class="modal --active --base --sm '. $this->parameters['class'] .'">
            <div class="__screen"></div>
            <div class="__content bg--white ta--c">
                <h2 class="__title">
                    <i class="mr--0h tc--red" data-feather="lock"></i>
                    '. $this->parameters['title'] .'
                </h2>
                <p>'. $this->parameters['body'] .'</p>
                <a class="btn --sm" href="'. $this->parameters['login'] .'">
                    '. $this->parameters['cta'] .'
                </a>
            </div>
        </div>';
    }
}
