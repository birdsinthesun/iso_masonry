<?php
namespace Bits\IsoMasonryBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Bits\IsoMasonryBundle\IsoMasonryBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(IsoMasonryBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class,'isotope','isotope_rules','isotope_reports'])
        ];
    }
}
