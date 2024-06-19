# Laravel Compress Image

Application to compress images with the TinyPNG API.

# Requirements

- Laravel Framework version `11.9`.
- PHP version `8.2.19`.


# Installing

1. Installing the php dependencies.

    ```bash
    composer install
    ```

2. Copy the `.env.example` file and save it as `.env`.


    ```bash
    php artisan key:generate
    ```

3. Get your TinyPNG key.

- Login to https://tinypng.com/developers.

- Copy and paste the created API Key to https://tinify.com/dashboard/api.

- Set the `TINY_PNG_KEY` value in your `.env` file.

# Using

1. Enter the link of the image in the form you want to optimize.

    Example image links:

    - https://images.pexels.com/photos/18069241/pexels-photo-18069241/free-photo-of-an-artist-s-illustration-of-artificial-intelligence-ai-this-image-depicts-how-ai-tools-can-democratize-education-and-make-learning-more-efficient-it-was-created-by-martina-stiftinger-a.png

    - https://images.pexels.com/photos/4484078/pexels-photo-4484078.jpeg


2. Process the job that is in the queue.

    ```bash
    php artisan queue:work
    ```

3. The optimized image will be stored in `public/storage/compress`.



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

# Results

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
