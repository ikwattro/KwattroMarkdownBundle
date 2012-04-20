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

class ListsTest extends \PHPUnit_Framework_TestCase
{

	private function getMarkdown()
	{
		return new Markdown(array(), array(), 'xhtml');
	}

	public function testUnorderedList()
	{
		$md = $this->getMarkdown();
		$text = '* item
* item
* item';
		$markdown = $md->render($text);
		$expected = '<ul>
<li>item</li>
<li>item</li>
<li>item</li>
</ul>'."\n";
		$this->assertEquals($expected, $markdown);
	}

	public function testOrderedList()
	{
		$md = $this->getMarkdown();
		$text = '1. item
2. item';
		$markdown = $md->render($text);
		$expected = '<ol>
<li>item</li>
<li>item</li>
</ol>'."\n";
		$this->assertEquals($expected, $markdown);
	}
}