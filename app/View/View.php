<?php

namespace app\View;

use app\Core\Config;
use Jenssegers\Blade\Blade;

class View
{
    /**
     * @param string $view
     * @param array $data
     * @return void
     */
    public static function render(string $view, array $data = []): void
    {
        $blade = new Blade(Config::FILE_CACHE, 'cache');
        echo $blade->render($view, $data);
    }

    /**
     * @param array $errors
     * @return void
     */
    public static function json(array $errors): void
    {
        echo json_encode($errors);
    }
}