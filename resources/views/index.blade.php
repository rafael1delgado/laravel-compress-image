<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Compress PNG</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>

    </head>

    <body class="font-sans dark:bg-black dark:text-black/50">
        <!-- component -->
        <div class="h-screen w-screen bg-sky-800">
            <div class="container h-screen mx-auto flex justify-center items-center p-2 md:p-0">
                <div class="border border-black-300 p-6 grid grid-cols-1 gap-6 bg-white shadow-lg rounded-lg">
                    <p class="capitalize md:uppercase text-slate-700 font-bold">
                        Laravel Compress Image
                    </p>

                    @foreach (['red', 'green', 'sky', 'yellow'] as $key)
                        @if(session()->has($key))
                            <div class="span bg-{{ $key }}-300 p-2 rounded-md text-gray-800">
                                {!! session()->get($key) !!}
                            </div>
                        @endif
                    @endforeach

                    <form
                        class="mt-3 grid grid-cols-4 gap-8"
                        action="{{ route('compress.image') }}"
                        method="POST"
                    >
                        @csrf

                        <div class="col-span-12">
                            <label class="block">
                                <span class="block text-sm font-medium text-slate-700">
                                    Enlace de la imagen
                                </span>

                                <input
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                    focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800
                                    disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                    invalid:border-pink-500 invalid:text-pink-600
                                    focus:invalid:border-pink-500 focus:invalid:ring-pink-500"
                                    name="link"
                                    type="text"
                                    placeholder="https://www.dominio.com/imagen-alta-calidad.png"
                                />

                                <span class="mt-3 text-[10px] leading-6 text-gray-600">
                                    La imagen se almacenará en
                                    <strong>public/storage/compress.</strong>
                                </span>
                            </label>



                            <div class="flex justify-center mt-5">
                                <button
                                    class="p-2 border-sky-800 hover:bg-sky-900 rounded-md bg-sky-800 text-white"
                                    type="submit"
                                >
                                    Comprimir
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </body>
</html>
