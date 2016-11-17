<?php

namespace LZ\Tests\Utils\Console;

use LZ\Utils\Console\Color;

/**
 * Created by PhpStorm.
 * User: liyunde
 * Date: 2016/11/17
 * Time: 13:04
 */
class ColorTest extends \PHPUnit_Framework_TestCase
{
    public function testRed(){

        $color = new Color();

        $str = $color->red("I am red font")->_yellow("I has yellow background")->val();

        $str2 = $color->green("我是绿色的")->_purple("紫色的背景")->val();

        echo $str,PHP_EOL,$str2,PHP_EOL;

        self::assertStringStartsNotWith($str,$str2);
    }

    public function testNo(){

    }
}