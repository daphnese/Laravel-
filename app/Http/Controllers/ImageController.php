<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

//        dd($request->file('image'));

        // Generate a unique name using UUID
        $uuid = (string) Str::uuid();
        $extension = $request->file('image')->extension();
        $filename = "{$uuid}.{$extension}";

        // Store the image
        $path = $request->file('image')->storeAs('images', $filename, 'public');

        return response()->json([
            'name' => basename($path),
            'extension' => $request->file('image')->extension(),
            'url' => asset('storage/' . $path),
        ]);
    }

    public function getImage($name)
    {
        $path = storage_path('app/images/' . $name);

        if (!file_exists($path)) {
            return response()->json(['error' => 'Image not found'], 404);
        }

        return response()->json([
            'name' => $name,
            'url' => Storage::url('images/' . $name),
            'extension' => pathinfo($path, PATHINFO_EXTENSION),
        ]);
    }

    public function getAllImages()
    {
        $files = Storage::files('images');
        $images = [];

        foreach ($files as $file) {
            $images[] = [
                'name' => basename($file),
                'url' => Storage::url($file),
                'extension' => pathinfo($file, PATHINFO_EXTENSION),
            ];
        }

        return response()->json($images);
    }

    public function deleteImage($name)
    {
        $path = 'images/' . $name;

        if (!Storage::exists($path)) {
            return response()->json(['error' => 'Image not found'], 404);
        }

        Storage::delete($path);

        return response()->json(['message' => 'Image deleted successfully']);
    }
}
