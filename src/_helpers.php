<?php

namespace elf02\Gust;

use elf02\Gust\Contracts\Hookable;
use elf02\Gust\Attributes\Hook;

function theme(string $component = '')
{
    static $bindings = [];

    if (empty($bindings)) {
        $bindings = apply_filters('elf02/gust/components', [
            Setup::class => new Setup(),
            Assets::class => new Assets(),
            Blocks::class => new Blocks(),
            ImageSizes::class => new ImageSizes(),
        ]);

        // Hook attributes
        foreach ($bindings as $binding) {
            if (!$binding instanceof Hookable) {
                continue;
            }

            $reflect = new \ReflectionClass($binding::class);

            foreach ($reflect->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                $attributes = $method->getAttributes(
                    Hook::class,
                    \ReflectionAttribute::IS_INSTANCEOF
                );

                if (empty($attributes)) {
                    continue;
                }

                foreach ($attributes as $attribute) {
                    $hook = $attribute->newInstance();
                    $hook->add_hook($binding, $method);
                }
            }
        }
    }

    return $component === '' ? $bindings : $bindings[$component];
}

function str_swap(string $str, array $swap)
{
    return str_replace(array_keys($swap), array_values($swap), $str);
}

function local_env()
{
    return in_array(wp_get_environment_type(), ['local', 'development']);
}
