<?php

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

function redirect($location)
{
    header('Location: ' . $location);
    exit;
}

function back()
{
    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        // If the HTTP_REFERER is not set, redirect to homepage
        header("Location: /");
    }
    exit;
}

function view($viewpath, array $data = []) {
    $loader = new FilesystemLoader(__DIR__ . '/../../resources/views');
    $twig = new Environment($loader);

    return $twig->display($viewpath, $data);
}
