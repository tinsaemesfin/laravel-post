<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    $files = File::files(resource_path("posts"));
    $posts = [];

    foreach ($files as $file) {
        $doc = YamlFrontMatter::parseFile($file);
        $posts[] = new Post($doc->title, $doc->date, $doc->body(), $doc->excerpt,$doc->slug);
    }



    // ddd($posts[0]->title);
    return view('posts',[
        'posts'=>$posts
    ]);
});
Route::get('posts/{postnum}', function ($slug) {
    /**
     * To Show a Post view using its Sliug
     */
    $post = Post::find($slug);

    return view('post', [
        'postheader' => $post
    ]);
    /**
     * $path = __DIR__ . "/../resources/posts/{$slug}.html";
     *     if (!file_exists($path)) {
     * abort(404);
     *return redirect('/');
     *     }
     *     $post = cache()->remember("posts.{$slug}", 5, fn() => file_get_contents($path));
     * the first parameter in remember is key (Uniqe Key);
     * $post=file_get_contents($path);
     * return view('post', [
     * 'postheader' => $post,
     * ]);
     * 
     * 
     */
})->where('post', '[A-z_\-]+ 0-9');