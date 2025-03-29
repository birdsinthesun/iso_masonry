<?php
namespace Bits\IsoMasonryBundle\EventListener;

use Contao\System;
use Isotope\Model\AttributeOption;
use Bits\IsoMasonryBundle\Service\ImageResizer;


class ProductRenderingListener
{
     
    public function alterProductRendering($objTemplate, $objProduct, $arrConfig)
    {
        
        $arrImages = deserialize($objProduct->__get('images'));
        $isotopeSubFolder = mb_substr($arrImages[0]['src'],0,1);
        $imageResizer = new ImageResizer();
        
        if($objProduct->getType()->__get('name') == 'Tattoo'){
                
                $arrAttributeMotiv = explode(',',$objProduct->__get('motiv'));
                $arrMotiv = [];
                foreach($arrAttributeMotiv as $key => $Motiv){
                    $arrMotiv[$key]['label'] = AttributeOption::findPublishedByIds([$Motiv],[])->__get('label');
                    $arrMotiv[$key]['alias'] = $this->generateAlias($arrMotiv[$key]['label']);
                    }
                    
                //$objTemplate->setData(['arr_motiv'=>$arrMotiv]);
                $objProduct->__set('arr_motiv',$arrMotiv);
                //var_dump($objTemplate->product);
                //$objTemplate->product = $objProduct;
                $objTemplate->arr_motiv = $arrMotiv;
                
                
                $objTemplate->src_preview = $imageResizer->resizeAndCacheImage("/isotope/".$isotopeSubFolder."/".$arrImages[0]['src'], 300,null);
                $objTemplate->src_fullsize = $imageResizer->resizeAndCacheImage("/isotope/".$isotopeSubFolder."/".$arrImages[0]['src'], null,900);
        }elseif($objProduct->getType()->__get('name') == 'Amazon'){
            
                $objTemplate->src = $imageResizer->resizeAndCacheImage("/isotope/".$isotopeSubFolder."/".$arrImages[0]['src'], 400,400);
       
            
        }
        
        
    }
    
    private function generateAlias(string $input): string
    {
        $alias = strip_tags($input);

        $transliteration = [
            'ä' => 'ae', 'ö' => 'oe', 'ü' => 'ue', 'ß' => 'ss',
            'Ä' => 'Ae', 'Ö' => 'Oe', 'Ü' => 'Ue',
        ];
        $alias = strtr($alias, $transliteration);

        $alias = preg_replace('/[^a-zA-Z0-9\-]+/', '-', $alias);
        $alias = trim($alias, '-');
        return strtolower($alias);
    }
}