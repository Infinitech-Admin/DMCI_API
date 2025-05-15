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
        $user = PersonalAccessToken::findToken($request->bearerToken())->tokenable;

        if ($user->type == "Admin") {
            $records = Model::with('user')->orderBy('updated_at', 'desc')->get();
        } else if ($user->type == "Agent") {
            $records = Model::with('user')->where('user_id', $user->id)->orderBy('updated_at', 'desc')->get();
        }

        return response()->json([
            'message' => "Fetched {$this->model}s",
            'records' => $records
        ], 200);
    }

    public function get($id)
    {
        $record = Model::with('user')->find($id);

        if ($record) {
            return response()->json([
                'message' => "Fetched {$this->model}",
                'record' => $record
            ], 200);
        }

        return response()->json([
            'message' => "{$this->model} Not Found"
        ], 404);
    }

   public function create(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'name' => 'required',
        'video' => 'required|file|mimetypes:video/mp4,video/avi,video/mpeg',
        'thumbnail' => 'required|file|image',
    ]);

    // Single base name for both files
    $baseFilename = uniqid('video_') . '_' . time();

    // Save video
    if ($request->hasFile('video')) {
        $videoFile = $request->file('video');
        $videoName = $baseFilename . '.' . $videoFile->getClientOriginalExtension();
        $videoFile->move(public_path('video'), $videoName);
        $validated['video'] = $videoName;
    }

    // Save thumbnail
    if ($request->hasFile('thumbnail')) {
        $thumbFile = $request->file('thumbnail');
        $thumbName = $baseFilename . '_thumb.' . $thumbFile->getClientOriginalExtension();
        $thumbFile->move(public_path('video'), $thumbName);
        $validated['thumbnail'] = $thumbName;
    }

    $record = Model::create($validated);

    return response()->json([
        'message' => "Created {$this->model}",
        'record' => $record
    ], 201);
}


   public function update(Request $request)
{
    $validated = $request->validate([
        'id' => 'required|exists:videos,id',
        'user_id' => 'required|exists:users,id',
        'name' => 'required',
        'video' => 'nullable|file|mimetypes:video/mp4,video/x-matroska,video/avi,video/webm',
        'thumbnail' => 'nullable|file|image',
    ]);

    $record = Model::find($validated['id']);

    // Delete old video file if new video uploaded
    if ($request->hasFile('video')) {
        $oldVideoPath = public_path('video/' . $record->video);
        if (file_exists($oldVideoPath)) {
            unlink($oldVideoPath);
        }

        $videoFile = $request->file('video');
        $videoName = time() . '_' . uniqid() . '.' . $videoFile->getClientOriginalExtension();
        $videoFile->move(public_path('video'), $videoName);
        $validated['video'] = $videoName;
    } else {
        // Keep existing video filename if no new video uploaded
        $validated['video'] = $record->video;
    }

    // Delete old thumbnail file if new thumbnail uploaded
    if ($request->hasFile('thumbnail')) {
        $oldThumbPath = public_path('video/' . $record->thumbnail);
        if (file_exists($oldThumbPath)) {
            unlink($oldThumbPath);
        }

        $thumbFile = $request->file('thumbnail');
        $thumbName = time() . '_' . uniqid() . '.' . $thumbFile->getClientOriginalExtension();
        $thumbFile->move(public_path('video'), $thumbName);
        $validated['thumbnail'] = $thumbName;
    } else {
        // Keep existing thumbnail filename if no new thumbnail uploaded
        $validated['thumbnail'] = $record->thumbnail;
    }

    $record->update([
        'name' => $validated['name'],
        'video' => $validated['video'],
        'thumbnail' => $validated['thumbnail'],
        'user_id' => $validated['user_id'],
    ]);

    return response()->json([
        'message' => "Updated {$this->model}",
        'record' => $record,
    ], 200);
}

    public function delete($id)
    {
        $record = Model::find($id);

        if ($record) {
            Storage::disk('public')->delete("videos/{$record->video}");
            Storage::disk('public')->delete("videos/{$record->thumbnail}");
            $record->delete();

            return response()->json([
                'message' => "Deleted {$this->model}"
            ], 200);
        }

        return response()->json([
            'message' => "{$this->model} Not Found"
        ], 404);
    }
}
