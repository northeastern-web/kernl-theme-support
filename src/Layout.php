<?php

namespace Kernl\Lib;

class Layout
{
    // ID to pass to ACF
    protected $id;

    /**
     * Constructor
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Displays header for various Wordpress views
     * @param  array $args arguments that can be accepted to build a header
     * @return string HTML output of header
     */
    public function displayHeader($args = [])
    {
        extract($args);
        $output = '';

        // Set variables if page has parents
        if (wp_get_post_parent_id(get_the_id()) > 0) {
            $customize = get_field('bool_customize', $this->id);
            $bgimg = ((get_field('med_bgimg', $this->id) && $customize) ? get_field('med_bgimg', $this->id)['url'] : self::getParentValues('med_bgimg')['url']);
            $class .= (!(self::getOptions('opt_section', null, 'get_field') && $customize) ? self::getParentValues('opt_section') : '');
            $title = get_the_title();
            $pretitle = (get_field('txt_pretitle', $this->id) ? get_field('txt_pretitle', $this->id) : self::getParentValues('txt_title'));
        }

        // Level set variables
        $class = (isset($class) ? ' '. $class : '');
        $bgimg = (isset($bgimg) ? $bgimg : null);
        $nav_parent = (isset($nav_parent) ? 'parent' : '');
        $title = (isset($title) ? $title : (get_the_title() ? get_the_title() : single_cat_title('', false)));
        $pretitle = (isset($pretitle) ? $pretitle : '');
        $subtitle = (isset($subtitle) ? $subtitle : '');

        // Handle titles if overridden per page/post
        if (get_field('bool_titles', $this->id)) {
            $title = (get_field('txt_title', $this->id) ? get_field('txt_title', $this->id) : get_the_title());
            $pretitle = (get_field('txt_pretitle', $this->id) ? get_field('txt_pretitle', $this->id) : $pretitle);
            $subtitle = (get_field('txt_subtitle', $this->id) ? get_field('txt_subtitle', $this->id) : $subtitle);
        }

        // Create structure if navigation in banner
        if (get_field('bool_header_nav', $this->id) || self::getParentValues('bool_header_nav')) {
            $subnav = '
                <nav class="nav --tabbed">
                    <ul class="__list" role="tablist">'
                        . \Kernl\Navigation::display('top', 1, 0, $nav_parent) .
                    '</ul>
                </nav>
            ';
            $class .= ($subnav ? ' +nav' : '');

            $output = '
                <header '. $this->getCustomization('section --banner'. $class, $bgimg, 'get_field') .'>
                    <div class="__header">'
                        . $this->getHeader($title, $pretitle, $subtitle, true) .
                    '</div>'
                    . $subnav.
                '</header>';
        } else {
            $output = '
                <header '. $this->getCustomization('section --banner'. $class, $bgimg, 'get_field') .'>
                    <div class="__header">'
                        . $this->getHeader($title, $pretitle, $subtitle, true) .
                    '</div>
                </header>';
        }

        return $output;
    }

    /**
     * Utility to display sections
     * @param  string $name ACF field name
     * @return string HMTL returned from getSection()
     */
    public function displaySections($name = 'lay_section')
    {
        $output = '';
        if (have_rows($name, $this->id)) {
            $output .= $this->getSection($name);
        }

        // condition block to determine if post has permissions and user logged in
        if (!is_home() && function_exists('members_has_post_permissions') && members_has_post_permissions() && !is_user_logged_in()) {
            $auth = new Auth();
            echo '<section class="section">
                '. $auth->getLogin() .'
            </section>';
        } else {
            return $output;
        }
    }

    /**
     * Inner HTML of a header
     * @param  string $title
     * @param  string $pretitle
     * @param  string $subtitle
     * @return string Inner HTML of header
     */
    protected function getHeader($title = '', $pretitle = '', $subtitle = '', $isBanner = false)
    {
        // Setting title element for subjective accessibility reqs
        $titleEl = ($isBanner ? 'h1' : 'h2');

        if ($pretitle || $title || $subtitle) {
            return
                ($pretitle ? '<div class="__pretitle">'. $pretitle .'</div>' : '') .
                ($title ? '<'.$titleEl.' class="__title">'. $title .'</'.$titleEl.'>' : '') .
                ($subtitle ? '<div class="__subtitle">'. $subtitle .'</div>' : '');
        }
    }

    /**
     * HTML of a section
     * @param  string $name ACF field to use
     * @return string HMTL of section
     */
    protected function getSection($name)
    {
        $i = 0;
        $output = '';
        while (have_rows($name, $this->id)) {
            $i++;
            the_row();
            $title = get_sub_field('txt_title');
            $pretitle = get_sub_field('txt_pretitle');
            $subtitle = get_sub_field('txt_subtitle');

            $output .= '<section id="section-'. $i .'" '. $this->getCustomization('section') .'>';
            if ($this->getHeader($title, $pretitle, $subtitle)) {
                $output .= '
                    <header class="__header">
                        '. $this->getHeader($title, $pretitle, $subtitle) .'
                    </header>
                ';
            } else {
                $output .= $this->getHeader($title, $pretitle, $subtitle);
            }
            $output .= $this->getSectionGrid() . '</section>';
        }

        return $output;
    }

    /**
     * HTML of the grid within a section
     * @param  string $name ACF field to use
     * @return string HTML of a grid/row
     */
    protected function getSectionGrid($name = 'lay_row')
    {
        $output = '';
        while (have_rows($name)) {
            the_row();
            $class = (get_sub_field('txt_class') ? ' '. get_sub_field('txt_class'): '');
            $output .= '
                <div class="col '. self::getOptions('opt_column') . ' ' . self::getOptions('opt_column_pos') . $class .'">
                    '. $this->getSectionContent() .'
                </div>
            ';
        }

        return '
            <div class="row">
                '. $output .'
            </div>
        ';
    }

    /**
     * HTML of the content options within a section
     * @return string HTML of content
     */
    protected function getSectionContent()
    {
        $output = '';
        while (have_rows('lay_content')) {
            the_row();
            if (get_row_layout() == 'toggle') {
                if (get_sub_field('opt_type') == 'accordion') {
                    $output .= $this->getAccordion();
                } else {
                    $output .= $this->getTabs();
                }
            } elseif (get_row_layout() == 'nested_row') {
                $output .= '
                    <section '. $this->getCustomization('section') .'>
                        '. $this->getSectionGrid('lay_nested') .'
                    </section>
                ';
            } else {
                $output .= get_sub_field('txt_copy');
            }
        }

        return $output;
    }

    /**
     * HTML of an accordion
     * @return string HTML of accordion
     */
    protected function getAccordion()
    {
        $i = 0;
        $rand = rand(0, 99999);
        $output = '<div id="accordion-'. $rand .'" class="accordion '. self::getOptions('opt_toggle_class') .'">';

        while (have_rows('lay_toggle')) {
            the_row();
            $output .= '
                <div class="__item">
                    <button class="__title"
                        data-swap-target="#accordion_' . $rand .'_'. $i .'"
                        data-swap-group="accordion_' . $rand . '">
                        '. get_sub_field('txt_title') .'
                    </button>
                    <div class="__content" id="accordion_'. $rand .'_'. $i .'" data-acf="txt_copy">
                        <div class="__copy">
                            '. get_sub_field('txt_copy') .'
                        </div>
                    </div>
                </div>
            ';
            $i++;
        }
        $output .= '</div>';

        return $output;
    }

    /**
     * HTML of tabs
     * @return string HTML of tabs
     */
    protected function getTabs()
    {
        $i = 0;
        $rand = rand(0, 9999);
        $nav = '<nav id="tabs-'. $rand .'" class="nav --tabbed '. self::getOptions('opt_toggle_class') .'"><ul class="__list" role="tablist">';
        $tab = '<div class="nav__content">';
        while (have_rows('lay_toggle')) {
            the_row();
            $nav .= '
                <li class="__item">
                    <a class="__link'. ($i == 0 ? ' --active' : '') .'" data-toggle="tab" data-swap-group="tabgroup_'. $rand .'" href="#tab-'. $rand .'_'. $i .'" role="tab" aria-expanded="'. ($i == 0 ? 'true' : 'false') .'">
                        '. get_sub_field('txt_title') .'
                    </a>
                </li>
            ';
            $tab .= '
                <div class="hidden pt--1'. ($i == 0 ? ' --active' : '') .'" id="tab-'. $rand .'_'. $i .'" role="tabpanel" aria-expanded="'. ($i == 0 ? 'true' : 'false') .'">
                    '. get_sub_field('txt_copy') .'
                </div>
            ';
            $i++;
        }
        $tab .= '</div>';
        $nav .= '</ul></nav>';

        $output = $nav . $tab;

        return $output;
    }

    /**
     * Crafts the properties to apply to a section
     * @param  string $class
     * @param  string $bgimg URL path a background image
     * @param  string $fieldtype ACF field to use
     * @return string various properties
     */
    protected function getCustomization($class = null, $bgimg = null, $fieldtype = 'get_sub_field')
    {
        $output = '';
        $style = '';

        $customize = $fieldtype('bool_customize', $this->id);
        $bgimg = (($fieldtype('med_bgimg', $this->id) && $customize) ? $fieldtype('med_bgimg', $this->id)['url'] : $bgimg);
        $class .= (($fieldtype('txt_class', $this->id) && $customize) ? ' '. $fieldtype('txt_class', $this->id) : null);
        $class .= ((self::getOptions('opt_section', null, $fieldtype, $this->id)) ? ' '. self::getOptions('opt_section', ' ', $fieldtype, $this->id) : null);
        $class .= ($bgimg ? ' bg--img' : null);

        $output .= ($class ? ' class="'. $class .'"' : '');
        $output .= ($bgimg ? ' style="background-image:url(\''. $bgimg .'\');"' : '');

        return $output;
    }

    /**
     * Parses potential options for a section
     * @param  string $name ACF field to use
     * @param  string $delim Characters to use for delimiter
     * @param  string $fieldtype ACF "type" to retrieve fields
     * @param  integer $id Optional parent page ID
     * @return string parsed options
     */
    public static function getOptions($name, $delim = ' ', $fieldtype = 'get_sub_field', $id = null)
    {
        $options = $fieldtype($name, $id);

        if ($options) {
            return (is_array($options) ? implode($delim, $options) : $options);
        }
    }

    /**
     * Look up ACF values for a page for closest ancestor
     * @param  string $field ACF field to use
     * @return string Value of ACF field
     */
    public static function getParentValues($field)
    {
        // Start by getting all ancestor ids
        $ancestor_ids = get_post_ancestors(get_the_id());

        // If this is a child page
        if ($ancestor_ids) {
            // Grab all ancestor ids with valid inheritance options
            $inherit_options = [];
            foreach ($ancestor_ids as $ancestor_id) {
                if (get_field($field, $ancestor_id)) {
                    $inherit_options[] = $ancestor_id;
                }
            }

            // Set id of closest ancestor
            $inherit_id = current($inherit_options);

            // Check if title
            // - inject breadcrumb to pretitle
            if ($field == 'txt_title') {
                $output = '<nav class="breadcrumb">';
                foreach (array_reverse($ancestor_ids) as $ancestor_id) {
                    $output .= '<a href="'. get_permalink($ancestor_id) .'">' . get_the_title($ancestor_id) . '</a>';
                }
                $output .= '</nav>';
                return $output;
            }

            // Check Options
            if ($field == 'opt_section') {
                return self::getOptions('opt_section', ' ', 'get_field', $inherit_id);
            }

            // If not looking for special conditions above, return basic field
            return get_field($field, $inherit_id);
        }
    }
}
