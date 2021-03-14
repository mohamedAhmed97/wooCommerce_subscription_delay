<?php

namespace Inc;

class Active
{
    public static function active()
    {
        flush_rewrite_rules();
    }
}
