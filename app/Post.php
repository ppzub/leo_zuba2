<?php

namespace App;

use Carbon\Carbon;
use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Request;

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
    public function likes()
    {
        return $this->belongsToMany( 'App\User', 'users_posts_likes', 'post_id', 'user_id');
    }
    public function userLike()
    {
        $userID = Request::user('api') != '' ? Request::user('api')->id : null;
        return $this->belongsToMany( 'App\User', 'users_posts_likes', 'post_id', 'user_id')->where('user_id', $userID);
    }
    public function uploadMainImage($image)
    {
        if (strlen($image) == 0) { return; }
        $this->removeImage(); // якщо вже є в БД картінка для даного запису, видаляєм

        $obj = new \stdClass;
        $str = str_random(10);

        $obj->small = $str.'_small.png';
        $obj->medium = $str.'_medium.png';
        $obj->large = $str.'_large.png';

        $img = Image::make($image);
        $img->fit(800, 600)->save(public_path().'/images/large/'.$obj->large);
        $img->fit(412, 309)->save(public_path().'/images/medium/'.$obj->medium);
        $img->fit(120, 90)->save(public_path().'/images/small/'.$obj->small);

        $obj = json_encode($obj);

        return $obj;
    }
    public function removeImage()
    {
        if ($this->image != null)
        {
            $image = json_decode($this->image);
            Storage::delete('/images/small/'.$image->small);
            Storage::delete('/images/medium/'.$image->medium);
            Storage::delete('/images/large/'.$image->large);
        }
    }
    /**
     * ф-я для видалення запису
     */
    public function remove()
    {
        $this->removeImage();
        if($this->likes()) {
            $this->likes()->detach($this->id);
        }
        $this->delete();
    }
    /**
     * ф-я для отримання картінки
     */
    public function getImage()
    {
        $obj = new \stdClass;
        if ($this->image == null)
        {
            $obj->small = '/images/small/default_small.png';
            $obj->medium = '/images/medium/default_medium.png';
            $obj->large = '/images/large/default_large.png';
            return $obj;
        }
        else
        {
            $image = json_decode($this->image);
            $obj->small = '/images/small/'.$image->small;
            $obj->medium = '/images/medium/'.$image->medium;
            $obj->large = '/images/large/'.$image->large;
            return $obj;
        }
    }
    /**
     * формат дати укр мовою
     */
    public function getDate()
    {
        $date = Date::parse($this->created_at)->format('d F Y');
        return $date;
    }
    public static function isJSON($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }
}
