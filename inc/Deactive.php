<?php
namespace Inc;
class Deactive{
    public static function deactive()
    {
        flush_rewrite_rules();
    }
}
