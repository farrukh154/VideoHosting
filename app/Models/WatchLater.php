<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchLater extends Model
{
    use HasFactory;
    // Указываем точное имя таблицы
    protected $table = 'watch_later';
    
    protected $fillable = ['user_id', 'video_id', 'video_title'];
}