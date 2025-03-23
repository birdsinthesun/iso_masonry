<?php
namespace Bits\IsoMasonryBundle\EventListener;

use Contao\System;
use Bits\IsoMasonryBundle\Service\ImageResizer;


class ProductRenderingListener
{
     
    public function alterProductRendering($objTemplate, $objProduct, $arrConfig)
    {
        $imageResizer = new ImageResizer();
        $arrImages = deserialize($objProduct->__get('images'));
        $isotopeSubFolder = mb_substr($arrImages[0]['src'],0,1);
        $objTemplate->src_preview = $imageResizer->resizeAndCacheImage("/isotope/".$isotopeSubFolder."/".$arrImages[0]['src'], 300,null);
        $objTemplate->src_fullsize = $imageResizer->resizeAndCacheImage("/isotope/".$isotopeSubFolder."/".$arrImages[0]['src'], 1480,900);

        
    }
}