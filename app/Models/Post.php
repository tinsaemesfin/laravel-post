<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post

{
   public $title;
   public $date;
   public $body;
   public $excerpt;
   public $slug;
   public function __construct($title,$date,$body,$excerpt,$slug)
   {
       $this->title=$title;
       $this->date=$date;
       $this->body=$body;
       $this->excerpt=$excerpt;
       $this->slug=$slug;
   }

    public static function find($slug)
    {
        
        /* vds ;
        $path = __DIR__ . "/../../resources/posts/{$slug}.html";*/

        if (!file_exists($path=resource_path("posts/{$slug}.html"))) {
            throw new ModelNotFoundException();
           /* abort(404);
             return redirect('/');*/
        }
        return cache()->remember("posts.{$slug}", 5, fn () => file_get_contents($path));
        // the first parameter in remember is key (Uniqe Key);
    }
    public static function all(){
        $files=File::files(resource_path("posts/"));


        /**
         * the First return was
         * return File::files(resource_path("posts/"));
         *this is array map function the firt $file in function has each file instance
         *the secound $files is the array we map 
         * and this function also returns an array
         */
        
        return array_map(function($file){
            return $file->getcontents();
        },$files);

        

        
    }
}
