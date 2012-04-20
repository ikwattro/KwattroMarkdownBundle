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
namespace Kwattro\MarkdownBundle\Tests\Markdown;

use Kwattro\MarkdownBundle\Markdown\KwattroMarkdown as Markdown;

class KwattroMarkdownTest extends \PHPUnit_Framework_TestCase
{
    public function testMarkdown()
    {
        $md = new Markdown(array(), array(), 'html');
        $this->assertTrue($md instanceof Markdown);
    }

    public function testMarkdownParser()
    {
        $md = new Markdown(array(), array(), 'html');
        $this->assertTrue($md->getParser() instanceof \Sundown\Markdown);
    }

    public function testDefaultExtensions()
    {
        $md = new Markdown(array(), array(), 'html');
        $extensions = $md->getEnabledExtensions();
        $this->assertTrue($extensions['autolink']);
    }

    public function testRender()
    {
        $md = new Markdown(array(), array(), 'html');
        $link = "https://github.com";
        $expected = '<p><a href="https://github.com">https://github.com</a></p>'."\n";
        $this->assertEquals($expected, $md->render($link));
    }

    public function testSetUpWithArgs()
    {
        $md = new Markdown(array('autolink' => false), array(), 'html');
        $link = "https://github.com";
        $expected = '<p>'.$link.'</p>'."\n";
        $this->assertEquals($expected, $md->render($link));
    }

    public function testRenderWithArgs()
    {
        $md = new Markdown(array(), array(), 'html');
        $link = "https://github.com";
        $expected = '<p>'.$link.'</p>'."\n";
        $this->assertEquals($expected, $md->render($link, array('autolink' => false)));
    }

    public function testNoIntraEmphasis()
    {
        $md = new Markdown(array(), array(), 'html');
        $link = "hello_world_man";
        $expected = '<p>'.$link.'</p>'."\n";
        //$this->assertEquals($expected, $md->render($link, array('no_intraemphasis' => true)));
    }

    public function testWithBaseSundownClasses()
    {
        $md = new \Sundown\Markdown(\Sundown\Render\HTML,array("no_intraemphasis"=>true));
        $txt = "hello_world hello_world";
        $exp = '<p>'.$txt.'</p>'."\n";
        $this->assertEquals($exp, $md->render($txt));
    }

    public function testBlockquotesWithEmptyLines()
    {
        $md = new Markdown(array('lax_html_blocks' => false), array(), 'html');
        $link = "*hello world:*
> one line
> next line is empty
>
> this line is after empty line";
        $expected = "<p><em>hello world:</em></p>
<blockquote>
<p>one line<br/>
next line is empty</p>
<p>this line is after empty line</p>
</blockquote>"."\n";
        $this->assertEquals($expected, $md->render($link, array('autolink' => false)));
    }

    public function testBlockquotesWithCode()
    {
        $md = new Markdown(array('lax_html_blocks' => false), array(), 'html');
        $link = "*hello world:*
> one line
> next line is empty
>
> > nested line
>
>     echo 'hello world';";
        $expected = "<p><em>hello world:</em></p>
<blockquote>
<p>one line<br/>
next line is empty</p>
<blockquote>
<p>nested line</p>
</blockquote>
<pre><code>echo &#39;hello world&#39;;
</code></pre>
</blockquote>"."\n";
        $this->assertEquals($expected, $md->render($link, array('autolink' => false)));
    }

}