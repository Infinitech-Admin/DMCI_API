<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\Uploadable;
use Laravel\Sanctum\PersonalAccessToken;

use App\Models\Listing as Model;

class ListingController extends Controller
{
    use Uploadable;

    public $model = "Listing";

    public function getAll(Request $request)
    {
        $user =  PersonalAccessToken::findToken($request->bearerToken())->tokenable;
        if ($user->type == "Admin") {
            $records = Model::with('user', 'property')->orderBy('updated_at', 'desc')->get();
        } else if ($user->type == "Agent") {
            $records = Model::with('user')->where('user_id', $user->id)->orderBy('updated_at', 'desc')->get();
        }
        $code = 200;
        $response = ['message' => "Fetched $this->model" . "s", 'records' => $records];
        return response()->json($response, $code);
    }

    public function get($id)
    {
        $record = Model::with('user')->where('id', $id)->first();
        if ($record) {
            $code = 200;
            $response = ['message' => "Fetched $this->model", 'record' => $record];
        } else {
            $code = 404;
            $response = ['message' => "$this->model Not Found"];
        }
        return response()->json($response, $code);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'building_id' => 'required|exists:buildings,id',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'unit_type' => 'required',
            'unit_price' => 'required|decimal:0,2',
            'status' => 'required',
            'description' => 'required',
            'images' => 'required',
            'furnish_status' => 'required',
            'item' => 'required',
            'unit_area' => 'required',
            'unit_cut' => 'required',
        ]);

        $keyImages = 'images'; 
        $keyItems = 'item';    
        
        // Handle images
        if ($request[$keyImages]) {
            $images = [];
            foreach ($request[$keyImages] as $image) {
                array_push($images, $this->upload($image, "listings")); // Upload and add to array
            }
            $validated[$keyImages] = json_encode($images);
        }
        
        // Handle items
        elseif ($request[$keyItems]) {
            $items = [];
            foreach ($request[$keyItems] as $item) {
                array_push($items, $item);
            }
            $validated[$keyItems] = json_encode($items); 
        }
        
        

        $record = Model::create($validated);
        $code = 201;
        $response = [
            'message' => "Created $this->model",
            'record' => $record,
        ];
        return response()->json($response, $code);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:listings,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'unit_name' => 'required',
            'unit_type' => 'required',
            'unit_location' => 'required',
            'unit_price' => 'required|decimal:0,2',
            'status' => 'required',
            'description' => 'required',
            'images' => 'nullable',
        ]);

        $record = Model::find($validated['id']);

        $key = 'images';
        if ($request[$key]) {
            $images = json_decode($record[$key]);
            foreach ($images as $image) {
                Storage::disk('s3')->delete("listings/$image");
            }

            $images = [];
            foreach ($request[$key] as $image) {
                array_push($images, $this->upload($image, "listings"));
            }
            $validated[$key] = json_encode($images);
        }

        $record->update($validated);
        $code = 200;
        $response = ['message' => "Updated $this->model", 'record' => $record];
        return response()->json($response, $code);
    }

    public function delete($id)
    {
        $record = Model::find($id);
        if ($record) {
            $images = json_decode($record->images);
            foreach ($images as $image) {
                Storage::disk('s3')->delete("listings/$image");
            }

            $record->delete();
            $code = 200;
            $response = [
                'message' => "Deleted $this->model"
            ];
        } else {
            $code = 404;
            $response = ['message' => "$this->model Not Found"];
        }
        return response()->json($response, $code);
    }

    public function changeStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:listings,id',
            'status' => 'required',
        ]);

        $record = Model::find($validated['id']);
        $record->update($validated);
        $code = 200;
        $response = ['message' => "Updated Status"];
        return response()->json($response, $code);
    }
}
