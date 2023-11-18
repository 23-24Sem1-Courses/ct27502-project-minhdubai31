<?php

use Twig\Environment;
use Twig\TwigFunction;
use Twig\Loader\FilesystemLoader;


// Redirect to a location
function redirect($location)
{
    header('Location: ' . $location);
    exit;
}


// Go back to the previous page
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


// Display view
function view($viewpath, array $data = [])
{
    $loader = new FilesystemLoader(__DIR__ . '/../../resources/views');
    $twig = new Environment($loader);

    // Define a custom function to handle assets
    $function_asset = new TwigFunction('asset', function ($asset) {
        $file_path = PUBLIC_PATH . $asset;
        if (is_file($file_path))
            return '/' . ltrim($asset, '/');;
        return false;
    });

    // Define a custom function to find number of decimal degits in float number
    $function_custom_number_format = new TwigFunction('custom_number_format', function ($number, $delimiter = ".") {
        return number_format($number, (int) strpos(strrev($number), $delimiter), ",", ".");
    });


    // Add custom functions to twig
    $twig->addFunction($function_asset);
    $twig->addFunction($function_custom_number_format);

    return $twig->display($viewpath, $data);
}


// Save uploaded file to storage
function storeUploadedFile($fileInputName, $targetDirectory = __DIR__ . "/../../public/uploads/")
{
    // Check if the file was uploaded without errors
    if (isset($_FILES[$fileInputName])) {
        // Get file extension
        $extension = pathinfo($_FILES[$fileInputName]["name"], PATHINFO_EXTENSION);

        // Generate random binary data
        $randomBytes = random_bytes(10);

        // Convert binary data to hexadecimal representation
        $randomString = bin2hex($randomBytes);

        // Generate a filename based on current timestamp and random string
        $newFileName = $randomString . time() . '.' . $extension;

        $targetFile = $targetDirectory . $newFileName;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile)) {
            return $newFileName;
        }
    }
}


// Save list of uploaded files to storage
function storeUploadedList($arrayInputName, $targetDirectory = __DIR__ . "/../../public/uploads/")
{
    // Check if the file was uploaded without errors
    if (is_array($_FILES[$arrayInputName]["name"])) {
        $savedFile = [];

        for ($i = 0; $i < count($_FILES[$arrayInputName]["name"]); $i++) {
            // Get file extension
            $extension = pathinfo($_FILES[$arrayInputName]["name"][$i], PATHINFO_EXTENSION);

            // Generate random binary data
            $randomBytes = random_bytes(10);

            // Convert binary data to hexadecimal representation
            $randomString = bin2hex($randomBytes);

            // Generate a filename based on current timestamp and random string
            $newFileName = $randomString . time() . '.' . $extension;

            $targetFile = $targetDirectory . $newFileName;

            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES[$arrayInputName]["tmp_name"][$i], $targetFile)) {
                $savedFile[] = $newFileName;
            }
        }

        return $savedFile;
    }
}
