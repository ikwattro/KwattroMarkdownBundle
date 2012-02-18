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
     * @var Parser 
     */
    private $parser;
    
    /**
     * Creates a new Markdown instance 
     */
    public function __construct()
    {
        
    }
    
    /**
     * Parse the given string with the Sundown Parser
     * @param string $text
     * @param string $renderer
     * @param array $options
     * @return string The transformed text 
     */
    public function render(string $text, string $renderer = null, array $options = array())
    {
        if(!$this->parser instanceof Parser)
        {
            $this->parser = new Parser($options, $renderer);
        }
        
        return $this->parser->render($text);
    }
}
