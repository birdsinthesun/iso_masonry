<?php
namespace Bits\IsoMasonryBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class IsoMasonryBundle extends Bundle
{
      public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
