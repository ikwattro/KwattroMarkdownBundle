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
    private $renderer;
    
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
    protected $config = array(
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
     * @var array enabled extensions - passed to the Markdown instance to configure the rendering
     * Only the true values from config keys are passed to this array. 
     */
    private $enabled_extensions;
    
    /**
     * Create a new Parser instance and configure the enabled extensions
     * 
     * @param array $extensions
     * @param string $renderer
     */
    public function __construct(array $options = array(), $renderer = 'html')
    {
        $this->configure($options);
        $this->renderer = $this->getRenderer($renderer);
    }
    
    
    /**
     * Sepcify enabled extensions of the Markdown instance
     * @param array $options
     * @throws \InvalidArgumentException if an invalid configuration parameter is detected
     */
    public function configure(array $options)
    {
        if(!is_null($options))
        {
            foreach($options as $key => $value)
            {
                if(!array_key_exists($key, $this->config))
                {
                    throw new \InvalidArgumentException('The configuration parameter '.$key.' for the Markdown configuration does not exist');
                }
            }
            $config = array_merge($this->config, $options);
            
            $this->config = $config;
        }
        
        // Creates the enabled_extensions array
        $this->enabled_extensions = array();
        foreach($this->config as $key => $value)
        {
            if($value)
            {
                $this->enabled_extensions[$key] = $value;
            }
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
        if(!empty($renderer) && !in_array($renderer, $this->renderers))
        {
            throw new \InvalidArgumentException('The renderer "'.$renderer.'" is not a valid renderer');
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
    
    /**
     * Render the transformed text as specified by the renderer and the config
     * @param string $text
     * @return string The transformed text 
     */
    public function render($text)
    {
        //$markdown = new Markdown($this->renderer, $this->enabled_extensions);
        $markdown = new Markdown($this->renderer, $this->config);
        
        return $markdown->render($text);
    }
    
}
