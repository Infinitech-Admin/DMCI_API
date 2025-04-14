<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\Uploadable;
use Laravel\Sanctum\PersonalAccessToken;

use App\Models\Video as Model;

class VideoController extends Controller
{
    use Uploadable;

    public $model = "Video";

    public function getAll(Request $request)
    {
        $user =  PersonalAccessToken::findToken($request->bearerToken())->tokenable;
        if ($user->type == "Admin") {
            $records = Model::with('user')->orderBy('updated_at', 'desc')->get();
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
            'name' => 'required',
            'video' => 'required',
            'thumbnail' => 'required',
        ]);

        $key = 'video';
        if ($request->hasFile($key)) {
            $validated[$key] = $this->upload($request->file($key), "videos");
        }
        $key = 'thumbnail';
        if ($request->hasFile($key)) {
            $validated[$key] = $this->upload($request->file($key), "videos");
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
            'id' => 'required|exists:videos,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'video' => 'nullable',
            'thumbnail' => 'nullable',
        ]);

        $record = Model::find($validated['id']);

        $key = 'video';
        if ($request->hasFile($key)) {
            Storage::disk('s3')->delete("videos/$record[$key]");
            $validated[$key] = $this->upload($request->file($key), "videos");
        }

        $key = 'thumbnail';
        if ($request->hasFile($key)) {
            Storage::disk('s3')->delete("videos/$record[$key]");
            $validated[$key] = $this->upload($request->file($key), "videos");
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
            Storage::disk('s3')->delete("videos/$record->video");
            Storage::disk('s3')->delete("videos/$record->thumbnail");


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
}
