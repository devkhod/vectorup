<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $file = $request->file('image');

        $name = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs('articles', $name, 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }
}
