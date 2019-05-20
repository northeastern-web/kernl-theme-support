<?php

namespace Kernl\Lib;

class ShortcodeComponent
{
    private $parameters;
    private $default_atts = [
        'type' => 'card',
        'class' => '',
        'link' => '',
        'target' => '',
        'header' => '',
        'footer' => '',
        'footer_link' => '',
        'pretitle' => '',
        'title' => '',
        'subtitle' => '',
        'icon' => '',
        'image' => '',
        'alt' => ''
    ];

    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        $this->shortcodeComponent();
        $this->shortcodeAlert();
    }

    /**
     * Shortcode to craft a component
     * @return void add_shortcode()
     */
    protected function shortcodeComponent()
    {
        add_shortcode('component', function ($atts, $content = null) {
            $this->parameters = shortcode_atts($this->default_atts, $atts, 'component');

            return '
            <article class="'. $this->parameters['type'] . ($this->parameters['class'] ? ' '. $this->parameters['class'] : '') . '">'
                . ($this->parameters['link'] ? '<a href="'. $this->parameters['link'] .'" class="__link"'
                    . ($this->parameters['title'] ? ' title="'. $this->parameters['title'] .'"' : '')
                    . ($this->parameters['target'] ? ' target="_blank" rel="noopener"' : '')
                    . '>' : '')

                    . ($this->parameters['header'] ?
                        '<header class="__header">'
                            . $this->parseHeaderFooter($this->parameters['header']) .
                        '</header>' : '')

                    . ($this->parameters['image'] ?
                        '<div class="__graphic ar--16x9">
                            <img class="__graphic__img" src="'
                                . $this->parameters['image'] . '" alt="'
                                . ($this->parameters['alt'] ? $this->parameters['alt'] : $this->parameters['title']) . '">
                        </div>' : '')

                    . '<div class="__body">'
                        . ($this->parameters['icon'] ? $this->parseField($this->parameters['icon'], '__icon') : '')
                        . ($this->parameters['pretitle'] ? $this->parseField($this->parameters['pretitle'], '__pretitle') : '')
                        . ($this->parameters['title'] ? $this->parseField($this->parameters['title'], '__title', 'h2') : '')
                        . ($this->parameters['subtitle'] ? $this->parseField($this->parameters['subtitle'], '__subtitle') : '')
                            . do_shortcode(\Kernl\Utility::removeEmptyParagraphs($content))
                    . '</div>'

                    . ($this->parameters['footer'] ?
                        '<footer class="__footer">' .
                            ($this->parameters['footer_link'] && empty($this->parameters['link']) ? '<a href="'. $this->parameters['footer_link'] .'" class="__footer__link">' : '')
                            . $this->parseHeaderFooter($this->parameters['footer'])
                            . ($this->parameters['footer_link'] && empty($this->parameters['link']) ? '</a>' : '')
                        . '</footer>'
                    : '')

                . ($this->parameters['link'] ? '</a>' : '')
            . '</article>
            ';
        });
    }

    /**
     * Shortcode to craft an alert
     * @return void add_shortcode()
     */
    protected function shortcodeAlert()
    {
        add_shortcode('alert', function ($atts, $content = null) {
            $this->parameters = shortcode_atts($this->default_atts, $atts, 'alert');

            return '
            <div class="'. $this->parameters['type'] . ($this->parameters['class'] ? ' '. $this->parameters['class'] : ' bg--beige --tile') . ' mb--1">'
                . ($this->parameters['link'] ? '<a href="'. $this->parameters['link'] .'" class="__link"'
                    . ($this->parameters['target'] ? ' target="_blank" rel="noopener"' : '')
                    . '>' : '')

                    . '<div class="__body">'
                        . ($this->parameters['icon'] ? $this->parseField($this->parameters['icon'], '__icon') : '')
                        . ($this->parameters['pretitle'] ? $this->parseField($this->parameters['pretitle'], '__pretitle') : '')
                        . ($this->parameters['title'] ? $this->parseField($this->parameters['title'], '__title', 'h2') : '')
                        . ($this->parameters['subtitle'] ? $this->parseField($this->parameters['subtitle'], '__subtitle') : '')
                            . do_shortcode(\Kernl\Utility::removeEmptyParagraphs($content))
                    . '</div>'

                    . ($this->parameters['footer'] ?
                        '<footer class="__footer">' .
                            ($this->parameters['footer_link'] && empty($this->parameters['link']) ? '<a href="'. $this->parameters['footer_link'] .'" class="__footer__link">' : '')
                            . $this->parseHeaderFooter($this->parameters['footer'])
                            . ($this->parameters['footer_link'] && empty($this->parameters['link']) ? '</a>' : '')
                        . '</footer>'
                    : '')

                . ($this->parameters['link'] ? '</a>' : '')
            . '</div>
            ';
        });
    }

    /**
     * Parse field
     * @param  string   $content
     * @return string
     */
    private function parseField($field, $class, $element = 'div', $delimiter = '|')
    {
        // explode by delim
        $field_array = explode($delimiter, $field);
        // set field
        $field = $field_array[0];

        // Check for various elements
        if ($class == '__icon') {
            $field = '<i data-feather="'. $field .'"></i>';
        }

        // alter class if passed with delim
        $class .= (isset($field_array[1]) ? " {$field_array[1]}" : '');

        return '<'.$element.' class="'.$class.'">' . $field . '</'.$element.'>';
    }

    /**
     * Parse array(s) in component shortcode
     * @param  string   $type
     * @param  string   $content
     * @return string
     */
    private function parseHeaderFooter($array, $delimiter_1 = ',', $delimiter_2 = '|')
    {
        $output = '';
        $array_outer = explode($delimiter_1, $array);
        $array_inner = [];

        foreach ($array_outer as $key => $value) {
            $item = explode($delimiter_2, $value);
            $output .= '
                <div class="__column">'
                    . (isset($item[1]) ? '<div class="' . $item[1] . '">' : '')
                        . $item[0]
                    . (isset($item[1]) ? '</div>' : '') .
                '</div>
            ';
        }

        return $output;
    }
}
