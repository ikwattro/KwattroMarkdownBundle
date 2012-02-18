<?php

/**
 * This file is part of the KwattroMarkdownBundle package.
 * 
 * (c) Christophe Willemsen <willemsen.christophe@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that is bundled with this package.
 */

namespace Kwattro\MarkdownBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kwattro_markdown');

        $rootNode
        	->children()
				->scalarNode('twig_extension')->defaultValue('Kwattro\MarkdownBundle\Twig\Extension\KwattroMarkdownExtension')->end()
				->scalarNode('render')->defaultValue('html')->end()
				->end();

        return $treeBuilder;
    }
}
