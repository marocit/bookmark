<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Bookmark extends Model
{
  use Searchable;

  protected $fillable = [
        'url', 'cover', 'title', 'description', 'category_id',
    ];

  public function category()
  {
      return $this->belongsTo(Category::class, 'category_id');
  }

  public function setCoverAtAttribute($value)
  {
    $this->attributes['cover'] = $value ?: 'test';
  }

  public function scopelatestFirst($query)
  {
    return $query->orderBy('created_at', 'desc');
  }

  public function searchableAs()
    {
        return 'bookmarks_index';
    }
}
