<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class GenerateThumbnailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $imageFullPath;

    /**
     * Create a new job instance.
     */
    public function __construct($imageFullPath)
    {
        $this->imageFullPath = $imageFullPath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $thumbnailStorage = Storage::disk('images');
        $manager = new ImageManager(new Driver());
        $image = $manager->read($thumbnailStorage->path($this->imageFullPath));
        $image->scaleDown(2048)->save($thumbnailStorage->path($this->imageFullPath));
    }
}
