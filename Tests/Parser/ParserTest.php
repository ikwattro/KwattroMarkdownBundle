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
namespace Kwattro\MarkdownBundle\Tests\Parser;

use Kwattro\MarkdownBundle\Parser\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    
    public function testParser()
    {
        $parser = new Parser();
        
        $this->assertTrue($parser instanceof Parser);
    }
    
    
    /**
     * @depends testParser
     */
    public function testsDefaultRenderer()
    {
        $default = new \Sundown\Render\HTML();
        $parser = $this->testParser();
        $renderer = $parser->getRenderer();
        
        $this->assertTrue($renderer instanceof $default);       
    }
    
    public function checkSpecifiedRenderer()
    {
        $render = new \Sundown\Render\XHTML();
        
        $parser = new Parser(array(), 'xhtml');
        
        $this->assertTru($parser->getRenderer() instanceof $render);
    }
}