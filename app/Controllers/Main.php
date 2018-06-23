<?php

namespace App\Controllers;

use Intervention\Image\ImageManagerStatic as IImage;

class Main extends MainController
{
    const ORIGIN = 'img/example.jpg';
    const RESULT = 'img/result.jpg';
    const WATERMARK_FONT = 'arial.ttf';
    const WATERMARK_TEXT = 'MY  WATERMARK';
    const WATERMARK_SIZE = '72';
    const WATERMARK_COLOR_RGBA = array(100, 130, 150, 0.65);
    const WATERMARK_ANGLE = 45;
    const RESULT_IMAGE_WIDTH = 200;

    public function index()
    {
        $image = IImage::make(self::ORIGIN);
        $image->text(
            self::WATERMARK_TEXT,
            $image->width() / 2,
            $image->height() / 2,
            function ($font) {
                $font->file(self::WATERMARK_FONT)
                    ->size(self::WATERMARK_SIZE);
                $font->color(self::WATERMARK_COLOR_RGBA);
                $font->align('center');
                $font->valign('center');
                $font->angle(self::WATERMARK_ANGLE);
            }
        )
            ->resize(self::RESULT_IMAGE_WIDTH, null, function ($image) {
                $image->aspectRatio();
            })
            ->save(self::RESULT, 100);

        $this->view->render('main', 'template', []);
    }
}
