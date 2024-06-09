<?php

namespace lib;

class Image
{
    private string $image_path;
    private int $width;
    private int $height;
    private string $type;
    private bool $raw;

    public function __construct(string $image_path, int|null $width, int|null $height, string|null $type, bool|null $raw)
    {
        if (is_null($width)) $width = 100;
        if (is_null($height)) $height = 0;
        if (is_null($type)) $type = "webp";
        if (is_null($raw)) $raw = false;

        if ($image_path === "" || !file_exists("../static/images/" . $image_path)) {
            http_response_code(404);
            if (realpath($_SERVER["SCRIPT_FILENAME"]) === __FILE__) {
                die();
            } else {
                throw new Error("Image not found");
            }
        }

        $this->image_path = $image_path;
        $this->width = $width;
        $this->height = $height;
        $this->type = $type;
        $this->raw = $raw;
    }

    /**
     * @throws ImagickException
     */
    public function render(): void
    {
        $src = new Imagick("../static/images/" . $this->image_path);
        $src->stripImage();
        $src->resizeImage($this->width, $this->height, imagick::FILTER_GAUSSIAN, true);
        $src->setImageFormat($this->type);
        $src->setColorspace(Imagick::COLORSPACE_RGB);
        $src->setCompression(Imagick::COMPRESSION_LZMA);
        $src->setCompressionQuality(-1);
        $imgBuffer = $src->getImageBlob();
        $src->clear();
        if ($this->raw) {
            $out = $imgBuffer;
            header("Content-Type: image/" . $this->type);
        } else {
            $out = base64_encode($imgBuffer);
            header("Content-Type: text/base64");
        }
        echo $out;
    }
}
