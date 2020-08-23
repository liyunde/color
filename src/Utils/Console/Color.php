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
/**
 * User: liyunde
 * Date: 2016/11/15
 * Time: 12:29
 */
namespace Utils\Console;

/**
 * Class Color
 * @package Utils\Console
 *
 * @method $this none(string $str)
 * @method $this high(string $str)
 * @method $this line(string $str)
 * @method $this blink(string $str)
 * @method $this inverse(string $str)
 * @method $this blanking(string $str)
 * @method $this upn(string $str)
 * @method $this down(string $str)
 * @method $this rmvn(string $str)
 * @method $this lmvn(string $str)
 * @method $this cursor(string $str)
 * @method $this clean(string $str)
 * @method $this end(string $str)
 * @method $this save(string $str)
 * @method $this restore(string $str)
 * @method $this hid(string $str)
 * @method $this show(string $str)
 *
 * @method $this black(string $str)
 * @method $this red(string $str)
 * @method $this green(string $str)
 * @method $this yellow(string $str)
 * @method $this blue(string $str)
 * @method $this purple(string $str)
 * @method $this dark_green(string $str)
 * @method $this white(string $str)
 *
 * @method $this _black(string $str)
 * @method $this _red(string $str)
 * @method $this _green(string $str)
 * @method $this _yellow(string $str)
 * @method $this _blue(string $str)
 * @method $this _purple(string $str)
 * @method $this _dark_green(string $str)
 * @method $this _white(string $str)
 */
class Color
{
    private static $front=[
        'none'=>"\033[0m",   // 关闭所有属性
        'high'=>"\033[1m",   // 设置高亮度
        'line'=>"\033[4m",   // 下划线
        'blink'=>"\033[5m",   // 闪烁
        'inverse'=>"\033[7m",   // 反显
        'blanking'=>"\033[8m",   // 消隐
        'upn'=>"\033[nA",   // 光标上移n行
        'down'=>"\033[nB",   // 光标下移n行
        'rmvn'=>"\033[nC",   // 光标右移n行
        'lmvn'=>"\033[nD",   // 光标左移n行
        'cursor'=>"\033[y",    //;xH设置光标位置
        'clean'=>"\033[2J",   // 清屏
        'end'=>"\033[K",    // 清除从光标到行尾的内容
        'save'=>"\033[s",    // 保存光标位置
        'restore'=>"\033[u",    // 恢复光标位置
        'hid'=>"\033[?25l", // 隐藏光标
        'show'=>"\033[?25h", // 显示光标

        //''=>"\033[30m",  // 至 \33[37m 设置前景色
        'black'=>"\033[30m",   //黑
        'red'=>"\033[31m",   //红
        'green'=>"\033[32m",   //绿
        'yellow'=>"\033[33m",   //黄
        'blue'=>"\033[34m",   //蓝色
        'purple'=>"\033[35m",   //紫色
        'dark_green'=>"\033[36m",   //深绿
        'white'=>"\033[37m",   //白色
    ];

    private static $back=[
        //''=>"\033[40m",  // 至 \33[47m 设置背景色
        'black'=>"\033[40m",   //黑
        'red'=>"\033[41m",   //红
        'green'=>"\033[42m",   //绿
        'yellow'=>"\033[43m",   //黄
        'blue'=>"\033[44m",   //蓝色
        'purple'=>"\033[45m",   //紫色
        'dark_green'=>"\033[46m",   //深绿
        'white'=>"\033[47m",   //白色
    ];

    function __call($name, $arguments)
    {
        if(isset(self::$front[$name]) && isset($arguments[0])){

            $this->buffer .= self::$front[$name] . $arguments[0];

        }else if ( strpos($name,'_') === 0 && ($name = substr($name,1)) &&

            isset(self::$back["$name"]) && isset($arguments[0])){

            $this->buffer .= self::$back["$name"] . $arguments[0];
        }

        return $this;
    }

    private $buffer = '';

    private static $current = [];

    /**
     * @return mixed
     */
    public static function GetCurrent()
    {
        return (isset(self::$current['f'])?self::$current['f']:'') .'文字颜色'.
        (isset(self::$current['b'])?self::$current['b']:'').'背景颜色';
    }

    /**
     * 调用此方法后默认会清空缓冲区
     *
     * The __toString method allows a class to decide how it will react when it is converted to a string.
     *
     * @return string
     * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.tostring
     */
    function __toString()
    {
        $tmp = $this->buffer ."\033[0m\n";

        $this->buffer = '';

        return $tmp;
    }

    function val(){

        return $this->__toString();
    }

    /**
     * 设置全局文字 背景颜色
     *
     * @param string $color
     */
    public static function SetBack($color = '')
    {
        if($color == '') {
            unset(self::$current['b']);

            self::Store();
        }else if (isset(self::$back[$color]))
            echo self::$current['b'] = self::$back[$color];
    }

    private static function Store(){

        echo "\033[0m",isset(self::$current['f'])?self::$current['f']:'',"\033[0m",isset(self::$current['b'])?self::$current['b']:'';
    }

    /**
     * 设置全局文字颜色
     *
     * @param string $color
     */
    public static function SetFront($color = '')
    {
        if($color == '') {
            
            unset(self::$current['f']);

            self::Store();

        }else if (isset(self::$front[$color]))
            echo self::$current['f'] = self::$front[$color];
    }

    /**
     * 重置颜色为默认值
     */
    public static function Reset(){

        echo "\033[0m\n";
    }
}