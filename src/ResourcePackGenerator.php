<?php

namespace nouma\cristelia;

use Ramsey\Uuid\Uuid;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class ResourcePackGenerator
{

    public static function generate(): bool
    {
        $pluginPath = Main::getInstance()->getDataFolder();
        $resourcePath = Main::getInstance()->getResourcePath('cristelia_pack');
        $zipPath = Main::getInstance()->getServer()->getDataPath() . 'resource_packs/cristelia_pack.zip';

        // Lire le contenu du fichier manifest.json
        $manifestPath = $resourcePath.'/cristelia_pack/manifest.json';
        $manifestContent = file_get_contents($manifestPath);

        // Charger le contenu JSON en tant qu'objet PHP
        $manifest = json_decode($manifestContent, true);

        // Générer de nouveaux UUID aléatoires
        $manifest['header']['uuid'] = Uuid::uuid4()->toString();
        $manifest['modules'][0]['uuid'] = Uuid::uuid4()->toString();

        // Convertir l'objet PHP mis à jour en JSON
        $newManifestContent = json_encode($manifest, JSON_PRETTY_PRINT);

        // Écrire le nouveau contenu dans le fichier manifest.json
        file_put_contents($manifestPath, $newManifestContent);

        // Crée une instance de ZipArchive
        $zip = new ZipArchive();

        // Ouvre le fichier zip en écriture
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            // Ajoute les fichiers du dossier 'cristelia_pack' au zip
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($resourcePath),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($resourcePath) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }

            // Ferme le zip
            $zip->close();

            return true; // Succès
        } else {
            return false; // Échec
        }
    }

}