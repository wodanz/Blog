<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Models\Category;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        //dd($data);
        //Category::create($data);
        Category::firstOrCreate($data);
        return redirect()->route('admin.category.index');
    }

}
