<?php

namespace App\Observers;

use App\Models\BlogCategoty;

class BlogCategoryObserver
{

    public function created(BlogCategoty $blogCategoty)
    {

    }
    public function creating(BlogCategoty $blogCategoty){

        $this->SetSlug($blogCategoty);
 
    }
    
    protected function SetSlug(BlogCategoty $blogCategoty){
        if(empty($blogCategoty->slug)){
            $blogCategoty->slug=\Str::slug($blogCategoty->title);
        }
    }
    

    public function updated(BlogCategoty $blogCategoty)
    {

    }
    public function updating(BlogCategoty $blogCategoty){

    
        dd($blogCategoty);
        $this->SetSlug($blogCategoty);
    }

    public function deleted(BlogCategoty $blogCategoty)
    {
    

    }


    public function restored(BlogCategoty $blogCategoty)
    {
    

    }


    public function forceDeleted(BlogCategoty $blogCategoty)
    {
    

    }
}
