<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();
            if(isset($data['tags_id'])) {
                $tagsId = $data['tags_id'];
                unset($data['tags_id']);
            }

            if (isset($data['preview_image'])) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }
            if(isset($data['main_image'])) {
                $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            }
            //Category::create($data);
            //dd($data);
            $post = Post::firstOrCreate($data);
            if(isset($tagsId)) {
                $post->tags()->attach($tagsId);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }

    }

    public function update($data, $post)
    {
        try {
            DB::beginTransaction();
            if(isset($data['tags_id'])) {
                $tagsId = $data['tags_id'];
                unset($data['tags_id']);
            }

            if (isset($data['preview_image'])) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }
            if (isset($data['main_image'])) {
                $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            }
            //$post = Post::firstOrCreate($data);
            $post->update($data);
            if(isset($tagsId)) {
                $post->tags()->sync($tagsId);
            }
            DB::commit();
            return $post;
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

}
