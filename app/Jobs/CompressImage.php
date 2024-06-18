<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompressImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Folder to store compressed images
     */
    public const FOLDER_COMPRESS = 'compress';

    /**
     * Link the image to be compressed
     *
     * @var string
     */
    public string $url;

    /**
     * Create a new job instance.
     *
     * @param  string  $url
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /*
         * Set the TinyPNG key
         */
        \Tinify\setKey(config('tiny-png.key'));

        /**
         * Optimize the original image with TinyPNG.
         */
        $newFile = \Tinify\fromUrl($this->url);

        /**
         * Get the compressed image.
         */
        $compressedImage = $newFile->toBuffer();

        /**
         * Set the name of the compressed image
         */
        $name = self::FOLDER_COMPRESS."/".Str::random().".".File::extension($this->url);

        /*
         * Save the compressed image to the public disk.
         */
        Storage::disk('public')->put($name, $compressedImage);
    }
}
