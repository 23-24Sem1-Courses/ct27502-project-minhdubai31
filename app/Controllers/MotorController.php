<?php 

namespace App\Controllers;

class MotorController {
    public function index() {
        return view("motor/index.twig");
    }

    public function create() {
        return view("motor/create.twig");
    }

    public function show() {
        return view("motor/show.twig");
    }
}