<?php

namespace Lukana\MailtrapChecker\Tests;

use Lukana\MailtrapChecker\MailtrapChecker;

require_once __DIR__ . "/../vendor/autoload.php";

/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2016-11-23
 * Time: 09:40
 */
class MailtrapCheckerTest extends \PHPUnit_Framework_TestCase
{
    private $apiToken = '3c509436f3f6672ed2e27c173d48d2e5';
    /** @var  MailtrapChecker */
    private $mailtrap;
    private $inboxId = 155935;

    protected function setUp()
    {
        parent::setUp();
        $this->mailtrap = new MailtrapChecker($this->apiToken, $this->inboxId);
    }

    public function testClass()
    {
        $this->assertInstanceOf(MailtrapChecker::class, $this->mailtrap);
        $this->assertEquals($this->apiToken, $this->mailtrap->getApiToken());
    }

    public function testInboxList()
    {
        $res = $this->mailtrap->getInboxes();
        $this->assertTrue(is_array($res));
        $this->assertEquals($this->inboxId, $res[0]['id']);
    }

    public function testLastMessage()
    {
        $res = $this->mailtrap->getLastMessage();
        $this->assertTrue(is_array($res));
        $this->assertArrayHasKey('html_body', $res);
    }
}
