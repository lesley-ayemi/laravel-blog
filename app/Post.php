<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{


    protected $fillable = ['title', 'body', 'photo_id', 'category_id'];


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
