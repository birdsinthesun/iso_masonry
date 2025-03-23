<?php
use Contao\CoreBundle\ContaoCoreBundle;

$GLOBALS['TL_HOOKS']['initializeSystem'][] = ['Bits\IsoMasonryBundle\EventListener\IsoMasonryProductListener', 'onInitializeSystem'];
return [
   
    ContaoCoreBundle::class => ['all' => true],
    'isotope' => ['all' => true],
   
   
];