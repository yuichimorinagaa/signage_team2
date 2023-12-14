<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $users = User::all();
        return view('post.create', compact('users'));
    }

    /**
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Post::create([
            'name' => $validated->name,
            'text' => $validated->text,
            'user_id' => $validated->user_id,
        ]);
        return redirect()->route('post.index');
    }

    /**
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $post = Post::find($id);
        $users = User::all();

        return view('post.edit', compact('post', 'users'));
    }

    /**
     * @param PostRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(PostRequest $request, int $id): RedirectResponse
    {
        $validated = $request->validated();
        $post = Post::find($id);
        $post->update($validated->all());

        return redirect()->route('post.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('post.index');
    }
}
