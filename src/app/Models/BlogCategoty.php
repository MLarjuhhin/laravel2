<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategoty extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $guarded=false;
    
    public function ParentCategory()
    {
        
        return $this->belongsTo(BlogCategoty::class,'parent_id','id');
    }
    
    //    protected $fillable=[
//        'title',
//        'slug',
//        'parent_id',
//        'description'
//    ];
}
