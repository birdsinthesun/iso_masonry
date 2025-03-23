<?php

namespace Bits\IsoMasonryBundle\Model\Product;

use Isotope\Model\Product\Standard;
use Contao\System;
use Contao\Model\FilesModel;
use Isotope\Template;


class IsoMasonryProduct extends Standard
{
    


    public function generate(array $arrConfig)
    {
        /** @var Template|\stdClass $objTemplate */
        $objTemplate = new Template($arrConfig['template']);
        $objTemplate->setData($this->arrData);
        $objTemplate->product = $this;
        $objTemplate->config  = $arrConfig;
        
        $arrVariantOptions = array();
        $arrProductOptions = array();
        $arrAjaxOptions    = array();

        if (!($arrConfig['disableOptions'] ?? false)) {
            foreach (array_unique(array_merge($this->getType()->getAttributes(), $this->getType()->getVariantAttributes())) as $attribute) {
                $arrData = $GLOBALS['TL_DCA']['tl_iso_product']['fields'][$attribute];

                if (($arrData['attributes']['customer_defined'] ?? null) || ($arrData['attributes']['variant_option'] ?? null)) {

                    $strWidget = $this->generateProductOptionWidget($attribute, $arrVariantOptions, $arrAjaxOptions, $objWidget);

                    if ($strWidget != '') {
                        $arrProductOptions[$attribute] = array_merge($arrData, array
                        (
                            'name'    => $attribute,
                            'html'    => $strWidget,
                            'widget'  => $objWidget,
                        ));
                    }

                    unset($objWidget);
                }
            }
        }
        $objTemplate->options = $arrProductOptions;
        $objTemplate->images = [];
        
        //var_dump($this->arrData);exit;
        
        return trim($objTemplate->parse());
    }

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
            return System::getContainer()
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
