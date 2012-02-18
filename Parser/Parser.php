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

namespace Kwattro\MarkdownBundle\Parser;

use \Sundown\Markdown as Markdown;

class Parser
{
    
    /**
     * @var Markdown 
     */
    private $markdown;
    
    /**
     * @var array available renderers
     * Default renderer is 'html', you can specify the desired renderer
     * in the constructor
     * 
     */
    private $renderers = array('base', 'html', 'xhtml');
    
    /**
     * @var string renderer
     * 
     * The renderer to be used 
     */
    
    /**
     * @var boolean no_intra_emphasis
     * 
     * Do not parse emphasis inside of words.
     * Strings such as `foo_bar_baz` will not generate <em> tags. 
     * 
     * Default : false
     */
    private $no_intra_emphasis;
    
    /**
     * @var boolean autolink
     *  
     * Parse links even when they are not enclosed in <> characters.
     * Autolinks for the http, https and ftp protocols will be automatically
     * detected. Email addresses are also handled, and http links without
     * protocol, but starting with www .
     */
    private $autolink;
    
    /**
     * @var array the default configuration
     *  
     */
    private $config = array(
        'no_intra_emphasis' => false,
        'autolink' => true,
    );
    
    /**
     * Create a new Parser instance and configure the enabled extensions
     * 
     * @param array $extensions
     * @param string $renderer
     * @return Parser $parser
     */
    public function __construct(array $options = array(), $renderer = 'html')
    {
        $this->configure($options, $renderer);
        $this->getRenderer($renderer);
        
        $parser = new Markdown($renderer, $options);
        
        return $parser;
    }
    
    
    /**
     * Sepcify enabled extensions of the Markdown instance
     * @param array $options
     * @throws \InvalidArgumentException if an invalid configuration parameter is detected
     */
    public function configure(array $options)
    {
        if(!null($options))
        {
            foreach($options as $key => $value)
            {
                if(!array_key_exists($key, $config))
                {
                    throw new \InvalidArgumentException('The configuration parameter '.$key.' for the Markdown configuration does not exist');
                }
            }
            array_merge($this->config, $options);
        }
    }
    
    /**
     *
     * @param string $renderer
     * @return \Sundown\Render\Base|\Sundown\Render\HTML|\Sundown\Render\XHTML
     * @throws \InvalidArgumentException 
     */
    public function getRenderer($renderer)
    {
        if(!array_key_exists($renderer, $this->renderers))
        {
            throw new \InvalidArgumentException('The renderer specified is not a valid renderer');
        }
        
        switch($renderer)
        {
            case 'base':
                return new \Sundown\Render\Base();
                break;
            
            case 'html':
                return new \Sundown\Render\HTML();
                break;
            
            case 'xhtml':
                return new \Sundown\Render\XHTML();
                break;
            
            default:
                return new \Sundown\Render\HTML();
                break;
        }
    }
    
}
