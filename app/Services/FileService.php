<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function insertProductImages()
    {
        // Tipovi proizvoda
        $types = ['image', 'pdf', 'video'];

        // Prolazak kroz sve tipove proizvoda
        foreach ($types as $type) {
            // Putanja do direktorijuma sa slikama, pdf-ovima ili videima
            $directory = storage_path('app/public/products/' . $type . 's');

            // Prolazak kroz sve foldere 1 i 2
            for ($folder = 1; $folder <= 2; $folder++) {
                // Putanja do trenutnog foldera
                $folderPath = $directory . '/' . $folder;

                // Prolazak kroz sve slike, pdf-ove ili video zapise u trenutnom folderu
                $files = glob($folderPath . '/*.{jpg,pdf,mp4}', GLOB_BRACE);
                foreach ($files as $file) {
                    // Kreiranje novog proizvoda
                    $product = new Product();
                    $product->type = $type;
                    $product->name = basename($file);

                    // Povezivanje putanje slike sa odgovarajućim atributom proizvoda
                    if ($folder === 1) {
                        // Ako je folder 1, postavljamo putanju slike kao full verziju
                        $product->full_product = Storage::url($file);
                    } elseif ($folder === 2) {
                        // Ako je folder 2, postavljamo putanju slike kao free verziju
                        $product->free_version = Storage::url($file);
                    }

                    // Čuvanje proizvoda
                    $product->save();
                }
            }
        }
    }
}