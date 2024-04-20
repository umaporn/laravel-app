<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $fillable = ['title', 'author', 'isbn', 'published_date'];
 
}
