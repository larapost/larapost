<?php

namespace Larapost\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Larapost\Posts;
use Larapost\Categories;

class PostsController extends Controller
{
    public function index(Request $request, Posts $post)
    {
        $data = [];
        $data['statistics'] = $post->statistics();
        if (empty($request->status)) {
            $data['posts'] = $post->all();
        } else {
            $data['posts'] = $post->where([
                'status' => $request->status
            ])->all();
        }
        return view('larapost::posts.index', $data);
    }

    public function create(Posts $post, Categories $categories)
    {
        $data = [];
        $data['categories'] = $categories->all(true);
        // return $data;
        return view('larapost::posts.create', $data);
    }

    public function store(Request $request, Posts $post)
    {
        // return $request->categories_main;
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['id_author'] = 1;
        if (empty($request->published_at)) {
            $requestData['published_at'] = now();
        }
        $postCreate = $post->create($requestData);

        if ($request->has('categories_main')) {
            foreach ($request->categories_main as $id) {
                $post->addCat($postCreate->id, $id);
            }
        }

        if ($request->has('categories_sub')) {
            foreach ($request->categories_sub as $id) {
                $post->addCat($postCreate->id, $id, 'sub');
            }
        }

        return back();
    }

    public function edit(Request $request, Posts $post, Categories $categories, $id)
    {
        $post = $post->post($id);
        if (!$post) {
            return redirect()->route('larapost.posts.index');
        }

        $data = [];
        $data['post'] = $post;
        $data['categories'] = $categories->all(true);

        $cats_main_ids = [];
        foreach ($post->cats_main as $p) {
            $cats_main_ids[] = $p->cat_id;
        }

        $cats_sub_ids = [];
        foreach ($post->cats_sub as $p) {
            $cats_sub_ids[] = $p->cat_id;
        }

        $data['categories_selected'] = [
            'main' => $cats_main_ids,
            'sub' => $cats_sub_ids,
        ];

        // return $data;
        return view('larapost::posts.edit', $data);
    }

    public function update(Request $request, Posts $post, $id)
    {
        // return $request->all();
        $post->where([
            'id' => $id
        ])->update($request->except(['_method', '_token', 'categories_main', 'categories_sub']));

        if ($request->has('categories_main')) {
            $post->clearCat($id);
            foreach ($request->categories_main as $_id) {
                $post->addCat($id, $_id);
            }
        }

        if ($request->has('categories_sub')) {
            $post->clearCat($id, 'sub');
            foreach ($request->categories_sub as $_id) {
                $post->addCat($id, $_id, 'sub');
            }
        }

        return redirect()->route('larapost.posts.index');  
    }

    public function delete(Request $request, Posts $post, $id)
    {
        $post->where([
            'id' => $id
        ])->update([
            'status' => 'delete'
        ]);
        return back();  
    }
}