<?php 

namespace App\Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;


class BaseController {
    private $twig;
    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../views');
        $this->twig = new Environment($loader);
    }

    protected function view($viewpath, array $data = []) {
        return $this->twig->display($viewpath, $data);
    }
}
