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

class EmphasisTest extends \PHPUnit_Framework_TestCase
{

	private function getMarkdown()
	{
		return new Markdown(array(), array(), 'xhtml');
	}

	public function testSingleAsterisk()
	{
		$md = $this->getMarkdown();
		$text = '*single asterisk*';
		$markdown = $md->render($text);
		$expected = '<p><em>single asterisk</em></p>'."\n";
		$this->assertEquals($expected, $markdown);
	}

	public function testSingleUnderscore()
	{
		$md = $this->getMarkdown();
		$text = '_single asterisk_';
		$markdown = $md->render($text);
		$expected = '<p><em>single asterisk</em></p>'."\n";
		$this->assertEquals($expected, $markdown);
	}

	public function testDoubleAsterisk()
	{
		$md = $this->getMarkdown();
		$text = '**single asterisk**';
		$markdown = $md->render($text);
		$expected = '<p><strong>single asterisk</strong></p>'."\n";
		$this->assertEquals($expected, $markdown);
	}

	public function testDoubleUnderscore()
	{
		$md = $this->getMarkdown();
		$text = '__single asterisk__';
		$markdown = $md->render($text);
		$expected = '<p><strong>single asterisk</strong></p>'."\n";
		$this->assertEquals($expected, $markdown);
	}

	public function testIntraEmphasis()
	{
		$md = $this->getMarkdown();
		$text = 'single*asterisk*intra';
		$markdown = $md->render($text);
		$expected = '<p>single<em>asterisk</em>intra</p>'."\n";
		$this->assertEquals($expected, $markdown);
	}

	public function testEscapeAsterisk()
	{
		$md = $this->getMarkdown();
		$text = '\*asterisk\*';
		$markdown = $md->render($text);
		$expected = '<p>*asterisk*</p>'."\n";
		$this->assertEquals($expected, $markdown);
	}

	public function testEscapeIntraAsterisk()
	{
		$md = $this->getMarkdown();
		$text = 'intra\*asterisk\*emphasis';
		$markdown = $md->render($text);
		$expected = '<p>intra*asterisk*emphasis</p>'."\n";
		$this->assertEquals($expected, $markdown);
	}
}