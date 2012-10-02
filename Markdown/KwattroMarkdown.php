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
use Sundown\Render\Base as SundownRenderer;

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
     * @var array $flags configuration
     */
    private $flags = array(
        'filter_html' => false,
        'no_images' => false,
        'no_links' => false,
        'no_styles' => false,
        'safe_links_only' => false,
        'with_toc_data' => false,
        'hard_wrap' => true,
        'xhtml' => true,
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
        'custom' => '',
        );

    /**
     * @var string|SundownRenderer $renderer The Sundown renderer
     */
    private $renderer;

    /**
     * Creates a new Markdown instance
     * @param array $extensions_config The enabled extensions
     */

    public function __construct(array $extensions_config, array $flags_config, $renderer, $render_class = null)
    {
        $this->configure($extensions_config, $flags_config, $renderer, $render_class);
    }

    /**
     * Parse the given string with the Sundown Parser
     * @param string $text The text to transform
     * @param array $extensions The extensions configuration
     * @param array $flags The flags configuration
     * @param string|SundownRenderer $renderer The desired renderer
     * @return string The transformed text
     */
    public function render($text, array $extensions = array(), array $flags = array(), $renderer = null)
    {
        $this->configure($extensions, $flags, $renderer);
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
     * @param array $flags
     * @param string|SundownRenderer $renderer
     */
    public function configure(array $extensions = array(), array $flags = array(), $renderer = null, $render_class = null)
    {
        if(!empty($extensions))
        {
            foreach($extensions as $key => $value)
            {
                $this->checkIfValidExtension($key);
            }

            $this->extensions = array_merge($this->extensions, $extensions);
        }

        if(!empty($flags))
        {
            foreach($flags as $key => $value)
            {
                $this->checkIfValidFlag($key);
            }

            $this->flags = array_merge($this->flags, $flags);
        }

        if (!empty($renderer) && $renderer instanceof SundownRenderer)
        {
            $this->renderer = $this->renderers['custom'] = $renderer;
            $this->renderer->setRenderFlags($this->flags);
        }
        elseif(!empty($renderer) && $this->isValidRenderer($renderer, $render_class))
        {
            $this->renderer = new $this->renderers[$renderer]($this->flags);
        }
        else
        {
            $this->renderer = new $this->renderers['html']($this->flags);
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
     * Checks if the given extension is a valid markdown flag
     * @param string $flag
     * @return boolean
     * @throws \InvalidArgumentException
     */
    public function checkIfValidFlag($flag)
    {
        if(!empty($flag) && array_key_exists($flag, $this->flags))
        {
            return true;
        }
        throw new \InvalidArgumentException('The flag '.$flag.' is not a valid Markdown flag');
    }

    /**
     * Checks if the given renderer is a valid renderer
     * @param type $renderer
     * @return boolean
     * @throws \InvalidArgumentException
     */
    public function isValidRenderer($renderer, $render_class = null)
    {
        if(!empty($renderer) && array_key_exists($renderer, $this->renderers))
        {
            if('custom' === $renderer && !class_exists($render_class))
            {
                throw new \InvalidArgumentException('The custom render class you specified could not be found');
            }
            $this->renderers['custom'] = $render_class;
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

    /**
     * Returns an array of the enabled flags
     * @return array
     */
    public function getEnabledFlags()
    {
        $enabled = array();
        foreach($this->flags as $key => $value)
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
