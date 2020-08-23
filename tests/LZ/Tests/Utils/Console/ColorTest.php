<?php
/**
 * Copyright 2016. liyunde
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace LZ\Tests\Utils\Console;

use Utils\Console\Color;

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