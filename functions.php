<?php

require_once get_parent_theme_file_path('/vendor/autoload.php');

// Boot...
add_action('after_setup_theme', '\elf02\Gust\theme', PHP_INT_MIN);