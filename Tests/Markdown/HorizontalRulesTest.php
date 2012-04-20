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

class HorizontalRulesTest extends \PHPUnit_Framework_TestCase
{

	private function getMarkdown()
	{
		return new Markdown(array(), array(), 'xhtml');
	}

	public function testHoriRules()
	{
		$md = $this->getMarkdown();
		$text = '---';
		$text2 = '***';
		$text3 = '*******************';
		$markdown = $md->render($text);
		$markdown2 = $md->render($text2);
		$markdown3 = $md->render($text3);
		$expected = '<hr/>'."\n";
		$this->assertEquals($expected, $markdown);
		$this->assertEquals($expected, $markdown2);
		$this->assertEquals($expected, $markdown3);
	}

}