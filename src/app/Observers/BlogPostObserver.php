<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;

class BlogPostObserver
{
    
    /**
     * Обработка перед обновление записи
     *
     * @param  \App\Models\BlogPost  $blogPost
     *
     * @return void
     */
    public function updating(BlogPost $blogPost)
    {
        $test[]=$blogPost->isDirty();
        $test[]=$blogPost->isDirty('is_published');
        $test[]=$blogPost->isDirty('user_id');
        $test[]=$blogPost->getAttribute('is_published');
        $test[]=$blogPost->is_published;
        $test[]=$blogPost->getOriginal('is_published');
        

        $this->SetPublishedAt($blogPost);
        
        $this->SetSlug($blogPost);

    }
    
    public function creating(BlogPost$blogPost){
        $this->SetPublishedAt($blogPost);
    
        $this->SetSlug($blogPost);
    }
    
    protected function SetPublishedAt(BlogPost $blogPost){
        if(empty($blogPost->published_at) && $blogPost->is_published){
            $blogPost->published_at=Carbon::now();
        }
    }
    
    protected function SetSlug(BlogPost $blogPost){
        if(empty($blogPost->slug)){
            $blogPost->slug=\Str::slug($blogPost->title);
        }
    }
    
    protected function SetHtml(BlogPost $blogPost){
                if($blogPost->isDirty('content_row')){
                    $blogPost->content_html=$blogPost->content_raw;
                }
    }
    
    protected function SetUser(BlogPost $blogPost){
        
        $blogPost->user_id=auth()->id() ?? BlogPost::UNKNOWN_USER;
    }
    
    /**
     * Handle the BlogPost "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }
    

    /**
     * Handle the BlogPost "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
    

}
