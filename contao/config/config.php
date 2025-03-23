<?php
use Contao\CoreBundle\ContaoCoreBundle;
\Isotope\Model\Product::registerModelType('iso_masonry', 'Bits\IsoMasonryBundle\Model\Product\IsoMasonryProduct');

//$GLOBALS['TL_HOOKS']['initializeSystem'][] = ['Bits\IsoMasonryBundle\EventListener\IsoMasonryProductListener', 'onInitializeSystem'];
return [
   
    ContaoCoreBundle::class => ['all' => true],
    'isotope' => ['all' => true],
   
   
];