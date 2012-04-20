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

class BlockquotesTest extends \PHPUnit_Framework_TestCase
{

	private function getMarkdown()
	{
		return new Markdown(array(), array(), 'xhtml');
	}

	public function testBlockquote()
	{
		$md = $this->getMarkdown();
		$text = '> hello';
		$markdown = $md->render($text);
		$expected = '<blockquote>
<p>hello</p>
</blockquote>'."\n";
		$this->assertEquals($expected, $markdown);
	}

	public function testBlockquoteOnMultipleLine()
	{
		$md = $this->getMarkdown();
		$text = '> hello
> this is a second line
> and another line';
		$markdown = $md->render($text);
		$expected = '<blockquote>
<p>hello<br/>
this is a second line<br/>
and another line</p>
</blockquote>'."\n";
		$this->assertEquals($expected, $markdown);
	}

	public function testBlockquotesWithEmptyLine()
	{
		// Following the Markdown syntax an empty line in a blockquote
		// closes and reopens paragraphs
		$md = $this->getMarkdown();
		$text = '> hello
> this is a second line
>
> and another line';
		$markdown = $md->render($text);
		$expected = '<blockquote>
<p>hello<br/>
this is a second line</p>
<p>and another line</p>
</blockquote>'."\n";
		$this->assertEquals($expected, $markdown);
	}
}