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

 namespace Kwattro\MarkdownBundle\Twig\Extension;
 
 class KwattroMarkdownExtension extends \Twig_Extension
 {
 	protected $markdown;
	
	protected $render;
	
	public function __construct()
	{
		
	}
	
	/**
	 * Returns the name of the extension
	 * 
	 * @return string The name of the extension
	 */
	public function getName()
	{
		return 'kwattro_markdown';
	}
	
	/**
	 * Add the extension filters to the twig registered filters
	 */
	public function getFilters()
	{
		return array(
		'markdown' => new \Twig_Filter_Method($this, 'markdown')
		); 
	}
	
	/**
	 * Transforms the text into a markdown style
	 * 
	 * @param string The text to be transformed
	 * @return string The transformed text
	 */
	public function markdown($string)
	{
		$markdown = new \Sundown\Markdown(\Sundown\Render\HTML);
		$mdown = $markdown->render($string);
		
		return $mdown;
	}
 }
