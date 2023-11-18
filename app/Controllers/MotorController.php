<?php 

namespace App\Controllers;

use App\Models\Type;
use App\Models\View;
use App\Models\Color;
use App\Models\Image;
use App\Models\Motor;

class MotorController {

    // Products page
    // GET: /motors
    public function index() {
        // Check if has type filter
        if(isset($_GET["type"])) {
            $motors = Motor::where("type_id", $_GET["type"])->get();
            $type_filter = $_GET["type"];
        }
        else {
            $motors = Motor::all();
            $type_filter = null;
        }

        return view("motor/index.twig", [
            "types" => Type::all(),
            "motors" => $motors,
            "type_filter" => $type_filter
        ]);
    }


    // Create new motor page
    // GET: /motors/create
    public function create() {
        return view("motor/create.twig", [
            "types" => Type::all()
        ]);
    }


    // Motor detail page
    // GET: /motors/(\+d)
    public function show($mt_id) {
        // Increase view of the motor
        $view = new View();
        $view->create(["mt_id" => $mt_id]);

        return view("motor/show.twig", [
            "motor" => Motor::find($mt_id)
        ]);
    }


    // Insert new motor
    // POST: /motors/store
    public function store() {
        // Get data from user
        $motorData = [
            'mt_name' => $_POST['mt_name'],
            'mt_descr' => $_POST['mt_descr'],
            'mt_width' => $_POST['mt_width'],
            'mt_height' => $_POST['mt_height'],
            'mt_length' => $_POST['mt_length'],
            'mt_weight' => $_POST['mt_weight'],
            'mt_seat_height' => $_POST['mt_seat_height'],
            'mt_fuel' => $_POST['mt_fuel'],
            'mt_consumption' => $_POST['mt_consumption'],
            'mt_cc' => $_POST['mt_cc'],
            'type_id' => $_POST['type_id'],
            'mt_ground_clearance' => $_POST['mt_ground_clearance'],
            'mt_price' => $_POST['mt_price']
        ];
        
        // Save image to uploads folder
        $sample_img = storeUploadedFile("mt_sample_img");
        // Add "mt_sample_img" path to motorData
        $motorData["mt_sample_img"] = $sample_img;

        // Create new motor
        $motor = new Motor();
        $motor->fill($motorData);
        $motor->save();

        // Create new colors of motor
        $color = new Color();
        for ($i=0; $i < count($_POST['color_name']); $i++) { 
            // Get color info
            $colorData = [
                'color_name' => $_POST['color_name'][$i],
                'color_hex' => $_POST['color_hex'][$i],
                'mt_id' => $motor->mt_id
            ];

            // Create new color
            $color->create($colorData);
        }

        // Save all images in gallery to uploads folder
        $img_list = storeUploadedList('gallery');
        
        // Create new images of motor
        $image = new Image();
        for ($i=0; $i < count($img_list); $i++) { 
            // Get each image info
            $imageData = [
                'img_path' => $img_list[$i],
                'mt_id' => $motor->mt_id
            ];

            // Create new image
            $image->create($imageData);
        }

        return redirect('/manage');
    }


    // Delete a motor
    // POST: /motors/delete
    public function destroy() {
        // Get motor going to be deleted
        $delete_motor = Motor::find($_POST["mt_id"]);

        // Delete saved "mt_sample_img" from storage
        unlink(PUBLIC_PATH . "uploads/" . $delete_motor->mt_sample_img);

        // Delete all saved images
        foreach ($delete_motor->images as $image) {
            unlink(PUBLIC_PATH . "uploads/" . $image->img_path);
        }

        // Delete the motor
        $delete_motor->delete();

        return back();
    }


    // Edit a motor
    // GET: /motors/edit/(\+d)
    public function edit($mt_id) {
        return view("motor/edit.twig", [
            "motor" => Motor::find($mt_id),
            "types" => Type::all()
        ]);
    }


    // Update a motor
    // POST: /motors/update
    public function update() {
        // Get the motor going to be updated
        $curr_motor = Motor::find($_POST["mt_id"]);

        // Get new motor data from user
        $motorData = [
            'mt_name' => $_POST['mt_name'],
            'mt_descr' => $_POST['mt_descr'],
            'mt_width' => $_POST['mt_width'],
            'mt_height' => $_POST['mt_height'],
            'mt_length' => $_POST['mt_length'],
            'mt_weight' => $_POST['mt_weight'],
            'mt_seat_height' => $_POST['mt_seat_height'],
            'mt_fuel' => $_POST['mt_fuel'],
            'mt_consumption' => $_POST['mt_consumption'],
            'mt_cc' => $_POST['mt_cc'],
            'type_id' => $_POST['type_id'],
            'mt_ground_clearance' => $_POST['mt_ground_clearance'],
            'mt_price' => $_POST['mt_price']
        ];

        // Check if new "mt_sample_img" is uploaded
        if(is_uploaded_file($_FILES["mt_sample_img"]["tmp_name"])) {
            // Delete current "mt_sample_img" file
            unlink(PUBLIC_PATH . "uploads/" . $curr_motor->mt_sample_img);
            
            // Save new sample image and set the path in motorData
            $sample_img = storeUploadedFile("mt_sample_img");
            $motorData["mt_sample_img"] = $sample_img;
        }

        // Update the motor
        $curr_motor->update($motorData);

        // Delete all colors of motor
        foreach ($curr_motor->colors as $color) {
            $color->delete();
        }
        // Create new colors for the motor
        $color = new Color();
        for ($i=0; $i < count($_POST['color_name']); $i++) { 
            // Get color info
            $colorData = [
                'color_name' => $_POST['color_name'][$i],
                'color_hex' => $_POST['color_hex'][$i],
                'mt_id' => $curr_motor->mt_id
            ];

            // Create new color
            $color->create($colorData);
        }

        // Check deleted images list
        if(isset($_POST['deleted_img'])) {
            // Loop through every image and delete it from storage and database
            for ($i=0; $i < count($_POST['deleted_img']); $i++) { 
                // Delete from storage
                $image = Image::find($_POST['deleted_img'][$i]);
                unlink(PUBLIC_PATH . "uploads/" . $image->img_path);
                
                // Delete from database
                $image->delete();
            }
        }

        // Upload new images
        $gallery = new Image();
        // Save all uploaded images to storage
        $img_list = storeUploadedList('gallery');

        for ($i=0; $i < count($img_list); $i++) { 
            $galleryData = [
                'img_path' => $img_list[$i],
                'mt_id' => $curr_motor->mt_id
            ];

            // Create new image
            $gallery->create($galleryData);
        }

        return redirect("/manage");
    }
}