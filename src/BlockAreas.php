<?php

namespace elf02\Gust;

use elf02\Gust\Attributes\Hook;
use elf02\Gust\Contracts\Hookable;

class BlockAreas implements Hookable
{
    #[Hook('init')]
    public function register_cpt()
    {
        $labels = [
            'name'               => __('Block Areas', 'gust'),
            'singular_name'      => __('Block Area', 'gust'),
            'add_new'            => __('Add New', 'gust'),
            'add_new_item'       => __('Add New Block Area', 'gust'),
            'edit_item'          => __('Edit Block Area', 'gust'),
            'new_item'           => __('New Block Area', 'gust'),
            'view_item'          => __('View Block Area', 'gust'),
            'search_items'       => __('Search Block Areas', 'gust'),
            'not_found'          => __('No Block Areas found', 'gust'),
            'not_found_in_trash' => __('No Block Areas found in Trash', 'gust'),
            'parent_item_colon'  => __('Parent Block Area:', 'gust'),
            'menu_name'          => __('Block Areas', 'gust'),
        ];

        $args = [
            'labels'              => $labels,
            'hierarchical'        => false,
            'supports'            => ['title', 'editor', 'revisions'],
            'public'              => false,
            'publicly_queryable'  => is_admin(),
            'show_ui'             => true,
            'show_in_rest'        => true,
            'exclude_from_search' => true,
            'has_archive'         => false,
            'query_var'           => true,
            'can_export'          => true,
            'rewrite'             => false,
            'menu_icon'           => 'dashicons-layout',
            'show_in_menu'        => 'themes.php',
        ];

        register_post_type('block_area', $args);
    }

    #[Hook('pre_render_block')]
    public function frontend_query_vars($pre_render, $parsed_block)
    {
        if (
            isset(
                $parsed_block['attrs']['namespace'],
                $parsed_block['attrs']['query']['postType'],
                $parsed_block['attrs']['query']['include'][0]
            ) &&
            $parsed_block['attrs']['namespace'] === 'gust/block-areas-query-loop' &&
            $parsed_block['attrs']['query']['postType'] === 'block_area'
        ) {
            add_filter(
                'query_loop_block_query_vars',
                function ($query) use ($parsed_block) {
                    return [
                        'post_type' => 'block_area',
                        'p' => intval($parsed_block['attrs']['query']['include'][0])
                    ];
                }
            );
        }

        return $pre_render;
    }
}
