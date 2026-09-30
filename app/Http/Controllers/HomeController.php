<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompressImageRequest;
use App\Jobs\CompressImage;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Load the view
     *
     * @return View|Factory
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Compress the image
     *
     * @return RedirectResponse
     */
    public function compressImage(CompressImageRequest $request)
    {
        /**
         * Check if you can get the image with HTTP
         */
        if (Http::get($request->link)->successful()) {
            /**
             * Dispatch the job to compress the image
             */
            CompressImage::dispatch($request->link);

            return redirect()->back()->with('green', 'Procesando la imagen...');
        } else {
            return redirect()->back()->with('red', 'El enlace ingresado no se puede acceder');
        }
    }
}
