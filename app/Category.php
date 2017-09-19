<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable = ['name'];
  protected $hidden = ['created_at', 'updated_at'];

  public function bookmarks()
  {
    return $this->hasMany(Bookmark::class);
  }

  public function getRouteKeyName()
  {
    return 'name';
  }

  public static function categoriesTest()
  {
      return static::all();
  }

}
