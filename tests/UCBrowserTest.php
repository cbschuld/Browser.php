<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__)."/TabDelimitedFileIterator.php";

final class UCBrowserTest extends TestCase
{
    /**
     * @dataProvider userAgentUCBrowserProvider
     * @param $userAgent string Browser's User Agent
     * @param $type string Type of the Browser
     * @param $browser string Name of the Browser
     * @param $version string Version of the Browser
     * @param $osType string Type of operating system associated with the Browser
     * @param $osName string Name of the operating system associated with the Browser, typically has the version number
     * @param $osVersionName string Version of the Operating System (name)
     * @param $osVersionNumber string Version of the Operating System (number)
     */
    public function testUCBrowserUserAgent($userAgent,$type,$browser,$version,$osType,$osName,$osVersionName,$osVersionNumber)
    {
        $b = new Browser($userAgent);

        $this->assertSame($browser, $b->getBrowser());
        $this->assertSame($version, $b->getVersion());
    }

    public function userAgentUCBrowserProvider()
    {
        return new TabDelimitedFileIterator(dirname(__FILE__).'/lists/ucbrowser.txt');
    }
}
