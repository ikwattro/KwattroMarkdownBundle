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
        
        $validRenderers = array('base', 'html', 'xhtml', 'custom');

        $rootNode
        	->children()
                    ->scalarNode('twig_extension')->defaultValue('Kwattro\MarkdownBundle\Twig\Extension\KwattroMarkdownExtension')->end()
                    ->scalarNode('renderer')
                        ->validate()
                        ->ifNotInArray($validRenderers)
                        ->thenInvalid('The renderer specified is not valid')
                        ->end()
                        ->isRequired()
                    ->end()
                    ->scalarNode('render_class')->defaultNull()->end()
                    ->arrayNode('extensions')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->booleanNode('no_intra_emphasis')->defaultFalse()->end()
                            ->booleanNode('tables')->defaultTrue()->end()
                            ->booleanNode('fenced_code_blocks')->defaultTrue()->end()
                            ->booleanNode('autolink')->defaultTrue()->end()
                            ->booleanNode('strikethrough')->defaultTrue()->end()
                            ->booleanNode('lax_html_blocks')->defaultFalse()->end()
                            ->booleanNode('space_after_headers')->defaultTrue()->end()
                            ->booleanNode('superscript')->defaultFalse()->end()
                        ->end()
                    ->end()
                ->end()

                
                ->validate()
                ->ifTrue(function($v){return 'custom' === $v['renderer'] && empty($v['render_class']); })
                ->thenInvalid('You need to specify your custom Renderer class when using the "custom" option')
                ->end()
                        
                ->end();

        return $treeBuilder;
    }
}