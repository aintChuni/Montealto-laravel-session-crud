<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostSessionController extends Controller
{
   public function index(Request $request)
{
$posts = $request->session()->get('posts', []);
return view('posts.index', compact('posts'));
}
public function create()
{
return view('posts.create');
}
public function store(Request $request)
{
$validated = $request->validate([
'title' => 'required|max:255',
'content' => 'required',
]);
$posts = $request->session()->get('posts', []);
$nextId = $request->session()->get('post_id_counter', 1);
$validated['id'] = $nextId;
$posts[] = $validated;
$request->session()->put('posts', $posts);
$request->session()->put('post_id_counter', $nextId + 1);
return redirect()->route('posts.index')->with('success', 'Post created
successfully.');
}
public function edit(Request $request, $id)
{
$posts = $request->session()->get('posts', []);
$post = collect($posts)->firstWhere('id', (int)$id);
if (!$post) {
return redirect()->route('posts.index')->with('error', 'Post not found.');
}
return view('posts.edit', compact('post'));
}
public function update(Request $request, $id)
{
$validated = $request->validate([
'title' => 'required|max:255',
'content' => 'required',
]);
$posts = $request->session()->get('posts', []);
$updated = false;
foreach ($posts as &$post) {
if ($post['id'] === (int)$id) {
$post['title'] = $validated['title'];
$post['content'] = $validated['content'];
$updated = true;
break;
}
}
if (!$updated) {
return redirect()->route('posts.index')->with('error', 'Post not found.');
}
$request->session()->put('posts', $posts);
return redirect()->route('posts.index')->with('success', 'Post updated
successfully.');
}
public function destroy(Request $request, $id)
{
$posts = $request->session()->get('posts', []);
$filtered = array_filter($posts, fn($post) => $post['id'] !== (int)$id);
if (count($filtered) === count($posts)) {
return redirect()->route('posts.index')->with('error', 'Post not found.');
}
$request->session()->put('posts', array_values($filtered));
return redirect()->route('posts.index')->with('success', 'Post deleted
successfully.');
}
}
