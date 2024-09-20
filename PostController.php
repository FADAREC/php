<?php

   namespace App\Http\Controllers;

   use Illuminate\Http\Request;
   use App\Models\Post;
   use Illuminate\Support\Facades\Auth;

   class PostController extends Controller
   {
       // List all posts
       public function index()
       {
           $posts = Post::all();
           return response()->json($posts);
       }

       // Create a new post
       public function store(Request $request)
       {
           $request->validate([
               'title' => 'required|string|max:255',
               'body' => 'required|string',
           ]);

           $post = Post::create([
               'title' => $request->title,
               'body' => $request->body,
               'user_id' => Auth::id(),
           ]);

           return response()->json($post, 201);
       }

       // Show a single post
       public function show($id)
       {
           $post = Post::findOrFail($id);
           return response()->json($post);
       }

       // Update a post
       public function update(Request $request, $id)
       {
           $post = Post::findOrFail($id);

           if ($post->user_id != Auth::id()) {
               return response()->json(['error' => 'Unauthorized'], 403);
           }

           $post->update($request->only('title', 'body'));

           return response()->json($post);
       }

       // Delete a post
       public function destroy($id)
       {
           $post = Post::findOrFail($id);

           if ($post->user_id != Auth::id()) {
               return response()->json(['error' => 'Unauthorized'], 403);
           }

           $post->delete();

           return response()->json(['message' => 'Post deleted successfully']);
       }
   }