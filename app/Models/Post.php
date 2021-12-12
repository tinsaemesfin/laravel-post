<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post

{
    public $title;
    public $date;
    public $body;
    public $excerpt;
    public $slug;
    public function __construct($title, $date, $body, $excerpt, $slug)
    {
        $this->title = $title;
        $this->date = $date;
        $this->body = $body;
        $this->excerpt = $excerpt;
        $this->slug = $slug;
    }

   
    public static function all()
    {
        return cache()->rememberForever('post.all', function () {
           return collect(File::files(resource_path("posts")))
        ->map(fn($file) => YamlFrontMatter::parseFile($file))
        ->map(fn($doc) => new Post($doc->title, $doc->date, $doc->body(), $doc->excerpt, $doc->slug))
        ->sortByDesc('date');
        });
         
    }

    public static function find($slug)
    {
     return static::all()->firstWhere('slug',$slug);
    }
}
