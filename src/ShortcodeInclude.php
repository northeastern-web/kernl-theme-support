<?php

namespace Kernl;

class ShortcodeInclude
{
    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        $this->shortcodeInclude();
        $this->addTinyMCE();
    }

    /**
     * Create WP shortcode [include file="/path/to/file"]
     * *Allows passing a query string
     * @return void
     */
    protected function shortcodeInclude()
    {
        add_shortcode('include', function ($atts) {
            extract(
                shortcode_atts(['file' => 'NULL'], $atts)
            );

            // check for query string of variables after file path
            if (strpos($file, "?")) {
                global $query_string;
                $qs_position = strpos($file, "?");
                $qs_values = str_replace("amp;", "", substr($file, $qs_position + 1));
                parse_str($qs_values, $query_string);

                // Remove query string from file
                $file = substr($file, 0, $qs_position);
            }

            $filepath = get_stylesheet_directory() .'/views/'. $file;

            // check if the file was specified and if the file exists
            if ($file != 'NULL' && file_exists($filepath)) {
                // turn on output buffering to capture script output
                ob_start();

                // include the specified file
                echo \App\template($filepath);

                // assign the file output to $content variable and clean buffer
                $content = ob_get_clean();

                return $content;
            }
        });
    }

    /**
     * Add button to TinyMCE
     * @return void
     */
    protected function addTinyMCE()
    {
        global $typenow;

        // Create button and add JS
        add_action('admin_head', function () {
            if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
                return;
            }

            // Create TinyMCE button
            add_filter('mce_buttons', function ($buttons) {
                array_push($buttons, 'includes_button');
                return $buttons;
            });

            add_filter("mce_external_plugins", function ($plugin_array) {
                $file = get_stylesheet_directory_uri() . '/../vendor/nupods/kernl-lib/src/assets/scripts/tinymce-include.js';
                $plugin_array['add_script'] = $file;
                return $plugin_array;
            });
        });

        // Send include list (may need to replicate for wp_ajax_nopriv_includes_request)
        add_action('wp_ajax_includes_request', function () {
            $dir = get_stylesheet_directory() .'/views/**/*.php';
            $files = glob($dir);
            $list = [];

            foreach ($files as $file) {
                $template = $this->getFileDocBlock($file);
                $filepath = substr($file, strpos($file, get_stylesheet_directory()) + strlen(get_stylesheet_directory()));
                if ($template) {
                    $list[] = [
                        'text' =>   $template[1],
                        'value' =>  str_replace("/views/", "", $filepath)
                    ];
                }
            }

            wp_send_json($list);
        });
    }

    /**
     * Get template name based on comment Doc Block in parenthesis
     * eg. (Template: Card)
     * @param  string $file path to file
     * @return string       returns template name
     */
    private function getFileDocBlock($file)
    {
        $docComments = array_filter(
            token_get_all(file_get_contents($file)),
            function ($entry) {
                return $entry[0] == T_DOC_COMMENT;
            }
        );
        $fileDocComment = array_shift($docComments);

        // Match pattern in parenthesis
        preg_match('#\((.*?)\)#', $fileDocComment[1], $templateName);
        return $templateName;
    }
}
