<?php 

namespace App\Controllers;

use App\Models\View;
use App\Models\Motor;

class HomeController {
    // GET: /
    public function index() {
        // Search result page
        // Check if has search parameter
        if(isset($_GET["search"])) {
            // Get all motors have name or type name like search text
            $result_motors = Motor::where('mt_name', 'like', '%' . $_GET['search'] . '%')
                ->orWhereHas('type', function ($query) {
                    $query->where('type_name', 'like', '%' . $_GET['search'] . '%');
                })
                ->get();

            return view("home/search_result.twig", [
                "motors" => $result_motors,
                "search" => $_GET['search']
            ]);
        }

    
        // Homepage
        // Get 8 motors have highest views last month
        $last_month = date("Y-m-d H:i:s", strtotime('-1 month'));
        $views_count = View::where('created_at', '>=', $last_month)
            ->select("mt_id")
            ->selectRaw("count(*) as total_views")
            ->groupBy("mt_id")
            ->orderByDesc("total_views")
            ->take(8) // 8 motors
            ->get();
        
        // Loop through all results and sum up Motor models
        foreach ($views_count as $motor) {
            $hot_motors[] = Motor::find($motor["mt_id"]);
        }

        return view("home/index.twig", [
            "hot_motors" => $hot_motors
        ]);
    }
}