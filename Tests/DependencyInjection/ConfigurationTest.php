<?php

/*
 * This file is part of the CKEditorSonataMediaBundle package.
 *
 * (c) La Coopérative des Tilleuls <contact@les-tilleuls.coop>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CoopTilleuls\Bundle\CKEditorSonataMediaBundle\Tests\DependencyInjection;

use CoopTilleuls\Bundle\CKEditorSonataMediaBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testOptions()
    {
        $processor = new Processor();

        $config = $processor->processConfiguration(new Configuration(), array());

        $this->assertArrayHasKey('templates', $config);
        $this->assertArrayHasKey('layout', $config['templates']);
        $this->assertArrayHasKey('browser', $config['templates']);
        $this->assertArrayHasKey('upload', $config['templates']);

        $this->assertEquals('CoopTilleulsCKEditorSonataMediaBundle::layout.html.twig', $config['templates']['layout']);
        $this->assertEquals('CoopTilleulsCKEditorSonataMediaBundle:MediaAdmin:browser.html.twig', $config['templates']['browser']);
        $this->assertEquals('CoopTilleulsCKEditorSonataMediaBundle:MediaAdmin:upload.html.twig', $config['templates']['upload']);
    }
}
