<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model
{


    use Sluggable;
    use SluggableScopeHelpers;


    protected $fillable = ['title', 'body', 'photo_id', 'category_id'];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function user(){

        return $this->belongsTo('App\User');

    }

    public function photo(){

        return $this->belongsTo('App\Photo');

    }


    public function category(){

        return $this->belongsTo('App\Category');

    }

    public function comments(){

        // return $this->hasMany('App\Post');
        return $this->hasMany('App\Comment');

    }


    public function photoPlaceholder(){

        return "https://place-hold.it/300x500";

    }




}
