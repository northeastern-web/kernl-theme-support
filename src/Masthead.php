<?php

namespace Kernl\Lib;

class Masthead extends \Walker_Nav_Menu
{
    /**
     * WP based Nav Walker for Kernl(UI)
     */
    public function start_lvl(&$output, $depth = 0, $args = [])
    {
        if ($depth != 0) {
            $output .= '
                <ul>
                    ';
        }
    }

    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $title = $item->title . ($item->target ? ' <i class="--sm" data-feather="external-link"></i>' : '');
        $target = 'target="_blank" rel="noopener"';
        $is_megamenu = (strpos(Masthead::getClass(), '--megamenu') !== false) ? true : false;
        $link = '<a class="__link" href="'. $item->url .'" '. ($item->target ? $target : '') .'>'
            . $title .
        '</a>';
        $link_child = '<a class="__link'. ($is_megamenu ? ' --heading' : '') .'" href="'. $item->url .'" '. ($item->target ? $target : '') .'>'
            . $title .
        '</a>';
        $link_active = (in_array('current-menu-item', $item->classes) || in_array('current-page-ancestor', $item->classes) ? '--active' : '');

        if ($depth == 0 && $args->walker->has_children) {
            $output .= '
                <li class="__item '. $link_active .' +children">
                    '. $link .'
                    <ul class="__submenu">';
        } elseif ($depth == 1) {
            if ($item->classes[0] != null) {
                $output .= '
                    <li class="'. ($is_megamenu ? 'col w--fit@d ' : '__item') . $item->classes[0] .'">
                        '. $link_child;
            } else {
                $output .= '
                    <li class="'. ($is_megamenu ? 'col w--fit@d ' : '__item') .'">
                        '. $link_child;
            }
        } else {
            if ($item->title == 'Search') {
                $output .= '
                    <li class="__item +icon">
                        <a class="__link" href="#" data-toggle="modal" data-target="#modal_search" aria-label="Modal Search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
                        </a>';
            } else {
                if ($item->classes[0] != null) {
                    $output .= '<li class="__item ' . $item->classes[0] . '">'. $link;
                } else {
                    $output .= '<li class="__item '. $link_active .'">'. $link;
                }
            }
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $output .= '</li>';
    }

    public static function getMenu($menu)
    {
        return wp_get_nav_menu_items($menu);
    }

    public static function getClass()
    {
        $option = (is_home() ? 'option' : (is_singular() ? get_the_ID() : get_queried_object()));
        $class = 'masthead';

        // Check if global masthead options are set
        if (get_field('opt_masthead', 'option')) {
            $class .= ' '. implode(' ', get_field('opt_masthead', 'option'));
        }

        // Check if specific page is an overlay
        if (get_field('bool_masthead_overylay', $option) ||  Layout::getParentValues('bool_masthead_overylay')) {
            $class .= ' --overlay';
        }

        return $class;
    }

    public static function getLogo()
    {
        $option = (is_home() ? 'option' : (is_singular() ? get_the_ID() : get_queried_object()));
        $logo = get_field('med_logo', 'option');

        // Check if logo should be white option
        if (!empty(get_field('opt_masthead', 'option'))
            && in_array('bg--black', get_field('opt_masthead', 'option'))) {
            $logo = get_field('med_logo_white', 'option');
        }

        if (get_field('bool_masthead_overylay', $option)
            ||  Layout::getParentValues('bool_masthead_overylay')) {
            $logo = get_field('med_logo_white', 'option');
        }

        return $logo;
    }

    public static function isActiveMenu($menu, $item)
    {
        $menu_items = wp_get_nav_menu_items($menu);
        $current_item = current(wp_filter_object_list($menu_items, ['object_id' => get_queried_object_id()]));

        return ($current_item && $current_item->title == $item->title ? true : false);
    }
}
