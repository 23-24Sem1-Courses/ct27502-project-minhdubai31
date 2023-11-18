<?php 

namespace App\Controllers;

use App\Models\Type;

class TypeController {

    // Insert new type
    // POST: /types/store
    public function store() {
        // Get data from user
        $typeData = [
            "type_name" => $_POST["type_name"]
        ];

        // Create new type
        $type = new Type();
        $type->create($typeData);

        return back();
    }


    // Delete a type
    // POST: /types/delete
    public function destroy() {
        Type::find($_POST["type_id"])->delete();

        return back();
    }

    
    // Update a type
    // POST: /types/update
    public function update() {
        // Get new name of the type
        $typeData = [
            "type_name" => $_POST["type_name"]
        ];

        // Update it
        Type::find($_POST["type_id"])->update($typeData);

        return back();
    }
}