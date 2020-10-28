<?php

namespace Kernl\Support\Theme;

class Navigation
{
    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        $this->editListPages();
    }

    /**
     * Display the navigation
     * @param  string  $level   value determining level of pages to display
     * @param  int $depth       depth of the menu
     * @param  int $child_of    depth of the menu
     * @param  string $title_li what to display in title_li, add 'parent' for parent page
     * @return string           reformatted wp_list_pages
     */
    public static function display($level = 'top', $depth = 1, $child_of = false, $title_li = '')
    {
        global $post;
        $ancestors = get_post_ancestors($post->ID);
        $root_ancestor = ($ancestors ? end($ancestors) : $post->ID);

        if ($title_li) {
            if ($title_li == 'parent') {
                $title_li = '
                    <li class="__item --title '. (get_the_id() == $root_ancestor ? '--active' : '') .'">
                        <a class="__link" href="'. get_permalink($root_ancestor) .'">
                            <i class="__icon --left feather --sm" data-feather="corner-left-up"></i>
                            '. self::getPageTitle($root_ancestor) .'
                        </a>
                    </li>
                ';
            } else {
                $title_li = '<li class="__item --title">'. $title_li .'</li>';
            }
        }

        if (!$child_of) {
            if ($level === 'top') {
                if ($ancestors) {
                    $child_of = (count($ancestors) == 1 ? current($ancestors) : end($ancestors));
                } else {
                    $child_of = $post->ID;
                }
            } elseif (count($ancestors) > 1) {
                array_pop($ancestors); // remove last item
                $child_of = end($ancestors);
            } else {
                $child_of = $post->ID;
            }
        }

        return wp_list_pages('title_li='. $title_li .'&child_of='. $child_of .'&depth='. $depth .'&echo=0');
    }

    /**
     * Edit wp_list_pages output
     * @param  string $output actual output of wp_list_pages
     * @param  array $r      not sure exactly
     * @param  array $pages  WP Post array
     * @return string         new output for wp_list_pages
     */
    protected function editListPages()
    {
        add_filter('wp_list_pages', function ($output, $r, $pages) {
            $depth = $r['depth'];
            $list = ($r['title_li'] ? $r['title_li'] : '');

            foreach ($pages as $page) {
                if (count($page->ancestors) < ($depth+1)) {
                    $list .= '
                        <li class="__item '
                            . $this->isActive($page->ID) .' '. $this->hasChildren($page->ID) .'">
                            <a class="__link ' . $this->isActive($page->ID) .'" href="'. get_permalink($page->ID) .'">'
                                . self::getPageTitle($page->ID) .
                            '</a>'
                            . $this->getChildren($page->ID) .
                        '</li>
                    ';
                }
            }
            return $list;
        }, 20, 3);
    }

    /**
     * Check to see if current page is active
     * @param  int  $id current post ID
     * @return string     active class name
     */
    private function isActive($id)
    {
        global $post;

        return ($post->ID == $id || in_array($id, $post->ancestors)  ? '--active' : '');
    }

    /**
     * Check to see if page has children
     * @param  int  $id current post ID
     * @return string     class name for has children
     */
    private function hasChildren($id)
    {
        global $post;
        $pages = get_children(['post_parent' => $id, 'post_type' => 'page']);

        return ($pages ? '+children' : '');
    }

    /**
     * Gets the child pages of parent
     * @param  int $id      current post Id
     * @return string       output for list of child pages
     */
    private function getChildren($id)
    {
        $list = '';
        $pages = get_children(['post_parent' => $id, 'post_type' => 'page', 'order' => 'ASC', 'orderby' => 'menu_order', 'depth' => 1]);

        if ($pages) {
            $list .= '<ul class="__list">';
            foreach ($pages as $page) {
                $list .= '
                    <li class="__item '. $this->isActive($page->ID) .'">
                        <a class="__link" href="'. get_permalink($page->ID) .'">'
                            . $page->post_title .
                        '</a>
                    </li>
                ';
            }
            $list .= '</ul>';
        }
        return $list;
    }

    /**
     * Gets the child pages of parent
     * @param  int $id      current post Id
     * @return string       output for list of child pages
     */
    public static function getPageTitle($id)
    {
        if (get_field('bool_nav_override', $id)) {
            return get_field('txt_nav_label', $id);
        }

        return get_the_title($id);
    }

    /**
     * Determine whether current page or an ancestor is a banner
     * @param  string $field ACF field to use
     * @return boolean
     */
    public static function isBanner($field = 'bool_header_nav')
    {
        // check is parent has banner
        $ancestor_ids = get_post_ancestors(get_the_id());
        $inherit_id = get_the_id();

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
        }

        return get_field($field, $inherit_id);
    }

    /**
     * Determine whether the banner should have an interior nav
     * @return boolean
     */
    public static function isBannerSubnav()
    {
        $ancestors = get_post_ancestors(get_the_id());
        $children = get_children(['post_parent' => get_the_id(), 'post_type' => 'page']);

        if ($ancestors) {
            if ($children || count($ancestors) > 1) {
                return true;
            }
        }
    }
}
