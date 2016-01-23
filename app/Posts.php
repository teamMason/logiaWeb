<?php

namespace portalLogia;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;




class Posts extends Model implements SluggableInterface
{
     
    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );


     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'tags', 'photo'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
