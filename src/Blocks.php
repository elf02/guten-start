<?php

namespace elf02\Gust;

use elf02\Gust\Attributes\Hook;
use elf02\Gust\Contracts\Hookable;

class Blocks implements Hookable
{
    #[Hook('init')]
    public function register_block_types()
    {
        foreach (glob(get_parent_theme_file_path('/public/blocks/*'), GLOB_ONLYDIR) as $block_path) {
            register_block_type($block_path);
        }
    }

    //#[Hook('default_wp_template_part_areas')]
    public function template_part_areas(array $areas)
    {
        $custom_areas = [
            [
                'area' => 'sidebar',
                'area_tag' => 'section',
                'label' => __('Sidebar', 'gust'),
                'description' => __('Sidebar', 'gust'),
                'icon' => 'sidebar',
            ]
        ];

        return [
            ...$areas,
            ...$custom_areas
        ];
    }

    #[Hook('init')]
    public function pattern_categories()
    {
        $block_pattern_categories = [
            'gust/sections' => [
                'label' => __('Sections', 'gust'),
            ],
        ];

        foreach ($block_pattern_categories as $name => $properties) {
            register_block_pattern_category($name, $properties);
        }
    }
}
