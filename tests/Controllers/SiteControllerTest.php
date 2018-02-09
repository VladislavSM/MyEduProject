<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 01.02.18
 * Time: 13:01
 */

namespace MVS\MyEduProject\Tests\Controller;


use MVS\MyEduProject\Application\Models\HomePage;
use PHPUnit\Framework\TestCase;

class SiteControllerTest extends TestCase
{
public function testGetContent(){
    $test = new HomePage();
    $test->content = 'Hello';

   $result = $test->getContent();
    $this->assertEquals('Hello',$result);
}
}