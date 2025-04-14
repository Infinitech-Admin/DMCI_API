<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Uploadable;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Storage;
use App\Models\PropertyListings as Model;

class PropertyListingsController extends Controller
{
    use Uploadable;

    public $model = "Property Listings";

    public function getAll(Request $request)
    {
        $user =  PersonalAccessToken::findToken($request->bearerToken())->tokenable;
        $relations = ['user', 'property.buildings', 'property.features', 'property.facilities', 'property.plan', 'property.units'];
        if ($user->type == "Admin") {
            $records = Model::with($relations)->orderBy('created_at', 'desc')->get();
        } else if ($user->type == "Agent") {
            $records = Model::with($relations)->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        }
        $code = 200;
        $response = ['message' => "Fetched Properties", 'records' => $records];
        return response()->json($response, $code);
    }

    public function get($id)
    {
        $relations = ['user', 'property.buildings', 'property.features', 'property.facilities', 'property.plan', 'property.units'];
        $record = Model::with($relations)->where('id', $id)->first();
        if ($record) {
            $code = 200;
            $response = ['message' => "Fetched $this->model", 'record' => $record];
        } else {
            $code = 404;
            $response = ['message' => "$this->model Not Found"];
        }
        return response()->json($response, $code);
    }


    // Create New Properties
    public function create(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'property_location' => 'required|max:255',
            'property_type' => 'required|max:255',
            'property_size' => 'required|decimal:0,2',
            'property_price' => 'required|decimal:0,2',
            'property_building' => 'required|max:255',
            'property_parking' => 'required|max:255',
            'property_description' => 'required',
            'property_level' => 'required|max:255',
            'property_amenities' => 'required',
            'images' => 'required',
            'property_plan_type' => 'required|max:255',
            'property_plan_cut' => 'required|max:255',
            'property_plan_status' => 'required|max:255',
            'property_plan_image' => 'required',
        ]);

        $validated['property_featured'] = false;

        $key = 'images';
        if ($request[$key]) {
            $images = [];
            foreach ($request[$key] as $image) {
                array_push($images, $this->upload($image, "properties/images"));
            }
            $validated[$key] = json_encode($images);
        }

        $key = 'property_plan_image';
        if ($request->hasFile($key)) {
            $validated[$key] = $this->upload($request->file($key), "properties/images");
        }
        

        $record = Model::create($validated);

        $relations = ['user', 'property.buildings', 'property.features'];
        $record = Model::with($relations)->where('id', $record->id)->first();

        $code = 201;
        $response = [
            'message' => "Created $this->model",
            'record' => $record,
        ];
        return response()->json($response, $code);
    }

    // Update

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:property_listings,id',
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'property_location' => 'required|max:255',
            'property_type' => 'required|max:255',
            'property_size' => 'required|decimal:0,2',
            'property_price' => 'required|decimal:0,2',
            'property_building' => 'required|max:255',
            'property_parking' => 'required|max:255',
            'property_description' => 'required',
            'property_level' => 'required|max:255',
            'property_amenities' => 'required',
            'images' => 'nullable',
            'property_plan_type' => 'required|max:255',
            'property_plan_cut' => 'required|max:255',
            'property_plan_status' => 'required|max:255',
            'property_plan_image' => 'required',
        ]);

        $key = 'images';
        if ($request[$key]) {
            $images = [];
            foreach ($request[$key] as $image) {
                array_push($images, $this->upload($image, "properties/images"));
            }
            $validated[$key] = json_encode($images);
        }

        $record = Model::find($validated['id']);
    
        $key = 'property_plan_image';
        if ($request->hasFile($key)) {
            Storage::disk('s3')->delete("properties/images/$record[$key]");
            $validated[$key] = $this->upload($request->file($key), "properties/images");
        }

        $record->update($validated);


        $relations = ['user', 'property.buildings', 'property.features'];
        $record = Model::with($relations)->where('id', $record->id)->first();

        $code = 201;
        $response = [
            'message' => "Created $this->model",
            'record' => $record,
        ];
        return response()->json($response, $code);
    }

    // Delete Property

    public function delete($id)
    {
        $record = Model::find($id);
        if ($record) {
            Storage::disk('s3')->delete("properties/logos/$record->logo");

            $images = json_decode($record->images);
            foreach ($images as $image) {
                Storage::disk('s3')->delete("properties/images/$image");
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

    public function set(Request $request, $id)
    {
        $user =  PersonalAccessToken::findToken($request->bearerToken())->tokenable;

        $record = Model::find($id);
        $isFeatured = $record->property_featured;

        Model::where('user_id', $user->id)->update(['property_featured' => false]);

        if ($record) {
            $record->update(['property_featured' => !$isFeatured]);
            $code = 200;
            $response = ['message' => "Set $this->model as Featured", 'record' => $record];
        } else {
            $code = 404;
            $response = ['message' => "Property Not Found", 'record' => $record];
        }

        return response()->json($response, $code);
    }
}
