<?php

namespace Bits\IsoMasonryBundle\EventListener;

use Isotope\Model\Product;

class IsoMasonryProductListener
{
    public function onInitializeSystem()
    {
        Product::registerModelType('IsoMasonry', 'Bits\IsoMasonryBundle\Model\Product\IsoMasonryProduct');
    }
}
