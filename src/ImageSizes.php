<?php

namespace elf02\Gust;

use elf02\Gust\Attributes\Hook;
use elf02\Gust\Contracts\Hookable;

class ImageSizes implements Hookable
{
    #[Hook('init')]
    public function register_image_sizes()
    {
        add_image_size('gust-lg', 2048, 1152, true);
    }

    #[Hook('image_size_names_choose')]
    public function image_sizes_names(array $sizes)
    {
        $sizes['gust-lg'] = __('16:9 (Landscape)', 'gust');

        return $sizes;
    }

    #[Hook('post_thumbnail_size', 5)]
    public function post_thumbnail_size(string $size)
    {
        return $size === 'post-thumbnail' ? 'gust-lg' : $size;
    }
}
