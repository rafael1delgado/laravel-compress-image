<?php

use App\Jobs\CompressImage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $url = "https://images.pexels.com/photos/18069241/pexels-photo-18069241/free-photo-of-an-artist-s-illustration-of-artificial-intelligence-ai-this-image-depicts-how-ai-tools-can-democratise-education-and-make-learning-more-efficient-it-was-created-by-martina-stiftinger-a.png";

    // $url = "https://images.pexels.com/photos/4484078/pexels-photo-4484078.jpeg";
    CompressImage::dispatch($url);

    return view('welcome');
});
