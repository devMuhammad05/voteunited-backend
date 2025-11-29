<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{

    private function generateUniqueSlug(string $title, $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (
            Post::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $originalSlug.'-'.$count++;
        }

        return $slug;
    }

    /**
     * Handle the Post "created" event.
     */
    public function creating(Post $post): void
    {
        if (empty($post->slug)) {
            $post->slug = $this->generateUniqueSlug($post->title);
        }
    }
    /**
     * Handle the Post "updated" event.
     */
    public function updating(Post $post): void
    {
        if ($post->isDirty('title')) {
            $post->slug = $this->generateUniqueSlug($post->title, $post->id);
        }
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
