<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__)."/TabDelimitedFileIterator.php";

final class StaticTest extends TestCase
{
    public function userAgentStaticProvider()
    {
        return [
            [
                'useragent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko',
                'browser' => Browser::BROWSER_IE,
                'version' => '11.0',
                'platform' => Browser::PLATFORM_WINDOWS,
                'mobile'  => false,
            ],
            [
                'useragent' => 'Mozilla/5.0 (Android 4.4; Mobile; rv:41.0) Gecko/41.0 Firefox/41.0',
                'browser' => Browser::BROWSER_FIREFOX,
                'version' => '41.0',
                'platform' => Browser::PLATFORM_ANDROID,
                'mobile'  => true,
            ],
            [
                'useragent' => 'Mozilla/5.0 (Android 4.4; Tablet; rv:41.0) Gecko/41.0 Firefox/41.0',
                'browser' => Browser::BROWSER_FIREFOX,
                'version' => '41.0',
                'platform' => Browser::PLATFORM_ANDROID,
                'mobile'  => true,
            ],
            [
                'useragent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_4 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) CriOS/28.0.1500.16 Mobile/10B350 Safari/8536.25',
                'browser' => Browser::BROWSER_CHROME,
                'version' => '28.0.1500.16',
                'platform' => Browser::PLATFORM_IPHONE,
                'mobile'  => true,
            ],
            [
                'useragent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/536.11 (KHTML, like Gecko) DumpRenderTree/0.0.0.0 Safari/536.11',
                'browser' => Browser::BROWSER_SAFARI,
                'version' => 'unknown', // all we really know here is that it's based on webkit; we do not really have a version number to deal with
                'platform' => Browser::PLATFORM_LINUX,
                'mobile'  => false,
            ],
            [
                'useragent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 6_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) CriOS/28.0.1500.16 Mobile/10B142 Safari/8536.25',
                'browser' => Browser::BROWSER_CHROME,
                'version' => '28.0.1500.16',
                'platform' => Browser::PLATFORM_IPHONE,
                'mobile'  => true,
            ],
            [
                'useragent' => 'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Radar; Orange)',
                'browser' => Browser::BROWSER_POCKET_IE,
                'version' => '9.0',
                'platform' => Browser::PLATFORM_WINDOWS,
                'mobile'  => true,
            ],
        ];

    }

    /**
     * @dataProvider userAgentStaticProvider
     * @param $userAgent string Browser's User Agent
     * @param $type string Type of the Browser
     * @param $browser string Name of the Browser
     * @param $version string Version of the Browser
     * @param $osType string Type of operating system associated with the Browser
     * @param $osName string Name of the operating system associated with the Browser, typically has the version number
     * @param $osVersionName string Version of the Operating System (name)
     * @param $osVersionNumber string Version of the Operating System (number)
     */
    public function testStaticUserAgent($userAgent,$browser,$version,$platform,$mobile)
    {
        $b = new Browser($userAgent);

        $this->assertSame((string)$browser,  $b->getBrowser());
        $this->assertSame((string)$version,  $b->getVersion());
        $this->assertSame((string)$platform, $b->getPlatform());
        $this->assertSame((boolean)$mobile,  $b->isMobile());
    }
}
