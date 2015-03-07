<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'lessons';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title', 'body'];

	public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

}
