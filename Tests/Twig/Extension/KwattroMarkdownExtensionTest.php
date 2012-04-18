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
namespace Kwattro\MarkdownBundle\Tests\Twig\Extension;

use Kwattro\MarkdownBundle\Twig\Extension\KwattroMarkdownExtension as TwigMarkdown;
use Kwattro\MarkdownBundle\Markdown\KwattroMarkdown as Markdown;

class KwattroMarkdownExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $link = 'https://github.com';
        $expected = '<p><a href="https://github.com">https://github.com</a></p>'."\n";
        $md = new Markdown(array(), array(), 'html');
        $twig = new TwigMarkdown($md);
        $this->assertEquals($expected, $twig->markdown($link));
    }
}
