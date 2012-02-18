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
 
 use Kwattro\MarkdownBundle\Markdown\KwattroMarkdown as Markdown;
 
 class KwattroMarkdownExtension extends \Twig_Extension
 {
        /**
         *
         * @var Markdown 
         */
        private $markdown;
        
        /**
         * Creates the Extension instance
         * @param Markdown $markdown 
         */
	public function __construct(Markdown $markdown)
	{
            $this->markdown = $markdown;
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
		'markdown' => new \Twig_Filter_Method($this, 'markdown', array('is_safe'=>array('html')))
		); 
	}
	
	/**
	 * Transforms the text into a markdown style
	 * 
	 * @param string The text to be transformed
         * @param array $options Optional : An array with the extensions options
         * @param string $renderer Optional: The desired renderer
	 * @return string The transformed text
	 */
	public function markdown($string, array $options = array(), $renderer = null)
	{
            return $this->markdown->render($string, $renderer, $options);
	}
 }
