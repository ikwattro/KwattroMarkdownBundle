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

class HeadersTest extends \PHPUnit_Framework_TestCase
{

	private function getMarkdown()
	{
		return new Markdown(array(), array(), 'xhtml');
	}

	/**
	* Test the Setext headers formatting
	*/
	public function testSetextHeaders()
	{
		$md = $this->getMarkdown();

		// Level 1
		$text = '
Level1 title
============';
		$mardown = $md->render($text);
		$expected = '<h1>Level1 title</h1>'."\n";
		$this->assertEquals($expected, $mardown);

		// Level 2
		$level2 = '
Level2 title
------------';
		$markdown = $md->render($level2);
		$expected = '<h2>Level2 title</h2>'."\n";
		$this->assertEquals($expected, $markdown);
	}

	/**
	* Test the ATX Style headers
	*/
	public function testATXHeaders()
	{
		$md = $this->getMarkdown();

		// Level1
		$text = '# Level 1 header';
		$markdown = $md->render($text);
		$expected = '<h1>Level 1 header</h1>'."\n";
		$this->assertEquals($expected, $markdown);

		// Level2
		$text = '## Level 2 header';
		$markdown = $md->render($text);
		$expected = '<h2>Level 2 header</h2>'."\n";
		$this->assertEquals($expected, $markdown);

		// Level3
		$text = '### Level 3 header';
		$markdown = $md->render($text);
		$expected = '<h3>Level 3 header</h3>'."\n";
		$this->assertEquals($expected, $markdown);

		// Level4
		$text = '#### Level 4 header';
		$markdown = $md->render($text);
		$expected = '<h4>Level 4 header</h4>'."\n";
		$this->assertEquals($expected, $markdown);

		// Level5
		$text = '##### Level 5 header';
		$markdown = $md->render($text);
		$expected = '<h5>Level 5 header</h5>'."\n";
		$this->assertEquals($expected, $markdown);

		// Level6
		$text = '###### Level 6 header';
		$markdown = $md->render($text);
		$expected = '<h6>Level 6 header</h6>'."\n";
		$this->assertEquals($expected, $markdown);

	}

	/**
	* Normally a space is required between the # and the beginning of the header
	*/
	public function testIsNotHeader()
	{
		$md = $this->getMarkdown();
		$text = '#Level';
		$markdown = $md->render($text);
		$expected = '<h1>Level</h1>'."\n";
		$this->assertEquals($expected, $markdown);
	}

	/**
	* We can also close headers for readibility purposes
	*/
	public function testClosedHeaders()
	{
		$md = $this->getMarkdown();
		$text = '###### Level 6 header ######';
		$markdown = $md->render($text);
		$expected = '<h6>Level 6 header</h6>'."\n";
		$this->assertEquals($expected, $markdown);	
	}

	public function testHeadersAfterAndBeforParagraphs()
	{
		$md = $this->getMarkdown();
		$text = 'This is some text
# Level
This is some text';
		$markdown = $md->render($text);
		$expected = '<p>This is some text</p>
<h1>Level</h1>
<p>This is some text</p>'."\n";
		$this->assertEquals($expected, $markdown);

		$text = 'This is some text
With a title
============
This is some text';
		$markdown = $md->render($text);
		$expected = '<p>This is some text</p>
<h1>With a title</h1>
<p>This is some text</p>'."\n";
		$this->assertEquals($expected, $markdown);	
	}
}