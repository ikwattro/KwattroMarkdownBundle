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

class CodeBlocksTest extends \PHPUnit_Framework_TestCase
{

	private function getMarkdown()
	{
		return new Markdown(array(), array(), 'xhtml');
	}

	public function testCodeBlockWithIndentationStart()
	{
		$md = $this->getMarkdown();
		$text = '	some code here
	and some code here';
		$markdown = $md->render($text);
		$expected = '<pre><code>some code here
and some code here
</code></pre>'."\n";
		$this->assertEquals($expected, $markdown);
	}

	public function testCodeBlockWithIndentationStop()
	{
		$md = $this->getMarkdown();
		$text = '	some code here
and some code here';
		$markdown = $md->render($text);
		$expected = '<pre><code>some code here
</code></pre>
<p>and some code here</p>'."\n";
		$this->assertEquals($expected, $markdown);
	}
}