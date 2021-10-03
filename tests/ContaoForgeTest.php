<?php


namespace lindesbs\ContaoForge\Tests;

use Contao\TestCase\ContaoTestCase;
use lindesbs\ContaoForge\DependencyInjection\ContaoForgeExtension;
use lindesbs\ContaoForge\ContaoForge;

class ContaoForgeTest extends ContaoTestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new ContaoForge();
        $this->assertInstanceOf(ContaoForge::class, $bundle);
    }

    public function testGetContainerExtension()
    {
        $bundle = new ContaoForge();
        $this->assertInstanceOf(ContaoForge::class, $bundle->getContainerExtension());
    }
}
