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
     *@var array extensions configuration 
     */
    private $extensions;
    
    /**
     * Creates a new Markdown instance
     * @param array $enabled_extensions 
     */
    
    public function __construct(array $extensions_config)
    {
        $this->extensions = $extensions_config;
    }
    
    /**
     * Parse the given string with the Sundown Parser
     * @param string $text
     * @param string $renderer
     * @param array $options
     * @return string The transformed text 
     */
    public function render($text, $renderer = null, array $options = array())
    {
        if(!empty($options))
        {
            $this->extensions = $options;
        }
        
        $parser = new Parser($this->extensions, $renderer);
        
        return $parser->render($text);
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
}
