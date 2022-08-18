<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

$data = [];

class ImageController extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        return response()->json([
            "status" => true,
            "message" => "get action"
        ], 200);
    }
    public function get($id) {
        return response()->json([
            "status" => true,
            "message" => "get id action",
            "id" => $id
        ], 200);
    }
    public function add() {
        $groupByEntry = function (&$arr) {
            $entry = [];
            $first_value = current($arr);
            if (is_array($first_value)) {
                $count = count($first_value);

                foreach ($arr as $key => $column_values) {
                    for ($i = 0; $i < $count; $i++) {
                        $entry[$i][$key] = $column_values[$i];
                    };
                };
                $arr = $entry;
            } else {
                $arr = [$entry];
            }
        };

        $target_dir = __DIR__ . "/uploads";
        $images = $_FILES['images'];
        $groupByEntry($images);
        $count = 0;
        global $data;
        foreach ($images as $image) {
            $target_file = $target_dir . basename($image['name']);
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $size = getimagesize($image["tmp_name"]);
            if ($size) {
                $count++;
                Storage::disk("local")->put($image['name'], file_get_contents($image["tmp_name"]));
            }
        }
        $output = [
            "status" => true,
            "message" => "add action",
            "count" => $count,
            "data" => $_POST,
            "files" => $images,
        ];

        return response()->json($output, 200);
    }
}