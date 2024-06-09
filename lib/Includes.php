<?php

namespace lib;

class Includes
{
    static public function import_page(string $path)
    {
        Includes::import_lib("Display");

    }

    static public function import_lib(string $path)
    {
        $root = APP_ROOT;
        $template = "$root/lib/$path.php";
        if (file_exists($template)) {
            return require_once realpath($template);
        } else if (file_exists($path)) {
            return require_once realpath($path);
        } else {
            return null;
        }
    }

    static public function import_template(string $path, array $data): array|false|string
    {
        $patterns = array_map("Includes::mask", array_keys($data));
        $templatePattern = '/<component src="([^"]+)" \/>/';
        return preg_replace_callback($templatePattern
            function ($matches) {
                foreach ($matches as $match) {
                    $match
                }
            },
            str_replace($patterns, $data, file_get_contents($path)));
    }


    static private function mask($value): string
    {
        return sprintf("{%s}", $value);
    }
}
