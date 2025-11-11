<?php

namespace Hennirocks;

class Helpers
{
    /**
     * Liefert alle Dateien mit bestimmten Endungen aus einem Unterverzeichnis relativ zum Basisordner zurück.
     *
     * @param string $baseDir Basisordner des Plugins
     * @param string $subdir Name des Unterordners (z.B. 'templates', 'snippets', 'blueprints')
     * @param array $exts Array mit Dateiendungen, z.B. ['php']
     * @return array Assoziatives Array von Schlüssel (Dateipfad ohne Endung relativ zum Unterordner) => kompletter Dateipfad
     */
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

    /**
     * Lädt PHP-Dateien aus einem Unterverzeichnis relativ zum Basisordner und gibt ein Array mit deren Rückgaben zurück.
     *
     * @param string $baseDir Basisordner des Plugins
     * @param string $subdir Name des Unterordners (z.B. 'controllers')
     * @param array $exts Array mit Dateiendungen, meist ['php']
     * @return array Assoziatives Array von Schlüssel (Dateiname ohne Endung) => Ergebnis von require der Datei
     */
    public static function mapRequires(string $baseDir, string $subdir, array $exts): array
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

            // PHP-Datei laden und Rückgabe speichern
            $result[$key] = require $file->getPathname();
        }

        return $result;
    }
}
