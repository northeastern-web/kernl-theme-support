<?php

namespace Kernl\Lib;

class Utility
{
    /**
     * Loads the a file within views/templates
     * @param  string $file path to file in views/templates
     * @return ob_get_contents
     */
    public static function getTemplate($path, $data)
    {
        // Sage function to locate compiled template
        $location = locate_template('views/templates/'. $path .'.blade.php');

        ob_start();
        extract($data);
        include \App\template_path($location);
        $contents = ob_get_contents();
        ob_end_clean();

        return $contents;
    }

    /**
     * Remove empty paragraph tags
     * @param  string   $content
     * @return string
     */
    public static function removeEmptyParagraphs($content)
    {
        $content = force_balance_tags($content);
        $content = preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
        $content = preg_replace('~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content);
        return $content;
    }

    /**
     * Get full Tribe Events date
     * @param  string   $content
     * @return string
     */
    public static function getTribeDate($id, $format = 'M j, Y | g:i A')
    {
        // Remove time format if event is all day
        if (tribe_event_is_all_day()) {
            $format = 'M j, Y';
        }

        // Get start and end dates
        $start_date = tribe_get_start_date($id, false, $format);
        $end_date = tribe_get_end_date($id, false, $format);

        // Return multiday format
        if (tribe_event_is_multiday()) {
            return $start_date .' &mdash; '. $end_date;
        }

        // Return single day format
        return $start_date;
    }
}
