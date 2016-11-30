<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 09.06.2016
 * Time: 15:36
 */

namespace app\modules\cms;

trait cmstrait
{
    public function HelloWorld()
    {
        return 'Hello World!!';
    }

    public function testMethod() {
        echo "Class: " . __CLASS__ . PHP_EOL;
        echo "Trait: " . __TRAIT__ . PHP_EOL;
    }
}