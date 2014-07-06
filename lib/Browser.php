<?php


/**
 * File: Browser.php
 * Author: Chris Schuld (http://chrisschuld.com/)
 * Last Modified: July 6th, 2014
 * @version 2.0
 * @package PegasusPHP
 *
 * Copyright (C) 2008-2010 Chris Schuld  (chris@chrisschuld.com)
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details at:
 * http://www.gnu.org/copyleft/gpl.html
 *
 *
 * Typical Usage:
 *
 *   $browser = new Browser();
 *   if( $browser->getBrowser() == Browser::BROWSER_FIREFOX && $browser->getVersion() >= 2 ) {
 *    echo 'You have FireFox version 2 or greater';
 *   }
 *
 * User Agents Sampled from: http://www.useragentstring.com/
 *
 * This implementation is based on the original work from Gary White
 * http://apptools.com/phptools/browser/
 *
 */

class Browser
{
    private $_agent = '';
    private $_browser_name = '';
    private $_version = '';
    private $_platform = '';
    private $_os = '';
    private $_is_aol = false;
    private $_is_mobile = false;
    private $_is_tablet = false;
    private $_is_robot = false;
    private $_is_facebook = false;
    private $_aol_version = '';

    const BROWSER_UNKNOWN = 'unknown';
    const VERSION_UNKNOWN = 'unknown';

    const BROWSER_OPERA = 'Opera'; // http://www.opera.com/
    const BROWSER_OPERA_MINI = 'Opera Mini'; // http://www.opera.com/mini/
    const BROWSER_WEBTV = 'WebTV'; // http://www.webtv.net/pc/
    const BROWSER_IE = 'Internet Explorer'; // http://www.microsoft.com/ie/
    const BROWSER_POCKET_IE = 'Pocket Internet Explorer'; // http://en.wikipedia.org/wiki/Internet_Explorer_Mobile
    const BROWSER_KONQUEROR = 'Konqueror'; // http://www.konqueror.org/
    const BROWSER_ICAB = 'iCab'; // http://www.icab.de/
    const BROWSER_OMNIWEB = 'OmniWeb'; // http://www.omnigroup.com/applications/omniweb/
    const BROWSER_FIREBIRD = 'Firebird'; // http://www.ibphoenix.com/
    const BROWSER_FIREFOX = 'Firefox'; // http://www.mozilla.com/en-US/firefox/firefox.html
    const BROWSER_ICEWEASEL = 'Iceweasel'; // http://www.geticeweasel.org/
    const BROWSER_SHIRETOKO = 'Shiretoko'; // http://wiki.mozilla.org/Projects/shiretoko
    const BROWSER_MOZILLA = 'Mozilla'; // http://www.mozilla.com/en-US/
    const BROWSER_AMAYA = 'Amaya'; // http://www.w3.org/Amaya/
    const BROWSER_LYNX = 'Lynx'; // http://en.wikipedia.org/wiki/Lynx
    const BROWSER_SAFARI = 'Safari'; // http://apple.com
    const BROWSER_IPHONE = 'iPhone'; // http://apple.com
    const BROWSER_IPOD = 'iPod'; // http://apple.com
    const BROWSER_IPAD = 'iPad'; // http://apple.com
    const BROWSER_CHROME = 'Chrome'; // http://www.google.com/chrome
    const BROWSER_ANDROID = 'Android'; // http://www.android.com/
    const BROWSER_GOOGLEBOT = 'GoogleBot'; // http://en.wikipedia.org/wiki/Googlebot
    const BROWSER_SLURP = 'Yahoo! Slurp'; // http://en.wikipedia.org/wiki/Yahoo!_Slurp
    const BROWSER_W3CVALIDATOR = 'W3C Validator'; // http://validator.w3.org/
    const BROWSER_BLACKBERRY = 'BlackBerry'; // http://www.blackberry.com/
    const BROWSER_ICECAT = 'IceCat'; // http://en.wikipedia.org/wiki/GNU_IceCat
    const BROWSER_NOKIA_S60 = 'Nokia S60 OSS Browser'; // http://en.wikipedia.org/wiki/Web_Browser_for_S60
    const BROWSER_NOKIA = 'Nokia Browser'; // * all other WAP-based browsers on the Nokia Platform
    const BROWSER_MSN = 'MSN Browser'; // http://explorer.msn.com/
    const BROWSER_MSNBOT = 'MSN Bot'; // http://search.msn.com/msnbot.htm
    const BROWSER_BINGBOT = 'Bing Bot'; // http://en.wikipedia.org/wiki/Bingbot

    const BROWSER_NETSCAPE_NAVIGATOR = 'Netscape Navigator'; // http://browser.netscape.com/ (DEPRECATED)
    const BROWSER_GALEON = 'Galeon'; // http://galeon.sourceforge.net/ (DEPRECATED)
    const BROWSER_NETPOSITIVE = 'NetPositive'; // http://en.wikipedia.org/wiki/NetPositive (DEPRECATED)
    const BROWSER_PHOENIX = 'Phoenix'; // http://en.wikipedia.org/wiki/History_of_Mozilla_Firefox (DEPRECATED)

    //PLATFORMS. Newly added obtained from http://user-agent-string.info/list-of-ua/os
	const PLATFORM_UNKNOWN = 'unknown';
	
	//BLACKBERRY
	const PLATFORM_BLACKBERRY = 'BlackBerry';
	const PLATFORM_BLACKBERRY_TABLET_OS_1 = 'BlackBerry Tablet OS 1';
	const PLATFORM_BLACKBERRY_TABLET_OS_2 = 'BlackBerry Tablet OS 2';

	//WINDOWS
	const PLATFORM_WINDOWS = 'Windows';
	const PLATFORM_WINDOWS_CE = 'Windows CE';
	const PLATFORM_WINDOWS_8_1 = 'Windows 8.1';
	const PLATFORM_WINDOWS_RT = 'Windows RT';
	const PLATFORM_WINDOWS_8 = 'Windows 8';
	const PLATFORM_WINDOWS_7 = 'Windows 7';
	const PLATFORM_WINDOWS_VISTA = 'Windows Vista';
	const PLATFORM_WINDOWS_SERVER = 'Windows 2003 Server';
	const PLATFORM_WINDOWS_XP = 'Windows XP';
	const PLATFORM_WINDOWS_2000 = 'Windows 2000';
	const PLATFORM_WINDOWS_ME = 'Windows ME';
	const PLATFORM_WINDOWS_98 = 'Windows 98';
	const PLATFORM_WINDOWS_95 = 'Windows 95';
	const PLATFORM_WINDOWS_3 = 'Windows 3';
	const PLATFORM_WINDOWS_NT = 'Windows NT';
	const PLATFORM_WINDOWS_MOBILE = 'Windows Mobile';
	const PLATFORM_WINDOWS_PHONE_7 = 'Windows Phone 7';
	const PLATFORM_WINDOWS_PHONE_8 = 'Windows Phone 8';
	const PLATFORM_WINDOWS_PHONE_8_1 = 'Windows Phone 8.1';

	//CONSOLES
	const PLATFORM_XMB = 'XrossMediaBar (Playstation 3|Playstation Portable)';
	const PLATFORM_LIVE_AREA = 'LiveArea (Playstation Vita)';
	const PLATFORM_ORBIS = 'Orbis OS (Playstation 4)';
	const PLATFORM_NINTENDO_DS = 'Nintendo DS';
	const PLATFORM_NINTENDO_3DS = 'Nintendo 3DS';
	const PLATFORM_NINTENDO_WII = 'Wii OS (Nintendo Wii)';
	const PLATFORM_NINTENDO_WIIU = 'Wii U OS (Nintendo Wii U)';
	const PLATFORM_XBOX = 'Xbox OS (Xbox (Original|360|One))';

	//mobile
	const PLATFORM_FIREFOX = 'FireFox OS';
	const PLATFORM_TIZEN_1 = 'Tizen 1';
	const PLATFORM_TIZEN_2 = 'Tizen 2';
	const PLATFORM_WEBOS = 'WebOS';

	//ANDROID
	const PLATFORM_ANDROID = 'Android';
	const PLATFORM_ANDROID_1 = 'Android 1';
	const PLATFORM_ANDROID_1_5 = 'Android 1.5 Cupcake';
	const PLATFORM_ANDROID_1_6 = 'Android 1.6 Donut';
	const PLATFORM_ANDROID_2 = 'Android 2.0/1 Eclair';
	const PLATFORM_ANDROID_2_2 = 'Android 2.2 Froyo';
	const PLATFORM_ANDROID_2_3 = 'Android 2.3 Gingerbread';
	const PLATFORM_ANDROID_3 = 'Android 3 Honeycomb';
	const PLATFORM_ANDROID_4 = 'Android 4.0 Ice Cream Sandwich';
	const PLATFORM_ANDROID_4_1 = 'Android 4.1 Jelly Bean';
	const PLATFORM_ANDROID_4_2 = 'Android 4.2 Jelly Bean';
	const PLATFORM_ANDROID_4_3 = 'Android 4.3 Jelly Bean';
	const PLATFORM_ANDROID_4_4 = 'Android 4.4 KitKat';

	//IOS
	const PLATFORM_IOS = 'iOS';
	const PLATFORM_IOS_4 = 'iOS 4';
	const PLATFORM_IOS_5 = 'iOS 5';
	const PLATFORM_IOS_6 = 'iOS 6';
	const PLATFORM_IOS_7 = 'iOS 7';
	const PLATFORM_IOS_8 = 'iOS 8';

	//MAC OS
	const PLATFORM_MAC = 'Mac OS';
	const PLATFORM_MAC_X = 'Mac OS X';
	const PLATFORM_MAC_X_10_3 = 'Mac OS X 10.3 Panther';
	const PLATFORM_MAC_X_10_4 = 'Mac OS X 10.4 Tiger';
	const PLATFORM_MAC_X_10_5 = 'Mac OS X 10.5 Leopard';
	const PLATFORM_MAC_X_10_6 = 'Mac OS X 10.6 Snow Leopard';
	const PLATFORM_MAC_X_10_7 = 'Mac OS X 10.7 Lion';
	const PLATFORM_MAC_X_10_8 = 'Mac OS X 10.8 Mountain Lion';
	const PLATFORM_MAC_X_10_9 = 'Mac OS X 10.9 Mavericks';
	const PLATFORM_MAC_X_10_10 = 'Mac OS X 10.10 Yosemite';

	//LINUX
	const PLATFORM_LINUX = 'Linux';
	const PLATFORM_LINUX_ARCH = 'Linux (Arch Linux)';
	const PLATFORM_LINUX_CENTOS = 'Linux (CentOS)';
	const PLATFORM_LINUX_DEBIAN = 'Linux (Debian)';
	const PLATFORM_LINUX_FEDORA = 'Linux (Fedora)';
	const PLATFORM_LINUX_GENTOO = 'Linux (Gentoo)';
	const PLATFORM_LINUX_KANOTIX = 'Linux (Kanotix)';
	const PLATFORM_LINUX_KNOPPIX = 'Linux (Knoppix)';
	const PLATFORM_LINUX_LINSPIRE = 'Linux (Linspire)';
	const PLATFORM_LINUX_MAEMO = 'Linux (Maemo)';
	const PLATFORM_LINUX_MAGEIA = 'Linux (Mageia)';
	const PLATFORM_LINUX_MANDRIVA = 'Linux (Mandriva)';
	const PLATFORM_LINUX_MINT = 'Linux (Mint)';
	const PLATFORM_LINUX_REDHAT = 'Linux (RedHat)';
	const PLATFORM_LINUX_SLACKWARE = 'Linux (slackware)';
	const PLATFORM_LINUX_SUSE = 'Linux (Suse)';
	const PLATFORM_LINUX_UBUNTU = 'Linux (Ubuntu)';
	const PLATFORM_LINUX_VECTOR = 'Linux (VectorLinux)';
	const PLATFORM_LINUX_PCLINUX = 'Linux (PCLinuxOS)';

	//other
	const PLATFORM_AIX = 'AIX';
	const PLATFORM_AMIGA = 'Amiga OS';
	const PLATFORM_AROS = 'AROS';
	const PLATFORM_BADA = 'Bada';
	const PLATFORM_BEOS = 'BeOS';
	const PLATFORM_BREW = 'Brew';
	const PLATFORM_CROME = 'Crome OS';
	const PLATFORM_DANGER_HIPTOP = 'Danger Hiptop';
	const PLATFORM_DRAGONFLY_BSD = 'DragonFly BSD';
	const PLATFORM_GNU = 'GNU OS';
	const PLATFORM_HAIKU = 'Haiku OS';
	const PLATFORM_HP = 'HP-UX';
	const PLATFORM_INFERNO = 'Inferno OS';
	const PLATFORM_IRIX = 'IRIX';
	const PLATFORM_JOLI = 'Joli OS';
	const PLATFORM_JVM = 'JVM (Java)';
	const PLATFORM_MEEGO = 'MeeGo';
	const PLATFORM_MINIX_3 = 'MINIX 3';
	const PLATFORM_MORPHOS = 'MorphOs';
	const PLATFORM_MSN_TV = 'MSN TV (WebTV)';
	const PLATFORM_NETBSD = 'NetBSD';
	const PLATFORM_OPENBSD = 'OpenBSD';
	const PLATFORM_OPENVMS = 'OpenVMS';
	const PLATFORM_OS2 = 'OS/2';
	const PLATFORM_OS2_WARP = 'OS/2 Warp';
	const PLATFORM_PALM = 'Palm OS';
	const PLATFORM_QNX = 'QNX x86pc';
	const PLATFORM_RISK = 'RISK OS';
	const PLATFORM_SAILFISH = 'Sailfish';
	const PLATFORM_SUNOS = 'Solaris';
	const PLATFORM_SYLLABLE = 'Syllable';
	const PLATFORM_SYMBIAN = 'Symbian OS';
	const PLATFORM_UBUNTU_TOUCH = 'Ubuntu Touch';
	const PLATFORM_FREEBSD = 'FreeBSD';
	const PLATFORM_OPENSOLARIS = 'OpenSolaris';
	const PLATFORM_NOKIA = 'Nokia';

	const OPERATING_SYSTEM_UNKNOWN = 'unknown';

    public function Browser($userAgent = "")
    {
        $this->reset();
        if ($userAgent != "") {
            $this->setUserAgent($userAgent);
        } else {
            $this->determine();
        }
    }

    /**
     * Reset all properties
     */
    public function reset()
    {
        $this->_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";
        $this->_browser_name = self::BROWSER_UNKNOWN;
        $this->_version = self::VERSION_UNKNOWN;
        $this->_platform = self::PLATFORM_UNKNOWN;
        $this->_os = self::OPERATING_SYSTEM_UNKNOWN;
        $this->_is_aol = false;
        $this->_is_mobile = false;
        $this->_is_tablet = false;
        $this->_is_robot = false;
        $this->_is_facebook = false;
        $this->_aol_version = self::VERSION_UNKNOWN;
    }

    /**
     * Check to see if the specific browser is valid
     * @param string $browserName
     * @return bool True if the browser is the specified browser
     */
    function isBrowser($browserName)
    {
        return (0 == strcasecmp($this->_browser_name, trim($browserName)));
    }

    /**
     * The name of the browser.  All return types are from the class contants
     * @return string Name of the browser
     */
    public function getBrowser()
    {
        return $this->_browser_name;
    }

    /**
     * Set the name of the browser
     * @param $browser string The name of the Browser
     */
    public function setBrowser($browser)
    {
        $this->_browser_name = $browser;
    }

    /**
     * The name of the platform.  All return types are from the class contants
     * @return string Name of the browser
     */
    public function getPlatform()
    {
        return $this->_platform;
    }

    /**
     * Set the name of the platform
     * @param string $platform The name of the Platform
     */
    public function setPlatform($platform)
    {
        $this->_platform = $platform;
    }

    /**
     * The version of the browser.
     * @return string Version of the browser (will only contain alpha-numeric characters and a period)
     */
    public function getVersion()
    {
        return $this->_version;
    }

    /**
     * Set the version of the browser
     * @param string $version The version of the Browser
     */
    public function setVersion($version)
    {
        $this->_version = preg_replace('/[^0-9,.,a-z,A-Z-]/', '', $version);
    }

    /**
     * The version of AOL.
     * @return string Version of AOL (will only contain alpha-numeric characters and a period)
     */
    public function getAolVersion()
    {
        return $this->_aol_version;
    }

    /**
     * Set the version of AOL
     * @param string $version The version of AOL
     */
    public function setAolVersion($version)
    {
        $this->_aol_version = preg_replace('/[^0-9,.,a-z,A-Z]/', '', $version);
    }

    /**
     * Is the browser from AOL?
     * @return boolean True if the browser is from AOL otherwise false
     */
    public function isAol()
    {
        return $this->_is_aol;
    }

    /**
     * Is the browser from a mobile device?
     * @return boolean True if the browser is from a mobile device otherwise false
     */
    public function isMobile()
    {
        return $this->_is_mobile;
    }

    /**
     * Is the browser from a tablet device?
     * @return boolean True if the browser is from a tablet device otherwise false
     */
    public function isTablet()
    {
        return $this->_is_tablet;
    }

    /**
     * Is the browser from a robot (ex Slurp,GoogleBot)?
     * @return boolean True if the browser is from a robot otherwise false
     */
    public function isRobot()
    {
        return $this->_is_robot;
    }

    /**
    * Is the browser from facebook?
    * @return boolean True if the browser is from facebook otherwise false
    */
    public function isFacebook() 
    { 
        return $this->_is_facebook;
    }

    /**
     * Set the browser to be from AOL
     * @param $isAol
     */
    public function setAol($isAol)
    {
        $this->_is_aol = $isAol;
    }

    /**
     * Set the Browser to be mobile
     * @param boolean $value is the browser a mobile browser or not
     */
    protected function setMobile($value = true)
    {
        $this->_is_mobile = $value;
    }

    /**
     * Set the Browser to be tablet
     * @param boolean $value is the browser a tablet browser or not
     */
    protected function setTablet($value = true)
    {
        $this->_is_tablet = $value;
    }

    /**
     * Set the Browser to be a robot
     * @param boolean $value is the browser a robot or not
     */
    protected function setRobot($value = true)
    {
        $this->_is_robot = $value;
    }

    /**
     * Set the Browser to be a Facebook request
     * @param boolean $value is the browser a robot or not
     */
    protected function setFacebook($value = true) 
    { 
        $this->_is_facebook = $value; 
    }

    /**
     * Get the user agent value in use to determine the browser
     * @return string The user agent from the HTTP header
     */
    public function getUserAgent()
    {
        return $this->_agent;
    }

    /**
     * Set the user agent value (the construction will use the HTTP header value - this will overwrite it)
     * @param string $agent_string The value for the User Agent
     */
    public function setUserAgent($agent_string)
    {
        $this->reset();
        $this->_agent = $agent_string;
        $this->determine();
    }

    /**
     * Used to determine if the browser is actually "chromeframe"
     * @since 1.7
     * @return boolean True if the browser is using chromeframe
     */
    public function isChromeFrame()
    {
        return (strpos($this->_agent, "chromeframe") !== false);
    }

    /**
     * Returns a formatted string with a summary of the details of the browser.
     * @return string formatted string with a summary of the browser
     */
    public function __toString()
    {
        return "<strong>Browser Name:</strong> {$this->getBrowser()}<br/>\n" .
        "<strong>Browser Version:</strong> {$this->getVersion()}<br/>\n" .
        "<strong>Browser User Agent String:</strong> {$this->getUserAgent()}<br/>\n" .
        "<strong>Platform:</strong> {$this->getPlatform()}<br/>";
    }

    /**
     * Protected routine to calculate and determine what the browser is in use (including platform)
     */
    protected function determine()
    {
        $this->checkPlatform();
        $this->checkBrowsers();
        $this->checkForAol();
    }

    /**
     * Protected routine to determine the browser type
     * @return boolean True if the browser was detected otherwise false
     */
    protected function checkBrowsers()
    {
        return (
            // well-known, well-used
            // Special Notes:
            // (1) Opera must be checked before FireFox due to the odd
            //     user agents used in some older versions of Opera
            // (2) WebTV is strapped onto Internet Explorer so we must
            //     check for WebTV before IE
            // (3) (deprecated) Galeon is based on Firefox and needs to be
            //     tested before Firefox is tested
            // (4) OmniWeb is based on Safari so OmniWeb check must occur
            //     before Safari
            // (5) Netscape 9+ is based on Firefox so Netscape checks
            //     before FireFox are necessary
            $this->checkBrowserWebTv() ||
            $this->checkBrowserInternetExplorer() ||
            $this->checkBrowserOpera() ||
            $this->checkBrowserGaleon() ||
            $this->checkBrowserNetscapeNavigator9Plus() ||
            $this->checkBrowserFirefox() ||
            $this->checkBrowserChrome() ||
            $this->checkBrowserOmniWeb() ||

            // common mobile
            $this->checkBrowserAndroid() ||
            $this->checkBrowseriPad() ||
            $this->checkBrowseriPod() ||
            $this->checkBrowseriPhone() ||
            $this->checkBrowserBlackBerry() ||
            $this->checkBrowserNokia() ||

            // common bots
            $this->checkBrowserGoogleBot() ||
            $this->checkBrowserMSNBot() ||
            $this->checkBrowserBingBot() ||
            $this->checkBrowserSlurp() ||

            // check for facebook external hit when loading URL
            $this->checkFacebookExternalHit() ||

            // WebKit base check (post mobile and others)
            $this->checkBrowserSafari() ||

            // everyone else
            $this->checkBrowserNetPositive() ||
            $this->checkBrowserFirebird() ||
            $this->checkBrowserKonqueror() ||
            $this->checkBrowserIcab() ||
            $this->checkBrowserPhoenix() ||
            $this->checkBrowserAmaya() ||
            $this->checkBrowserLynx() ||
            $this->checkBrowserShiretoko() ||
            $this->checkBrowserIceCat() ||
            $this->checkBrowserIceweasel() || 
            $this->checkBrowserW3CValidator() ||
            $this->checkBrowserMozilla() /* Mozilla is such an open standard that you must check it last */
        );
    }

    /**
     * Determine if the user is using a BlackBerry (last updated 1.7)
     * @return boolean True if the browser is the BlackBerry browser otherwise false
     */
    protected function checkBrowserBlackBerry()
    {
        if (stripos($this->_agent, 'blackberry') !== false) {
            $aresult = explode("/", stristr($this->_agent, "BlackBerry"));
            $aversion = explode(' ', $aresult[1]);
            $this->setVersion($aversion[0]);
            $this->_browser_name = self::BROWSER_BLACKBERRY;
            $this->setMobile(true);
            return true;
        }
        return false;
    }

    /**
     * Determine if the user is using an AOL User Agent (last updated 1.7)
     * @return boolean True if the browser is from AOL otherwise false
     */
    protected function checkForAol()
    {
        $this->setAol(false);
        $this->setAolVersion(self::VERSION_UNKNOWN);

        if (stripos($this->_agent, 'aol') !== false) {
            $aversion = explode(' ', stristr($this->_agent, 'AOL'));
            $this->setAol(true);
            $this->setAolVersion(preg_replace('/[^0-9\.a-z]/i', '', $aversion[1]));
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is the GoogleBot or not (last updated 1.7)
     * @return boolean True if the browser is the GoogletBot otherwise false
     */
    protected function checkBrowserGoogleBot()
    {
        if (stripos($this->_agent, 'googlebot') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'googlebot'));
            $aversion = explode(' ', $aresult[1]);
            $this->setVersion(str_replace(';', '', $aversion[0]));
            $this->_browser_name = self::BROWSER_GOOGLEBOT;
            $this->setRobot(true);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is the MSNBot or not (last updated 1.9)
     * @return boolean True if the browser is the MSNBot otherwise false
     */
    protected function checkBrowserMSNBot()
    {
        if (stripos($this->_agent, "msnbot") !== false) {
            $aresult = explode("/", stristr($this->_agent, "msnbot"));
            $aversion = explode(" ", $aresult[1]);
            $this->setVersion(str_replace(";", "", $aversion[0]));
            $this->_browser_name = self::BROWSER_MSNBOT;
            $this->setRobot(true);
            return true;
        }
        return false;
    }
    
    /**
     * Determine if the browser is the BingBot or not (last updated 1.9)
     * @return boolean True if the browser is the BingBot otherwise false
     */
    protected function checkBrowserBingBot()
    {
        if (stripos($this->_agent, "bingbot") !== false) {
            $aresult = explode("/", stristr($this->_agent, "bingbot"));
            $aversion = explode(" ", $aresult[1]);
            $this->setVersion(str_replace(";", "", $aversion[0]));
            $this->_browser_name = self::BROWSER_BINGBOT;
            $this->setRobot(true);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is the W3C Validator or not (last updated 1.7)
     * @return boolean True if the browser is the W3C Validator otherwise false
     */
    protected function checkBrowserW3CValidator()
    {
        if (stripos($this->_agent, 'W3C-checklink') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'W3C-checklink'));
            $aversion = explode(' ', $aresult[1]);
            $this->setVersion($aversion[0]);
            $this->_browser_name = self::BROWSER_W3CVALIDATOR;
            return true;
        } else if (stripos($this->_agent, 'W3C_Validator') !== false) {
            // Some of the Validator versions do not delineate w/ a slash - add it back in
            $ua = str_replace("W3C_Validator ", "W3C_Validator/", $this->_agent);
            $aresult = explode('/', stristr($ua, 'W3C_Validator'));
            $aversion = explode(' ', $aresult[1]);
            $this->setVersion($aversion[0]);
            $this->_browser_name = self::BROWSER_W3CVALIDATOR;
            return true;
        } else if (stripos($this->_agent, 'W3C-mobileOK') !== false) {
            $this->_browser_name = self::BROWSER_W3CVALIDATOR;
            $this->setMobile(true);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is the Yahoo! Slurp Robot or not (last updated 1.7)
     * @return boolean True if the browser is the Yahoo! Slurp Robot otherwise false
     */
    protected function checkBrowserSlurp()
    {
        if (stripos($this->_agent, 'slurp') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'Slurp'));
            $aversion = explode(' ', $aresult[1]);
            $this->setVersion($aversion[0]);
            $this->_browser_name = self::BROWSER_SLURP;
            $this->setRobot(true);
            $this->setMobile(false);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Internet Explorer or not (last updated 1.9)
     * @return boolean True if the browser is Internet Explorer otherwise false
     */
    protected function checkBrowserInternetExplorer()
    {
	//  Test for IE11
	if( stripos($this->_agent,'Trident/7.0; rv:11.0') !== false ) {
		$this->setBrowser(self::BROWSER_IE);
		$this->setVersion('11.0');
		return true;
	}
        // Test for v1 - v1.5 IE
        else if (stripos($this->_agent, 'microsoft internet explorer') !== false) {
            $this->setBrowser(self::BROWSER_IE);
            $this->setVersion('1.0');
            $aresult = stristr($this->_agent, '/');
            if (preg_match('/308|425|426|474|0b1/i', $aresult)) {
                $this->setVersion('1.5');
            }
            return true;
        } // Test for versions > 1.5
        else if (stripos($this->_agent, 'msie') !== false && stripos($this->_agent, 'opera') === false) {
            // See if the browser is the odd MSN Explorer
            if (stripos($this->_agent, 'msnb') !== false) {
                $aresult = explode(' ', stristr(str_replace(';', '; ', $this->_agent), 'MSN'));
                $this->setBrowser(self::BROWSER_MSN);
                $this->setVersion(str_replace(array('(', ')', ';'), '', $aresult[1]));
                return true;
            }
            $aresult = explode(' ', stristr(str_replace(';', '; ', $this->_agent), 'msie'));
            $this->setBrowser(self::BROWSER_IE);
            $this->setVersion(str_replace(array('(', ')', ';'), '', $aresult[1]));
            if(stripos($this->_agent, 'IEMobile') !== false) {
                $this->setBrowser(self::BROWSER_POCKET_IE);
                $this->setMobile(true);
            }
            return true;
        } // Test for versions > IE 10
		else if(stripos($this->_agent, 'trident') !== false) {
			$this->setBrowser(self::BROWSER_IE);
			$result = explode('rv:', $this->_agent);
			$this->setVersion(preg_replace('/[^0-9.]+/', '', $result[1]));
			$this->_agent = str_replace(array("Mozilla", "Gecko"), "MSIE", $this->_agent);
		} // Test for Pocket IE
        else if (stripos($this->_agent, 'mspie') !== false || stripos($this->_agent, 'pocket') !== false) {
            $aresult = explode(' ', stristr($this->_agent, 'mspie'));
            $this->setPlatform(self::PLATFORM_WINDOWS_CE);
            $this->setBrowser(self::BROWSER_POCKET_IE);
            $this->setMobile(true);

            if (stripos($this->_agent, 'mspie') !== false) {
                $this->setVersion($aresult[1]);
            } else {
                $aversion = explode('/', $this->_agent);
                $this->setVersion($aversion[1]);
            }
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Opera or not (last updated 1.7)
     * @return boolean True if the browser is Opera otherwise false
     */
    protected function checkBrowserOpera()
    {
        if (stripos($this->_agent, 'opera mini') !== false) {
            $resultant = stristr($this->_agent, 'opera mini');
            if (preg_match('/\//', $resultant)) {
                $aresult = explode('/', $resultant);
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
            } else {
                $aversion = explode(' ', stristr($resultant, 'opera mini'));
                $this->setVersion($aversion[1]);
            }
            $this->_browser_name = self::BROWSER_OPERA_MINI;
            $this->setMobile(true);
            return true;
        } else if (stripos($this->_agent, 'opera') !== false) {
            $resultant = stristr($this->_agent, 'opera');
            if (preg_match('/Version\/(1*.*)$/', $resultant, $matches)) {
                $this->setVersion($matches[1]);
            } else if (preg_match('/\//', $resultant)) {
                $aresult = explode('/', str_replace("(", " ", $resultant));
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
            } else {
                $aversion = explode(' ', stristr($resultant, 'opera'));
                $this->setVersion(isset($aversion[1]) ? $aversion[1] : "");
            }
            if (stripos($this->_agent, 'Opera Mobi') !== false) {
                $this->setMobile(true);
            }
            $this->_browser_name = self::BROWSER_OPERA;
            return true;
        } else if (stripos($this->_agent, 'OPR') !== false) {
            $resultant = stristr($this->_agent, 'OPR');
            if (preg_match('/\//', $resultant)) {
                $aresult = explode('/', str_replace("(", " ", $resultant));
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
            }
            if (stripos($this->_agent, 'Mobile') !== false) {
                $this->setMobile(true);
            }
            $this->_browser_name = self::BROWSER_OPERA;
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Chrome or not (last updated 1.7)
     * @return boolean True if the browser is Chrome otherwise false
     */
    protected function checkBrowserChrome()
    {
        if (stripos($this->_agent, 'Chrome') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'Chrome'));
            $aversion = explode(' ', $aresult[1]);
            $this->setVersion($aversion[0]);
            $this->setBrowser(self::BROWSER_CHROME);
            //Chrome on Android
            if (stripos($this->_agent, 'Android') !== false) {
                if (stripos($this->_agent, 'Mobile') !== false) {
                    $this->setMobile(true);
                } else {
                    $this->setTablet(true);
                }
            }
            return true;
        }
        return false;
    }


    /**
     * Determine if the browser is WebTv or not (last updated 1.7)
     * @return boolean True if the browser is WebTv otherwise false
     */
    protected function checkBrowserWebTv()
    {
        if (stripos($this->_agent, 'webtv') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'webtv'));
            $aversion = explode(' ', $aresult[1]);
            $this->setVersion($aversion[0]);
            $this->setBrowser(self::BROWSER_WEBTV);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is NetPositive or not (last updated 1.7)
     * @return boolean True if the browser is NetPositive otherwise false
     */
    protected function checkBrowserNetPositive()
    {
        if (stripos($this->_agent, 'NetPositive') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'NetPositive'));
            $aversion = explode(' ', $aresult[1]);
            $this->setVersion(str_replace(array('(', ')', ';'), '', $aversion[0]));
            $this->setBrowser(self::BROWSER_NETPOSITIVE);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Galeon or not (last updated 1.7)
     * @return boolean True if the browser is Galeon otherwise false
     */
    protected function checkBrowserGaleon()
    {
        if (stripos($this->_agent, 'galeon') !== false) {
            $aresult = explode(' ', stristr($this->_agent, 'galeon'));
            $aversion = explode('/', $aresult[0]);
            $this->setVersion($aversion[1]);
            $this->setBrowser(self::BROWSER_GALEON);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Konqueror or not (last updated 1.7)
     * @return boolean True if the browser is Konqueror otherwise false
     */
    protected function checkBrowserKonqueror()
    {
        if (stripos($this->_agent, 'Konqueror') !== false) {
            $aresult = explode(' ', stristr($this->_agent, 'Konqueror'));
            $aversion = explode('/', $aresult[0]);
            $this->setVersion($aversion[1]);
            $this->setBrowser(self::BROWSER_KONQUEROR);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is iCab or not (last updated 1.7)
     * @return boolean True if the browser is iCab otherwise false
     */
    protected function checkBrowserIcab()
    {
        if (stripos($this->_agent, 'icab') !== false) {
            $aversion = explode(' ', stristr(str_replace('/', ' ', $this->_agent), 'icab'));
            $this->setVersion($aversion[1]);
            $this->setBrowser(self::BROWSER_ICAB);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is OmniWeb or not (last updated 1.7)
     * @return boolean True if the browser is OmniWeb otherwise false
     */
    protected function checkBrowserOmniWeb()
    {
        if (stripos($this->_agent, 'omniweb') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'omniweb'));
            $aversion = explode(' ', isset($aresult[1]) ? $aresult[1] : "");
            $this->setVersion($aversion[0]);
            $this->setBrowser(self::BROWSER_OMNIWEB);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Phoenix or not (last updated 1.7)
     * @return boolean True if the browser is Phoenix otherwise false
     */
    protected function checkBrowserPhoenix()
    {
        if (stripos($this->_agent, 'Phoenix') !== false) {
            $aversion = explode('/', stristr($this->_agent, 'Phoenix'));
            $this->setVersion($aversion[1]);
            $this->setBrowser(self::BROWSER_PHOENIX);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Firebird or not (last updated 1.7)
     * @return boolean True if the browser is Firebird otherwise false
     */
    protected function checkBrowserFirebird()
    {
        if (stripos($this->_agent, 'Firebird') !== false) {
            $aversion = explode('/', stristr($this->_agent, 'Firebird'));
            $this->setVersion($aversion[1]);
            $this->setBrowser(self::BROWSER_FIREBIRD);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Netscape Navigator 9+ or not (last updated 1.7)
     * NOTE: (http://browser.netscape.com/ - Official support ended on March 1st, 2008)
     * @return boolean True if the browser is Netscape Navigator 9+ otherwise false
     */
    protected function checkBrowserNetscapeNavigator9Plus()
    {
        if (stripos($this->_agent, 'Firefox') !== false && preg_match('/Navigator\/([^ ]*)/i', $this->_agent, $matches)) {
            $this->setVersion($matches[1]);
            $this->setBrowser(self::BROWSER_NETSCAPE_NAVIGATOR);
            return true;
        } else if (stripos($this->_agent, 'Firefox') === false && preg_match('/Netscape6?\/([^ ]*)/i', $this->_agent, $matches)) {
            $this->setVersion($matches[1]);
            $this->setBrowser(self::BROWSER_NETSCAPE_NAVIGATOR);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Shiretoko or not (https://wiki.mozilla.org/Projects/shiretoko) (last updated 1.7)
     * @return boolean True if the browser is Shiretoko otherwise false
     */
    protected function checkBrowserShiretoko()
    {
        if (stripos($this->_agent, 'Mozilla') !== false && preg_match('/Shiretoko\/([^ ]*)/i', $this->_agent, $matches)) {
            $this->setVersion($matches[1]);
            $this->setBrowser(self::BROWSER_SHIRETOKO);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Ice Cat or not (http://en.wikipedia.org/wiki/GNU_IceCat) (last updated 1.7)
     * @return boolean True if the browser is Ice Cat otherwise false
     */
    protected function checkBrowserIceCat()
    {
        if (stripos($this->_agent, 'Mozilla') !== false && preg_match('/IceCat\/([^ ]*)/i', $this->_agent, $matches)) {
            $this->setVersion($matches[1]);
            $this->setBrowser(self::BROWSER_ICECAT);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Nokia or not (last updated 1.7)
     * @return boolean True if the browser is Nokia otherwise false
     */
    protected function checkBrowserNokia()
    {
        if (preg_match("/Nokia([^\/]+)\/([^ SP]+)/i", $this->_agent, $matches)) {
            $this->setVersion($matches[2]);
            if (stripos($this->_agent, 'Series60') !== false || strpos($this->_agent, 'S60') !== false) {
                $this->setBrowser(self::BROWSER_NOKIA_S60);
            } else {
                $this->setBrowser(self::BROWSER_NOKIA);
            }
            $this->setMobile(true);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Firefox or not (last updated 1.7)
     * @return boolean True if the browser is Firefox otherwise false
     */
    protected function checkBrowserFirefox()
    {
        if (stripos($this->_agent, 'safari') === false) {
            if (preg_match("/Firefox[\/ \(]([^ ;\)]+)/i", $this->_agent, $matches)) {
                $this->setVersion($matches[1]);
                $this->setBrowser(self::BROWSER_FIREFOX);
                //Firefox on Android
                if (stripos($this->_agent, 'Android') !== false) {
                    if (stripos($this->_agent, 'Mobile') !== false) {
                        $this->setMobile(true);
                    } else {
                        $this->setTablet(true);
                    }
                }
                return true;
            } else if (preg_match("/Firefox$/i", $this->_agent, $matches)) {
                $this->setVersion("");
                $this->setBrowser(self::BROWSER_FIREFOX);
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the browser is Firefox or not (last updated 1.7)
     * @return boolean True if the browser is Firefox otherwise false
     */
    protected function checkBrowserIceweasel()
    {
        if (stripos($this->_agent, 'Iceweasel') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'Iceweasel'));
            $aversion = explode(' ', $aresult[1]);
            $this->setVersion($aversion[0]);
            $this->setBrowser(self::BROWSER_ICEWEASEL);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Mozilla or not (last updated 1.7)
     * @return boolean True if the browser is Mozilla otherwise false
     */
    protected function checkBrowserMozilla()
    {
        if (stripos($this->_agent, 'mozilla') !== false && preg_match('/rv:[0-9].[0-9][a-b]?/i', $this->_agent) && stripos($this->_agent, 'netscape') === false) {
            $aversion = explode(' ', stristr($this->_agent, 'rv:'));
            preg_match('/rv:[0-9].[0-9][a-b]?/i', $this->_agent, $aversion);
            $this->setVersion(str_replace('rv:', '', $aversion[0]));
            $this->setBrowser(self::BROWSER_MOZILLA);
            return true;
        } else if (stripos($this->_agent, 'mozilla') !== false && preg_match('/rv:[0-9]\.[0-9]/i', $this->_agent) && stripos($this->_agent, 'netscape') === false) {
            $aversion = explode('', stristr($this->_agent, 'rv:'));
            $this->setVersion(str_replace('rv:', '', $aversion[0]));
            $this->setBrowser(self::BROWSER_MOZILLA);
            return true;
        } else if (stripos($this->_agent, 'mozilla') !== false && preg_match('/mozilla\/([^ ]*)/i', $this->_agent, $matches) && stripos($this->_agent, 'netscape') === false) {
            $this->setVersion($matches[1]);
            $this->setBrowser(self::BROWSER_MOZILLA);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Lynx or not (last updated 1.7)
     * @return boolean True if the browser is Lynx otherwise false
     */
    protected function checkBrowserLynx()
    {
        if (stripos($this->_agent, 'lynx') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'Lynx'));
            $aversion = explode(' ', (isset($aresult[1]) ? $aresult[1] : ""));
            $this->setVersion($aversion[0]);
            $this->setBrowser(self::BROWSER_LYNX);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Amaya or not (last updated 1.7)
     * @return boolean True if the browser is Amaya otherwise false
     */
    protected function checkBrowserAmaya()
    {
        if (stripos($this->_agent, 'amaya') !== false) {
            $aresult = explode('/', stristr($this->_agent, 'Amaya'));
            $aversion = explode(' ', $aresult[1]);
            $this->setVersion($aversion[0]);
            $this->setBrowser(self::BROWSER_AMAYA);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Safari or not (last updated 1.7)
     * @return boolean True if the browser is Safari otherwise false
     */
    protected function checkBrowserSafari()
    {
        if (stripos($this->_agent, 'Safari') !== false
            && stripos($this->_agent, 'iPhone') === false
            && stripos($this->_agent, 'iPod') === false) {

            $aresult = explode('/', stristr($this->_agent, 'Version'));
            if (isset($aresult[1])) {
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
            } else {
                $this->setVersion(self::VERSION_UNKNOWN);
            }
            $this->setBrowser(self::BROWSER_SAFARI);
            return true;
        }
        return false;
    }

    /**
     * Detect if URL is loaded from FacebookExternalHit
     * @return boolean True if it detects FacebookExternalHit otherwise false
     */
    protected function checkFacebookExternalHit()
    {
        if(stristr($this->_agent,'FacebookExternalHit'))
        {
            $this->setRobot(true);
            $this->setFacebook(true);
            return true;
        }
        return false;
    }

    /**
     * Detect if URL is being loaded from internal Facebook browser
     * @return boolean True if it detects internal Facebook browser otherwise false
     */
    protected function checkForFacebookIos()
    {
        if(stristr($this->_agent,'FBIOS'))
        {
            $this->setFacebook(true);
            return true;
        }
        return false;
    }

    /**
     * Detect Version for the Safari browser on iOS devices
     * @return boolean True if it detects the version correctly otherwise false
     */
    protected function getSafariVersionOnIos() 
    {
        $aresult = explode('/',stristr($this->_agent,'Version'));
        if( isset($aresult[1]) ) 
        {
            $aversion = explode(' ',$aresult[1]);
            $this->setVersion($aversion[0]);
            return true;
        }
        return false;
    }

    /**
     * Detect Version for the Chrome browser on iOS devices
     * @return boolean True if it detects the version correctly otherwise false
     */
    protected function getChromeVersionOnIos() 
    {
        $aresult = explode('/',stristr($this->_agent,'CriOS'));
        if( isset($aresult[1]) ) 
        {
            $aversion = explode(' ',$aresult[1]);
            $this->setVersion($aversion[0]);
            $this->setBrowser(self::BROWSER_CHROME);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is iPhone or not (last updated 1.7)
     * @return boolean True if the browser is iPhone otherwise false
     */
    protected function checkBrowseriPhone() {
        if( stripos($this->_agent,'iPhone') !== false ) {
            $this->setVersion(self::VERSION_UNKNOWN);
            $this->setBrowser(self::BROWSER_IPHONE);
            $this->getSafariVersionOnIos();
            $this->getChromeVersionOnIos();
            $this->checkForFacebookIos();
            $this->setMobile(true);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is iPad or not (last updated 1.7)
     * @return boolean True if the browser is iPad otherwise false
     */
    protected function checkBrowseriPad() {
        if( stripos($this->_agent,'iPad') !== false ) {
            $this->setVersion(self::VERSION_UNKNOWN);
            $this->setBrowser(self::BROWSER_IPAD);
            $this->getSafariVersionOnIos();
            $this->getChromeVersionOnIos();
            $this->checkForFacebookIos();
            $this->setTablet(true);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is iPod or not (last updated 1.7)
     * @return boolean True if the browser is iPod otherwise false
     */
    protected function checkBrowseriPod() {
        if( stripos($this->_agent,'iPod') !== false ) {
            $this->setVersion(self::VERSION_UNKNOWN);
            $this->setBrowser(self::BROWSER_IPOD);
            $this->getSafariVersionOnIos();
            $this->getChromeVersionOnIos();
            $this->checkForFacebookIos();
            $this->setMobile(true);
            return true;
        }
        return false;
    }

    /**
     * Determine if the browser is Android or not (last updated 1.7)
     * @return boolean True if the browser is Android otherwise false
     */
    protected function checkBrowserAndroid()
    {
        if (stripos($this->_agent, 'Android') !== false) {
            $aresult = explode(' ', stristr($this->_agent, 'Android'));
            if (isset($aresult[1])) {
                $aversion = explode(' ', $aresult[1]);
                $this->setVersion($aversion[0]);
            } else {
                $this->setVersion(self::VERSION_UNKNOWN);
            }
            if (stripos($this->_agent, 'Mobile') !== false) {
                $this->setMobile(true);
            } else {
                $this->setTablet(true);
            }
            $this->setBrowser(self::BROWSER_ANDROID);
            return true;
        }
        return false;
    }

    /**
     * Determine the user's platform (last updated 2.0)
     */
    protected function checkPlatform(){

		$os_array	=	array(
							//android
							'/android (4\.4|kitkat)/i'				=>	self::PLATFORM_ANDROID_4_4,
							'/android 4\.3/i'						=>	self::PLATFORM_ANDROID_4_3,
							'/android 4\.2/i'						=>	self::PLATFORM_ANDROID_4_2,
							'/android (4\.1|jelly bean)/i'			=>	self::PLATFORM_ANDROID_4_1,
							'/android (4\.0|ice cream sandwich)/i'	=>	self::PLATFORM_ANDROID_4,
							'/android (3|honeycomb)/i'				=>	self::PLATFORM_ANDROID_3,
							'/android (2\.3|gingerbread)/i'			=>	self::PLATFORM_ANDROID_2_3,
							'/android (2\.2|froyo)/i'				=>	self::PLATFORM_ANDROID_2_2,
							'/android (2\.(0|1)|eclair)/i'			=>	self::PLATFORM_ANDROID_2,
							'/android (1\.6|donut)/i'				=>	self::PLATFORM_ANDROID_1_6,
							'/android (1\.5|cupcake)/i'				=>	self::PLATFORM_ANDROID_1_5,
							'/android 1\.0/i'						=>	self::PLATFORM_ANDROID_1,
							'/android/i'							=>	self::PLATFORM_ANDROID,

							//consoles
							'/playstation (3|portable)/i'			=>	self::PLATFORM_XMB,
							'/playstation vita/i'					=>	self::PLATFORM_LIVE_AREA,
							'/playstation 4/i'						=>	self::PLATFORM_ORBIS,
							'/nintendo 3ds/i'						=>	self::PLATFORM_NINTENDO_3DS,
							'/nintendo ds/i'						=>	self::PLATFORM_NINTENDO_DS,
							'/nintendo wiiu/i'						=>	self::PLATFORM_NINTENDO_WIIU,
							'/nintendo wii/i'						=>	self::PLATFORM_NINTENDO_WII,
							'/xbox|windows NT 6\.1; trident/i'		=>	self::PLATFORM_XBOX,

							//windows
							'/windows nt 6\.3/i'					=>	self::PLATFORM_WINDOWS_8_1,
							'/windows nt 6\.2; arm; trident/i'		=>  self::PLATFORM_WINDOWS_RT,
							'/windows nt 6\.2/i'					=>  self::PLATFORM_WINDOWS_8,
							'/windows nt 6\.1/i'     				=>  self::PLATFORM_WINDOWS_7,
							'/windows nt 6\.0/i'     				=>  self::PLATFORM_WINDOWS_VISTA,
							'/windows nt 5\.2/i'     				=>  self::PLATFORM_WINDOWS_SERVER,
							'/windows (nt 5\.1|xp)/i'     			=>  self::PLATFORM_WINDOWS_XP,
							'/windows (nt 5\.0|2000)/i'     		=>  self::PLATFORM_WINDOWS_2000,
							'/windows nt 4/i'						=>  self::PLATFORM_WINDOWS_NT,
							'/windows ce/i'							=>  self::PLATFORM_WINDOWS_CE,
							'/win98|windows[ _]98/i'				=>  self::PLATFORM_WINDOWS_98,
							'/win95|windows[ _]95/i'				=>  self::PLATFORM_WINDOWS_95,
							'/windows me|win 9x/i'					=>  self::PLATFORM_WINDOWS_ME,
							'/win16|windows[ _]3/i'					=>  self::PLATFORM_WINDOWS_3,
							'/windows phone os 7/i'					=>  self::PLATFORM_WINDOWS_PHONE_7,
							'/windows phone 8.1/i'					=>  self::PLATFORM_WINDOWS_PHONE_8_1,
							'/windows phone 8/i'					=>  self::PLATFORM_WINDOWS_PHONE_8,
							'/windows (mobile|phone)/i'				=>  self::PLATFORM_WINDOWS_MOBILE,
							'/win/i'								=>	self::PLATFORM_WINDOWS,

							//IOS
							'/os 8/i'            	 				=>  self::PLATFORM_IOS_8,
							'/os 7/i'               				=>  self::PLATFORM_IOS_7,
							'/os 6/i'            	 				=>  self::PLATFORM_IOS_6,
							'/os 5/i'               				=>  self::PLATFORM_IOS_5,
							'/os 4/i'               				=>  self::PLATFORM_IOS_4,
							'/iphone/i'             				=>  self::PLATFORM_IOS,
							'/ipod/i'               				=>  self::PLATFORM_IOS,
							'/ipad/i'               				=>  self::PLATFORM_IOS,

							//mac
							'/mac os x 10[\._]10/i'					=>	self::PLATFORM_MAC_X_10_10,
							'/mac os x 10[\._]9/i'					=>	self::PLATFORM_MAC_X_10_9,
							'/mac os x 10[\._]8/i'					=>	self::PLATFORM_MAC_X_10_8,
							'/mac os x 10[\._]7/i'					=>	self::PLATFORM_MAC_X_10_7,
							'/mac os x 10[\._]6/i'					=>	self::PLATFORM_MAC_X_10_6,
							'/mac os x 10[\._]5/i'					=>	self::PLATFORM_MAC_X_10_5,
							'/mac os x 10[\._]4/i'					=>	self::PLATFORM_MAC_X_10_4,
							'/mac os x 10[\._]3/i'					=>	self::PLATFORM_MAC_X_10_3,
							'/macintosh|mac os x/i'					=>	self::PLATFORM_MAC_X,
							'/macos/i'								=>	self::PLATFORM_MAC,

							//Linux
							'/pclinuxosx/i'							=>  self::PLATFORM_LINUX_PCLINUX,
							'/vectorlinux/i'						=>  self::PLATFORM_LINUX_VECTOR,
							'/ubuntu/i'								=>  self::PLATFORM_LINUX_UBUNTU,
							'/suse/i'								=>  self::PLATFORM_LINUX_SUSE,
							'/slackware/i'							=>  self::PLATFORM_LINUX_SLACKWARE,
							'/red hat modified/i'					=>  self::PLATFORM_LINUX_REDHAT,
							'/mint/i'								=>  self::PLATFORM_LINUX_MINT,
							'/mandriva/i'							=>  self::PLATFORM_LINUX_MANDRIVA,
							'/mageia/i'								=>  self::PLATFORM_LINUX_MAGEIA,
							'/maemo/i'								=>  self::PLATFORM_LINUX_MAEMO,
							'/linspire/i'							=>  self::PLATFORM_LINUX_LINSPIRE,
							'/knoppix/i'							=>  self::PLATFORM_LINUX_KNOPPIX,
							'/kanotix/i'							=>  self::PLATFORM_LINUX_KANOTIX,
							'/gentoo/i'								=>  self::PLATFORM_LINUX_GENTOO,
							'/fedora/i'								=>  self::PLATFORM_LINUX_FEDORA,
							'/debian/i'								=>  self::PLATFORM_LINUX_DEBIAN,
							'/centos/i'								=>  self::PLATFORM_LINUX_CENTOS,
							'/arch linux/i'							=>  self::PLATFORM_LINUX_ARCH,
							'/linux/i'								=>  self::PLATFORM_LINUX,

							//other
							'/rim tablet os 1/i'					=>	self::PLATFORM_BLACKBERRY_TABLET_OS_1,
							'/rim tablet os 2/i'					=>	self::PLATFORM_BLACKBERRY_TABLET_OS_2,
							'/blackberry/i'							=>	self::PLATFORM_BLACKBERRY,
							'/freebsd/i'							=>	self::PLATFORM_FREEBSD,
							'/openbsd/i'							=>	self::PLATFORM_OPENBSD,
							'/netbsd/i'								=>	self::PLATFORM_NETBSD,
							'/opensolaris/i'						=>	self::PLATFORM_OPENSOLARIS,
							'/sunos/i'								=>	self::PLATFORM_SUNOS,
							'/warp/i'								=>	self::PLATFORM_OS2_WARP,
							'/os\/2/i'								=>	self::PLATFORM_OS2,
							'/heiku/i'								=>	self::PLATFORM_HAIKU,
							'/beos/i'								=>	self::PLATFORM_BEOS,
							'/firefox\//i'							=>	self::PLATFORM_FIREFOX,
							'/aix/i'								=>	self::PLATFORM_AIX,
							'/amiga/i'								=>	self::PLATFORM_AMIGA,
							'/aros/i'								=>	self::PLATFORM_AROS,
							'/bada/i'								=>	self::PLATFORM_BADA,
							'/brew/i'								=>	self::PLATFORM_BREW,
							'/cros/i'								=>	self::PLATFORM_CROME,
							'/danger hiptop/i'						=>	self::PLATFORM_DANGER_HIPTOP,
							'/dragonfly/i'							=>	self::PLATFORM_DRAGONFLY_BSD,
							'/gnu/i'								=>	self::PLATFORM_GNU,
							'/hp-ux/i'								=>	self::PLATFORM_HP,
							'/inferno/i'							=>	self::PLATFORM_INFERNO,
							'/irix/i'								=>	self::PLATFORM_IRIX,
							'/jolicloud/i'							=>	self::PLATFORM_JOLI,
							'/java/i'								=>	self::PLATFORM_JVM,
							'/meego/i'								=>	self::PLATFORM_MEEGO,
							'/minix 3/i'							=>	self::PLATFORM_MINIX_3,
							'/morphos/i'							=>	self::PLATFORM_MORPHOS,
							'/webtv/i'								=>	self::PLATFORM_MSN_TV,
							'/openvms/i'							=>	self::PLATFORM_OPENVMS,
							'/palm os/i'							=>	self::PLATFORM_PALM,
							'/qnx x86pc/i'							=>	self::PLATFORM_QNX,
							'/risc os|risk os/i'					=>	self::PLATFORM_RISK,
							'/sailfish/i'							=>	self::PLATFORM_SAILFISH,
							'/syllable/i'							=>	self::PLATFORM_SYLLABLE,
							'/symbos/i'								=>	self::PLATFORM_SYMBIAN,
							'/tizen 2/i'							=>	self::PLATFORM_TIZEN_2,
							'/tizen/i'								=>	self::PLATFORM_TIZEN_1,
							'/ubuntu; (mobile|tablet)/i'			=>	self::PLATFORM_UBUNTU_TOUCH,
							'/webos/i'								=>	self::PLATFORM_WEBOS,
							'/nokia/i'								=>	self::PLATFORM_NOKIA,
						);

		foreach($os_array as $regex => $value){ 
			if(preg_match($regex, $this->_agent)){
				$this->_platform = $value;
				return;
			}
		} 
	}
}

?>
