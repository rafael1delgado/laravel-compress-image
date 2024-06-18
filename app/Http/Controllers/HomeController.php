<?php

namespace App\Http\Controllers;

use App\Jobs\CompressImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Load the view
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Compress the image
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function compressImage(Request $request)
    {
        /**
         * Check if you can get the image with HTTP
         */
        if(Http::get($request->link)->successful())
        {
            /**
             * Dispatch the job to compress the image
             */
            CompressImage::dispatch($request->link);

            return redirect()->back()->with('green', 'Procesando la imagen...');
        }
        else
        {
            return redirect()->back()->with('red', 'El enlace ingresado no se puede acceder');
        }
    }
}
