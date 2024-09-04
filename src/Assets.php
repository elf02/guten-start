<?php

namespace elf02\Gust;

use elf02\Gust\Attributes\Hook;
use elf02\Gust\Contracts\Hookable;

class Assets implements Hookable
{
    #[Hook('after_setup_theme')]
    public function add_editor_styles()
    {
        add_editor_style([
            get_parent_theme_file_uri('public/css/screen.css')
        ]);
    }

    #[Hook('enqueue_block_editor_assets')]
    public function enqueue_editor_assets()
    {
        $js = include get_parent_theme_file_path('public/js/editor.asset.php');
        $css  = include get_parent_theme_file_path('public/css/editor.asset.php');

        wp_enqueue_script(
            'gust-editor',
            get_parent_theme_file_uri('public/js/editor.js'),
            $js['dependencies'],
            $js['version'],
            true
        );

        wp_enqueue_style(
            'gust-editor',
            get_parent_theme_file_uri('public/css/editor.css'),
            $css['dependencies'],
            $css['version']
        );
    }

    #[Hook('init')]
    public function enqueue_block_styles()
    {
        foreach (glob(get_parent_theme_file_path('/public/css/blocks/*[!{-rtl}].css')) as $block_style_path) {
            [$namespace, $slug] = explode('_', basename($block_style_path, '.css'));
            $asset = include str_swap($block_style_path, ['.css' => '.asset.php']);

            wp_enqueue_block_style("{$namespace}/{$slug}", [
                'handle' => "gust-blockstyle-{$namespace}-{$slug}",
                'src' => get_parent_theme_file_uri("public/css/blocks/{$namespace}_{$slug}.css"),
                'path' => $block_style_path,
                'deps' => $asset['dependencies'],
                'ver' => $asset['version']
            ]);
        }
    }

    #[Hook('wp_enqueue_scripts')]
    public function enqueue_assets()
    {
        $js = include get_parent_theme_file_path('public/js/screen.asset.php');
        $css = include get_parent_theme_file_path('public/css/screen.asset.php');

        wp_enqueue_script(
            'gust-screen',
            get_parent_theme_file_uri('public/js/screen.js'),
            $js['dependencies'],
            $js['version'],
            true
        );

        wp_enqueue_style(
            'gust-screen',
            get_parent_theme_file_uri('public/css/screen.css'),
            $css['dependencies'],
            $css['version']
        );
    }
}
