<?php

namespace ph\utils;

use ph\exception\InvalidImageFormatException;

class ImageUtil {
    private function __construct() { }

    public static function getSupportedExtension() {
        return ['jpg', 'jpeg', 'png', 'gif'];
    }

    public static function convertToJpeg($source, $deleteSource = true, $quality = 100) {
        self::convertTo($source, 'jpeg', $deleteSource,  $quality);
    }

    public static function convertToPng($source, $deleteSource = true) {
        self::convertTo($source, 'png',  $deleteSource);
    }

    public static function convertToGif($source, $deleteSource = true) {
        self::convertTo($source, 'gif',  $deleteSource);
    }

    private static function convertTo($source, $targetFormat, $deleteSource, $quality = 100) {
        $ext = FileUtil::getFileExtension($source);
        $absoluteSource = FileUtil::getAbsolutePath($source);

        $tempImage = null;
        if ($ext === 'jpg' || $ext === 'jpeg') {
            $tempImage = imagecreatefromjpeg($absoluteSource);
        } else if ($ext === 'png') {
            $tempImage = imagecreatefrompng($absoluteSource);
        } else if ($ext === 'gif') {
            $tempImage = imagecreatefromgif($absoluteSource);
        } else {
            throw new InvalidImageFormatException("Image with format ." . $ext . " can not be converted");
        }

        $targetFilename = FileUtil::getFilePathWithoutExtension($absoluteSource) . '.' . $targetFormat;
        if ($absoluteSource === $targetFilename) {
            imagedestroy($tempImage);
            return;
        }

        try {
            switch ($targetFormat) {
                case 'jpeg':
                    imagejpeg($tempImage, $targetFilename, $quality);
                    break;
                case 'png':
                    imagepng($tempImage, $targetFilename);
                    break;
                case 'gif':
                    imagegif($tempImage, $targetFilename);
                    break;
                default:
                    throw new InvalidImageFormatException("Conversion image to ." . $targetFormat . " not supported");
            }
            if ($deleteSource) {
                FileUtil::deleteFile($source);
            }
            imagedestroy($tempImage);
        } catch (\Exception $e) {
            imagedestroy($tempImage);
        }
    }
}
