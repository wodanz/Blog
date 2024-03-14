<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Models\Post;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        //dd($data);
        //Category::create($data);
        Post::firstOrCreate($data);
        return redirect()->route('admin.post.index');
    }

}
