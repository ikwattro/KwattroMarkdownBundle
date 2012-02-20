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

namespace Kwattro\MarkdownBundle\Markdown;

use Kwattro\MarkdownBundle\Parser\Parser;

class KwattroMarkdown
{
    
    /**
     * @var Parser $parser
     */
    private $parser;
    
    /**
     * @var array $extensions configuration 
     */
    private $extensions = array(
        'no_intra_emphasis' => false,
        'tables' => true,
        'fenced_code_blocks' => true,
        'autolink' => true,
        'strikethrough' => true,
        'lax_html_blocks' => false,
        'space_after_headers' => true,
        'superscript' => false,
    );
    
    /**
     * @var array $renderers available renderers
     * Default renderer is 'html', you can specify the desired renderer
     * in the constructor
     * 
     */
    private $renderers = array(
        'base' => '\Sundown\Render\Base',
        'html' => '\Sundown\Render\HTML',
        'xhtml' => '\Sundown\Render\XHTML',
        );
    
    /**
     * @var string $renderer The default renderer specified by the service configuration 
     */
    private $renderer;
    
    /**
     * Creates a new Markdown instance
     * @param array $extensions_config The enabled extensions 
     */
    
    public function __construct(array $extensions_config, $renderer)
    {        
        $this->configure($extensions_config, $renderer);
    }
    
    /**
     * Parse the given string with the Sundown Parser
     * @param string $text The text to transform
     * @param string $renderer The desired renderer
     * @param array $options The extensions configuration
     * @return string The transformed text 
     */
    public function render($text, array $options = array(), $renderer = null)
    {
        $this->configure($options, $renderer);
        
        return $this->transform($text);
    }
    
    /**
     * Set up the Markdown instance if it does not exist 
     */
    public function setUpMarkdown()
    {
        $this->parser = new Parser($this->renderer, $this->extensions);
    }
    
    /**
     * Transforms the text into a markdown style
     * @param string $text
     * @return string $transform 
     */
    public function transform($text)
    {
        return $this->parser->render($text);
    }
    
    /**
     * Configures the Markdown with extensions and renderer sepcified
     * @param array $extensions
     * @param string $renderer 
     */
    public function configure(array $extensions = array(), $renderer = null)
    {
        if(!empty($extensions))
        {
        foreach($extensions as $key => $value)
            {
                $this->checkIfValidExtension($key);
            }
            
        $this->extensions = array_merge($this->extensions, $extensions);
        }
        
        if(!empty($renderer) && $this->isValidRenderer($renderer))
        {
            if(!$this->renderer instanceof $this->renderers[$renderer])
            {
                $this->renderer = new $this->renderers[$renderer];
            }
        }
        
        $this->setUpMarkdown();
    }
    
    /**
     * Checks if the given extension is a valid markdown extension
     * @param string $extension 
     * @return boolean
     * @throws \InvalidArgumentException 
     */
    public function checkIfValidExtension($extension)
    {
        if(!empty($extension) && array_key_exists($extension, $this->extensions))
        {
            return true;
        }
        throw new \InvalidArgumentException('The extension '.$extension.' is not a valid Markdown extension');
    }
    
    /**
     * Checks if the given renderer is a valid renderer
     * @param type $renderer
     * @return boolean
     * @throws \InvalidArgumentException 
     */
    public function isValidRenderer($renderer)
    {
        if(!empty($renderer) && array_key_exists($renderer, $this->renderers))
        {
            return true;
        }
        throw new \InvalidArgumentException('The renderer specified is not a valid renderer for the Markdown service');
    }
    
    /**
     * Returns an array of the enabled extensions
     * @return array 
     */
    public function getEnabledExtensions()
    {
        $enabled = array();
        foreach($this->extensions as $key => $value)
        {
            if($value)
            {
                $enabled[$key] = $value;
            }
        }
        
        return $enabled;
    }
    
    public function getParser()
    {
        return $this->parser;
    }
}
