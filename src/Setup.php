<?php

namespace elf02\Gust;

use elf02\Gust\Attributes\Hook;
use elf02\Gust\Contracts\Hookable;

class Setup implements Hookable
{
    #[Hook('after_setup_theme')]
    public function theme_support()
    {
        remove_theme_support('core-block-patterns');
    }

    #[Hook('phpmailer_init')]
    public function smtp_mailpit($phpmailer)
    {
        if (local_env()) {
            $phpmailer->IsSMTP();
            $phpmailer->Host = '127.0.0.1';
            $phpmailer->Port = 1025;
            $phpmailer->Username = '';
            $phpmailer->Password = '';
            $phpmailer->SMTPAuth = true;
        }
    }
}
