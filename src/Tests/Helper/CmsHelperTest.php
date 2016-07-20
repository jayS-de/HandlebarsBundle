<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace JaySDe\HandlebarsBundle\Tests\Helper;


use JaySDe\HandlebarsBundle\Helper\CmsHelper;

class CmsHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testHandle()
    {
        $observer = $this->prophesize('\JaySDe\HandlebarsBundle\Helper\TranslationHelper');
        $observer->handle('test', [])->willReturn('lorem ipsum')->shouldBeCalled();
        $helper = new CmsHelper($observer->reveal());

        $test = $helper->handle('test', []);
        $this->assertSame('lorem ipsum', $test);
    }

    public function testHandleWithOptions()
    {
        $observer = $this->prophesize('\JaySDe\HandlebarsBundle\Helper\TranslationHelper');
        $observer->handle('test', ['foo' => 'bar'])->willReturn('lorem ipsum')->shouldBeCalled();
        $helper = new CmsHelper($observer->reveal());

        $test = $helper->handle('test', ['hash' => ['foo' => 'bar']]);
        $this->assertSame('lorem ipsum', $test);
    }

    public function testHandleWithBundle()
    {
        $observer = $this->prophesize('\JaySDe\HandlebarsBundle\Helper\TranslationHelper');
        $observer->handle('foo:test', [])->willReturn('lorem ipsum')->shouldBeCalled();
        $helper = new CmsHelper($observer->reveal());

        $test = $helper->handle('test', ['hash' => ['bundle' => 'foo']]);
        $this->assertSame('lorem ipsum', $test);
    }

    public function testHandleWithOptionsAndBundle()
    {
        $observer = $this->prophesize('\JaySDe\HandlebarsBundle\Helper\TranslationHelper');
        $observer->handle('foo:test', ['foo' => 'bar'])->willReturn('lorem ipsum')->shouldBeCalled();
        $helper = new CmsHelper($observer->reveal());

        $test = $helper->handle('test', ['hash' => ['foo' => 'bar', 'bundle' => 'foo']]);
        $this->assertSame('lorem ipsum', $test);
    }
}