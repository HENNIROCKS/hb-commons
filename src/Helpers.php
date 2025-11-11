<?php

namespace Hennirocks;

class Helpers
{
    public static function mapFiles(string $baseDir, string $subdir, array $exts): array
    {
        $dir = $baseDir . DIRECTORY_SEPARATOR . $subdir;
        $result = [];

        if (!is_dir($dir)) {
            return $result;
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        $extPattern = implode('|', array_map('preg_quote', $exts));

        foreach ($iterator as $file) {
            if (!$file->isFile()) {
                continue;
            }

            $ext = strtolower(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
            if (!in_array($ext, $exts, true)) {
                continue;
            }

            $relative = str_replace($dir . DIRECTORY_SEPARATOR, '', $file->getPathname());
            $relative = str_replace('\\', '/', $relative);
            $key = preg_replace('#\\.(' . $extPattern . ')$#i', '', $relative);

            $result[$key] = $file->getPathname();
        }

        return $result;
    }
}
