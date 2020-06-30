<?php

/*
 * This file is part of the CKEditorSonataMediaBundle package.
 *
 * (c) La Coopérative des Tilleuls <contact@les-tilleuls.coop>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CoopTilleuls\Bundle\CKEditorSonataMediaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 *
 * @author Kévin Dunglas <kevin@les-tilleuls.coop>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('coop_tilleuls_ck_editor_sonata_media');
        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $rootNode = $treeBuilder->root('coop_tilleuls_ck_editor_sonata_media');
        }

        $rootNode
            ->children()
                ->arrayNode('templates')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('layout')->defaultValue('@CoopTilleulsCKEditorSonataMedia/layout.html.twig')->cannotBeEmpty()->end()
                        ->scalarNode('browser')->defaultValue('@CoopTilleulsCKEditorSonataMedia/MediaAdmin/browser.html.twig')->cannotBeEmpty()->end()
                        ->scalarNode('upload')->defaultValue('@CoopTilleulsCKEditorSonataMedia/MediaAdmin/upload.html.twig')->cannotBeEmpty()->end()
                    ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
