<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $dates = [
        'created',
        'updated',
    ];
    public $timestamp = false;
    protected $fillable = [
        'truyen_id', 'tieude', 'noidung', 'slug_chapter', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'chapter';
    public function truyen(){
        return $this->belongsTo('App\Models\Truyen');
    }
    
}
