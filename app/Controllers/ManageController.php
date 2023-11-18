<?php 

namespace App\Controllers;

use App\Models\Type;
use App\Models\Motor;

class ManageController {
    // Manage page
    // GET: /manage
    public function index() {
        // Check if has type filter
        if(isset($_GET["type"])) {
            $types = [Type::find($_GET["type"])];
            $type_filter = Type::find($_GET["type"]);
        }
        else {
            $types = Type::all();
            $type_filter = null;
            // Get motors which are unknow type
            $returnData["unknowtype_motors"] = Motor::whereNull("type_id")->get();
        }

        $returnData["types"] = $types;
        $returnData["types_list"] = Type::all();
        $returnData["type_filter"] = $type_filter;

        return view("manage/index.twig", $returnData);
    }
}