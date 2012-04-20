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

		public function testLazyBlockquoteOnMultipleLine()
	{
		$md = $this->getMarkdown();
		$text = '> hello
this is a second line
and another line';
		$markdown = $md->render($text);
		$expected = '<blockquote>
<p>hello<br/>
this is a second line<br/>
and another line</p>
</blockquote>'."\n";
		$this->assertEquals($expected, $markdown);
	}

	public function testNestedBlockquote()
	{
		$md = $this->getMarkdown();
		$text = '> hello
> this is a second line
>
> > nested blockquote
> > second nested line
>
> and another line';
		$markdown = $md->render($text);
		$expected = '<blockquote>
<p>hello<br/>
this is a second line</p>
<blockquote>
<p>nested blockquote<br/>
second nested line</p>
</blockquote>
<p>and another line</p>
</blockquote>'."\n";
		$this->assertEquals($expected, $markdown);
	}

	public function testBlockquoteContainingMarkdown()
	{
		$md = $this->getMarkdown();
		$text = '> hello
> this is a second line
> ## level2
> second nested line
> and another line
> `<?php echo "hello"; ?>`';
		$markdown = $md->render($text);
		$expected = '<blockquote>
<p>hello<br/>
this is a second line</p>
<h2>level2</h2>
<p>second nested line<br/>
and another line<br/>
<code>&lt;?php echo &quot;hello&quot;; ?&gt;</code></p>
</blockquote>'."\n";
		$this->assertEquals($expected, $markdown);
	}
}