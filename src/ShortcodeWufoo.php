<?php

namespace Kernl\Support\Theme;

class ShortcodeWufoo
{
    private $parameters;
    private $default_atts = [
        'id' => '',
        'u' => 'provostweb',
        'header' => 'hide',
    ];

    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        $this->shortcodeWufoo();
    }

    /**
     * Shortcode to craft a video embed
     * @return void add_shortcode()
     */
    protected function shortcodeWufoo()
    {
        add_shortcode('wufoo', function ($atts) {
            $this->parameters = shortcode_atts($this->default_atts, $atts);

            return '
                <div id="wufoo-'. $this->parameters['id'] .'">
                    Fill out my <a href="https://'. $this->parameters['u'] .'.wufoo.com/forms/'. $this->parameters['id'] .'">online form</a>.
                </div>
                <script type="text/javascript">var '. $this->parameters['id'] .';(function(d, t) {
                var s = d.createElement(t), options = {
                "userName":"'. $this->parameters['u'] .'",
                "formHash":"'. $this->parameters['id'] .'",
                "autoResize":true,
                "height":"auto",
                "async":true,
                "host":"wufoo.com",
                "header":"'. $this->parameters['header'] .'",
                "ssl":true};
                s.src = ("https:" == d.location.protocol ? "https://" : "http://") + "www.wufoo.com/scripts/embed/form.js";
                s.onload = s.onreadystatechange = function() {
                var rs = this.readyState; if (rs) if (rs != "complete") if (rs != "loaded") return;
                try { '. $this->parameters['id'] .' = new WufooForm();'. $this->parameters['id'] .'.initialize(options);'. $this->parameters['id'] .'.display(); } catch (e) {}};
                var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
                })(document, "script");</script>
            ';
        });
    }
}
