# Laravel Compress Image

![PHP](https://img.shields.io/badge/PHP-%5E8.3-777BB4)
![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20)
![License](https://img.shields.io/badge/License-MIT-blue)

Application to compress images with the TinyPNG API.

Paste the URL of any `.jpg`, `.jpeg` or `.png` image and the app will optimize it for you using [Tinify](https://tinypng.com/) (TinyPNG), saving up to **70% of the original size** while keeping the quality. The compression runs in the background on a queue, so the UI is never blocked.

## Features

- Compress images directly from a URL (`.jpg`, `.jpeg`, `.png`).
- Async processing with Laravel Queues.
- URL validation and accessibility check before dispatching the job.
- Compressed images stored on the `public` disk under `storage/app/public/compress`.
- Responsive UI built with Tailwind CSS.

## Requirements

- PHP `>= 8.3`
- Laravel Framework `13.34`
- Composer
- A free TinyPNG API Key

## Tech Stack

| Layer      | Technology              |
| ---------- | ----------------------- |
| Backend    | Laravel 13, PHP 8.4     |
| Compression| tiny/tinify 1.6.4        |
| Frontend   | Blade, Tailwind CSS     |
| Build tool | Vite 5                  |
| Queue      | Laravel Queue (database)|

## Screenshots

<details>
<summary>Click to view the interface</summary>

<table>
    <tr>
        <td>
            <img
                src="resources/images/preview.png"  alt="Preview"
                width="500px"
                height="auto"
            >
        </td>
        <td>
            <img
                src="resources/images/preview-2.png"  alt="Image processing..."
                width="500px"
                height="auto"
            >
        </td>
    </tr>
</table>
</details>

## Installing

### 1. Clone and install dependencies

```bash
git clone <your-repo-url>
cd laravel-compress-image
composer install
```

### 2. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Get your TinyPNG key

1. Log in to <https://tinypng.com/developers>.
2. Create an API key.
3. The key is shown in your [Tinify dashboard](https://tinify.com/dashboard/api).
4. Set it in your `.env` file:

```env
TINY_PNG_KEY=your_api_key_here
```

### 4. Database, storage and queue

The queue uses the **database** driver, and compressed images are stored on the `public` disk, so run the following commands:

```bash
php artisan migrate
php artisan storage:link
```

## Using

### 1. Serve the app

```bash
php artisan serve
```

Open <http://localhost:8000> in your browser.

### 2. Process the queue

The compression job is queued, so a worker must be running:

```bash
php artisan queue:work
```

### 3. Compress an image

Enter the link of the image you want to optimize in the form and click **Comprimir**.

Example image links:

- https://images.pexels.com/photos/18069241/pexels-photo-18069241/free-photo-of-an-artist-s-illustration-of-artificial-intelligence-ai-this-image-depicts-how-ai-tools-can-democratize-education-and-make-learning-more-efficient-it-was-created-by-martina-stiftinger-a.png
- https://images.pexels.com/photos/4484078/pexels-photo-4484078.jpeg

The optimized image will be stored in `public/storage/compress`.

> **Note:** the form also shows a success/error message and validates that the uploaded link ends with an image extension.

### 4. Verify your API key (optional)

Check that your TinyPNG key is valid before compressing anything:

```bash
php artisan tinker
>>> \Tinify\setKey(env('TINY_PNG_KEY'));
>>> \Tinify\validate();
// true if the key is valid, throws an exception otherwise
```

## How it works

1. The user submits the image URL.
2. `CompressImageRequest` validates the URL (`required|url|ends_with:.jpg,.jpeg,.png`).
3. `HomeController@compressImage` checks that the URL is reachable over HTTP.
4. The `App\Jobs\CompressImage` job is dispatched to the queue.
5. The worker downloads the image with TinyPNG (`\Tinify\fromUrl`), gets the optimized buffer and saves it on the `public` disk with a random name under `compress/`.
6. If TinyPNG fails (invalid key, unreachable image, etc.), the job logs the error under `No se pudo comprimir la imagen` and is marked as failed.

## Troubleshooting

| Problem | Solution |
| ------- | -------- |
| Image never appears in `public/storage/compress` | Run `php artisan storage:link` once. |
| Job never processed | Make sure a worker is running: `php artisan queue:work`. |
| Job marked as **failed** | Check `storage/logs/laravel.log` for `No se pudo comprimir la imagen` — usually a missing/invalid `TINY_PNG_KEY` or an unreachable image URL. |
| Form says the link cannot be accessed | The server can't reach the URL; try another image link. |

## Results

Image optimization results

<table>
    <tr>
        <td>
            <img
                src="resources/images/original.jpeg"  alt="Original Image"
                width="500px"
                height="auto"
            >
        </td>
        <td>
            <img
                src="resources/images/compress.jpeg"  alt="Compressed Image"
                width="500px"
                height="auto"
            >
        </td>
    </tr>
    <tr>
        <td>
            <strong>Size:</strong> 2.08 MB
        </td>
        <td>
            <strong>Size:</strong> 1.39 MB (-33%)
        </td>
    </tr>
    <tr>
        <td>
            <strong>Path:</strong>
            <code>resources/images/original.jpeg</code>
        </td>
        <td>
            <strong>Path:</strong>
            <code>resources/images/compress.jpeg</code>
        </td>
    </tr>
</table>

## Project structure

```
app/
├── Http/
│   ├── Controllers/HomeController.php   # Form handling & job dispatch
│   └── Requests/CompressImageRequest.php # URL validation
└── Jobs/
    └── CompressImage.php                # TinyPNG compression logic
config/tiny-png.php                      # Reads the TINY_PNG_KEY env var
routes/web.php                          # GET / and POST /compress-image
resources/views/index.blade.php         # UI (Tailwind)
```

## License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).