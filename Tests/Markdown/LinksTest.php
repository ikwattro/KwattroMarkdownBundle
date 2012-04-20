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

class LinksTest extends \PHPUnit_Framework_TestCase
{

	private function getMarkdown()
	{
		return new Markdown(array(), array(), 'xhtml');
	}

	public function testLink()
	{
		$md = $this->getMarkdown();
		$text = '[the link] (http://www.mysite.com)';
		$markdown = $md->render($text);
		$expected = '<p><a href="http://www.mysite.com">the link</a></p>'."\n";
		$this->assertEquals($expected, $markdown);

		// Link with title attr
		$text = 'This is an [inline link] (http://www.mysite.com "title")';
		$markdown = $md->render($text);
		$expected = '<p>This is an <a href="http://www.mysite.com" title="title">inline link</a></p>'."\n";
		$this->assertEquals($expected, $markdown);

		$text = 'This is an [inline link] (http://www.mysite.com   "title")';//title preceded by two spaces
		$markdown = $md->render($text);
		$this->assertEquals($expected, $markdown);

		$text = 'This is an [inline link] (http://www.mysite.com 	"title")';//title preceded by tab
		$markdown = $md->render($text);
		$this->assertEquals($expected, $markdown);

		$text = 'This is an [inline link] ()';//empty href
		$markdown = $md->render($text);
		$expected = '<p>This is an <a href="">inline link</a></p>'."\n";
		$this->assertEquals($expected, $markdown);
	}
}