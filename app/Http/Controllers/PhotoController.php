<?php

namespace App\Http\Controllers;

use App\Events\FeedbackAdded;
use App\{Photo, PhotoComment};

class PhotoController extends Controller
{
    public function show($url)
    {
        $photo = Photo::whereUrl($url)->firstOrFail();

        return view('image', compact('photo'));
    }

    public function comment(string $url)
    {
        $photo = Photo::whereUrl($url)->firstOrFail();

        $data = request()->validate([
            "comment" => "required|between:2,2000",
            "left" => "required|numeric|between:0,100",
            "top"  => "required|numeric|between:0,100",
        ]);

        $comment = $photo->comments()->save(new PhotoComment($data));

        event(new FeedbackAdded($photo->id, $comment->toArray()));

        return response()->json($comment);
    }

    public function upload()
    {
        request()->validate(['file' => 'required|image']);

        $gibberish = md5(str_random().time());

        $imgName = "{$gibberish}.".request('file')->getClientOriginalExtension();

        request('file')->move(public_path('storage'), $imgName);

        $photo = Photo::create(['image' => $imgName, 'url' => $gibberish]);

        return response()->json($photo->toArray());
    }
}
