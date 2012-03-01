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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class KwattroMarkdownExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
		
	$this->bindParameters($container, 'kwattro_markdown', $config);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('extensions.yml');
        
        $renderers = array(
            'html' => '\Sundown\Render\HTML',
            'xhtml' => '\Sundown\Render\XHTML',
            'base' => '\Sundown\Render\Base',
        );
        
        if('custom' !== $config['renderer'])
        {
            $container->setParameter('kwattro_markdown.renderer_class', $renderers[$config['renderer']]);
        }
        elseif('custom' === $config['renderer'])
        {
            if(!$config['renderer_class'])
            {
                throw new \InvalidArgumentException('You need to specify your Custom Render class when using the custom option');
            }
            
            if(!class_exists($config['renderer_class']))
            {
                throw new \InvalidArgumentException('The custom render class you specified is not found');
            }
            $container->setParameter('kwattro_markdown.renderer_class', $config['renderer']);
        }
    }
	
	public function getAlias()
	{
		return 'kwattro_markdown';
	}
	
	public function bindParameters(ContainerBuilder $container, $name, $config)
	{
		if(is_array($config))
		{
			foreach ($config as $key => $value) 
			{
				$this->bindParameters($container, $name.'.'.$key, $value);
			}
		}
		else
			{
				$container->setParameter($name, $config);
			}
	}
}