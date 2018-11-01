<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['title', 'content', 'user_id', 'image', 'video', 'created_at', 'updated_at'];

	public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function galleries()
    {
        return $this->hasMany('App\Gallery');
    }
    public function tags()
    {
    	return $this->belongsToMany(
    		'App\Tag',
    		'post_tag'
    	);
    }
}
