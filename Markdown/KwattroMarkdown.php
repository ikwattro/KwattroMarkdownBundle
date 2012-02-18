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
     * Parse the given string with the Sundown Parser
     * @param string $text
     * @param string $renderer
     * @param array $options
     * @return string The transformed text 
     */
    public function render($text, $renderer = null, array $options = array())
    {        
        $parser = new Parser($options, $renderer);
        
        return $parser->render($text);
    }
}
