<?php
declare(strict_types=1);

// originally created by - @willemstuursma - https://github.com/willemstuursma

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__)."/TabDelimitedFileIterator.php";

final class CurlWgetTest extends TestCase
{
	/**
	 * @param $user_agent
	 * @param $expected_browser
	 * @param $expected_version
	 *
	 * @dataProvider dpUserAgents
	 */
	public function testBrowserDetectedCorrectly ($user_agent, $expected_browser, $expected_version)
	{
		$browser = new Browser($user_agent);
		$this->assertEquals($expected_browser, $browser->getBrowser());
		$this->assertEquals($expected_version, $browser->getVersion());
	}
	public function dpUserAgents ()
	{
		return array(
			array("curl/7.37.1", Browser::BROWSER_CURL, '7.37.1'),
			array("Wget/1.16 (darwin14.0.0)", Browser::BROWSER_WGET, '1.16'),
		);
	}
} 