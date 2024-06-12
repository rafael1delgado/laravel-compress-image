# Laravel Compress Image

Application to compress images with the TinyPNG API.

# Requirements

- Laravel Framework version `11.9`.
- PHP version `8.2.19`.


# Installing

1. Installing the php dependencies

```bash
composer install
```

2. Copy the `.env.example` file and save it as `.env`


```bash
php artisan key:generate
```

3. Get your TinyPNG key

- Login to https://tinypng.com/developers.

- Copy and paste the created API Key to https://tinify.com/dashboard/api.

- Set the `TINY_PNG_KEY` value in your `.env` file

# Using

Enter the link of the original image you want to compress.

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
            resources/images/original.jpeg
        </td>
        <td>
            <strong>Path:</strong>
            resources/images/compress.jpeg
        </td>
    </tr>
</table>
