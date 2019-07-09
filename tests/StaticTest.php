<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__)."/TabDelimitedFileIterator.php";

final class StaticTest extends TestCase
{
    public function testStaticUserAgent()
    {
        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko' => [
                'browser' => Browser::BROWSER_IE,
                'version' => '11.0'
            ]
        ];
        foreach($userAgents as $userAgent => $info) {
            $b = new Browser($userAgent);
            $this->assertSame($info['browser'], $b->getBrowser());
            $this->assertSame($info['version'], $b->getVersion());
            }

    }
}
