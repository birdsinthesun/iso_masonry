<?php

namespace Bits\IsoMasonry\Model\Product;

use Isotope\Model\Product;

class IsoMasonryProduct extends Product
{
    /**
     * Gibt das Bild in 300px Breite zurück.
     */
    public function getSmallImage()
    {
        if (!$this->images) {
            return null; // Falls kein Bild vorhanden ist
        }

        $image = FilesModel::findByUuid($this->images[0]); // Erstes Bild holen

        if ($image) {
            return \System::getContainer()
                ->get('contao.image.image_factory')
                ->create($image->path, ['width' => 300])
                ->getUrl();
        }

        return null;
    }

    /**
     * Gibt das Originalbild zurück.
     */
    public function getFullImage()
    {
        if (!$this->images) {
            return null;
        }

        $image = FilesModel::findByUuid($this->images[0]);
        return $image ? $image->path : null;
    }
}
