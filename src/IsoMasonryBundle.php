<?php
namespace App\ContaoMyCustomBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoMyCustomBundle extends Bundle
{
     public function boot()
    {
        // Hier die Produktmodell-Klasse registrieren
        \Isotope\Model\Product::registerModel('IsoMasonryProduct', \IsoMasonry\Model\Product\IsoMasonryProduct::class);
    }
}
