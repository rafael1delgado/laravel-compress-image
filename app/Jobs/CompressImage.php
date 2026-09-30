<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tinify\Exception;

class CompressImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Folder to store compressed images
     */
    public const FOLDER_COMPRESS = 'compress';

    /**
     * Link the image to be compressed
     */
    public string $url;

    /**
     * Create a new job instance.
     *
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
        \Tinify\setKey(config('tiny-png.key'));

        try {
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
            $extension = pathinfo(parse_url($this->url, PHP_URL_PATH), PATHINFO_EXTENSION);
            $name = self::FOLDER_COMPRESS.'/'.Str::random().'.'.$extension;

            /*
             * Save the compressed image to the public disk.
             */
            Storage::disk('public')->put($name, $compressedImage);
        } catch (Exception $e) {
            Log::error('No se pudo comprimir la imagen', [
                'url' => $this->url,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}
