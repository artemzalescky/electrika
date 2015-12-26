<?php

namespace ph\utils;

use config\Config;

class FileUtil {
    private function __construct() { }

    public static function fileExist($path) {
        $path = self::getAbsolutePath($path);
        return file_exists($path) && is_file($path);
    }

    public static function dirExist($path) {
        $path = self::getAbsolutePath($path);
        return file_exists($path) && is_dir($path);
    }

    public static function createDirIfNotExist($path, $recursive = true) {
        $path = self::getAbsolutePath($path);
        if (!self::dirExist($path)) {
            try{
                return mkdir($path, 0777, $recursive);
            } catch (\Exception $ignored) { }
        }
        return false;
    }

    public static function deleteFile($path) {
        try {
            return unlink(self::getAbsolutePath($path));
        } catch (\Exception $ignored) { }
        return false;
    }

    public static function deleteDir($path) {
        try {
            $absolutePath = self::getAbsolutePath($path);
            return self::deleteDirRecursively($absolutePath);
        } catch (\Exception $ignored) { }
        return false;
    }

    public static function getFileExtension($path) {
        $exploded = explode('.', $path);
        return count($exploded) > 1 ? $exploded[count($exploded) - 1] : null;
    }

    public static function getFilenameWithoutExtension($path) {
        $exploded = explode('/', $path);
        $filename = $exploded[count($exploded) - 1];
        return explode('.', $filename)[0];
    }

    public static function getFilePathWithoutExtension($path) {
        return explode('.', $path)[0];
    }

    public static function getAbsolutePath($path) {
        return $_SERVER['DOCUMENT_ROOT'] . Config::getBasePath() . trim($path, '/');
    }

    public static function getMaxFileSizeToUpload() {
        return 1024 * 1024 * min(intval(ini_get("upload_max_filesize")), intval(ini_get("post_max_size")));
    }

    private static function deleteDirRecursively($absolutePath) {
        if (!is_dir($absolutePath) || is_link($absolutePath)) return unlink($absolutePath);
        foreach (scandir($absolutePath) as $file) {
            if ($file == '.' || $file == '..') continue;
            if (!self::deleteDirRecursively($absolutePath . DIRECTORY_SEPARATOR . $file)) {
                chmod($absolutePath . DIRECTORY_SEPARATOR . $file, 0777);
                if (!self::deleteDirRecursively($absolutePath . DIRECTORY_SEPARATOR . $file)) return false;
            };
        }
        return rmdir($absolutePath);
    }
}
