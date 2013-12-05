Browser.php
=============

[![Build Status](https://travis-ci.org/cbschuld/Browser.php.png?branch=master)](https://travis-ci.org/cbschuld/Browser.php)

Helps detect the user's browser and platform at the PHP level via the user agent


Installation
============

To install, simply `require` the `Browser.php` file under `lib`. 

You can also install it via `Composer` by using the [Packagist archive](https://packagist.org/packages/cbschuld/browser.php).


Background
============

Detecting the user's browser type and version is helpful in web applications that harness some of the newer bleeding edge concepts. With the browser type and version you can notify users about challenges they may experience and suggest they upgrade before using such application. Not a great idea on a large scale public site; but on a private application this type of check can be helpful.

In an active project of mine we have a pretty graphically intensive and visually appealing user interface which leverages a lot of transparent PNG files. Because we all know how great IE6 supports PNG files it was necessary for us to tell our users the lack of power their browser has in a kind way.

Searching for a way to do this at the PHP layer and not at the client layer was more of a challenge than I would have guessed; the only script available was written by Gary White and Gary no longer maintains this script because of reliability. I do agree 100% with Gary about the readability; however, there are realistic reasons to desire the user.s browser and browser version and if your visitor is not echoing a false user agent we can take an educated guess.

I based this solution off of Gary White.s original solution but added a few things:

I added the ability to view the return values as class constants to increase the readability

* Updated the version detection for Amaya
* Updated the version detection for Firefox
* Updated the version detection for Lynx
* Updated the version detection for WebTV
* Updated the version detection for NetPositive
* Updated the version detection for IE
* Updated the version detection for OmniWeb
* Updated the version detection for iCab
* Updated the version detection for Safari
* Added detection for Chrome
* Added detection for iPhone
* Added detection for robots
* Added detection for mobile devices
* Added detection for BlackBerry
* Added detection for iPhone
* Added detection for iPad
* Added detection for Android
* Removed Netscape checks
* Updated Safari to remove mobile devices (iPhone)

**This solution identifies the following Operating Systems:**

* Windows (Browser::PLATFORM_WINDOWS)
* Windows CE (Browser::PLATFORM_WINDOWS_CE)
* Apple (Browser::PLATFORM_APPLE)
* Linux (Browser::PLATFORM_LINUX)
* Android (Browser::PLATFORM_ANDROID)
* OS/2 (Browser::PLATFORM_OS2)
* BeOS (Browser::PLATFORM_BEOS)
* iPhone (Browser::PLATFORM_IPHONE)
* iPod (Browser::PLATFORM_IPOD)
* BlackBerry (Browser::PLATFORM_BLACKBERRY)
* FreeBSD (Browser::PLATFORM_FREEBSD)
* OpenBSD (Browser::PLATFORM_OPENBSD)
* NetBSD (Browser::PLATFORM_NETBSD)
* SunOS (Browser::PLATFORM_SUNOS)
* OpenSolaris (Browser::PLATFORM_OPENSOLARIS)
* iPad (Browser::PLATFORM_IPAD)

**This solution identifies the following Browsers and does a best-guess on the version:**

* Opera (Browser::BROWSER_OPERA)
* WebTV (Browser::BROWSER_WEBTV)
* NetPositive (Browser::BROWSER_NETPOSITIVE)
* Internet Explorer (Browser::BROWSER_IE)
* Pocket Internet Explorer (Browser::BROWSER_POCKET_IE)
* Galeon (Browser::BROWSER_GALEON)
* Konqueror (Browser::BROWSER_KONQUEROR)
* iCab (Browser::BROWSER_ICAB)
* OmniWeb (Browser::BROWSER_OMNIWEB)
* Phoenix (Browser::BROWSER_PHOENIX)
* Firebird (Browser::BROWSER_FIREBIRD)
* Firefox (Browser::BROWSER_FIREFOX)
* Mozilla (Browser::BROWSER_MOZILLA)
* Amaya (Browser::BROWSER_AMAYA)
* Lynx (Browser::BROWSER_LYNX)
* Safari (Browser::BROWSER_SAFARI)
* iPhone (Browser::BROWSER_IPHONE)
* iPod (Browser::BROWSER_IPOD)
* Google.s Android(Browser::BROWSER_ANDROID)
* Google.s Chrome(Browser::BROWSER_CHROME)
* GoogleBot(Browser::BROWSER_GOOGLEBOT)
* Yahoo!.s Slurp(Browser::BROWSER_SLURP)
* W3C.s Validator(Browser::BROWSER_W3CVALIDATOR)
* BlackBerry(Browser::BROWSER_BLACKBERRY)

**Typical Usage:**

```php
$browser = new Browser();
if( $browser->getBrowser() == Browser::BROWSER_FIREFOX && $browser->getVersion() >= 2 ) {
	echo 'You have FireFox version 2 or greater';
}
```

12/9/2008 Update
* removed an unused constant and renamed the constructor to use the PHP magic method __construct (thanks to Robin for locating the legacy constant and suggesting the use of the magic method).

2/19/2009 Update
* updated typical usage to show a correct example! (thanks David!)

2/24/2009 Update
* fixed typo in the usage! (thanks Adam!)

3/14/2009 Update
* added support for the iPod; added iPod and iPhone as platforms; added Google.s Android

4/22/2009 Update
* added support for GoogleBot, the W3C Validator and Yahoo! Slurp

4/27/2009 Update
* John pointed out a terrible typo (see below) . removed the typo

11/08/2009 Update
* A lot of changes to the script, thank you to everyone for the suggestions and emails. This release should add all of the requested features. Added BlackBerry, mobile detection, Opera Mini support, robot detection, Opera 10.s UserAgent .mess., detection for IceCat and Shiretoko!

3/7/2010 Update
* Version 1.7 was a *MAJOR* Rebuild (preg_match and other .slow. routine removal(s)) included the following changes:
* Almost allof Gary.s original code has been replaced
* Large PHPUNIT testing environment created to validate new releases and additions
* Added FreeBSD Platform
* Added OpenBSD Platform
* Added NetBSD Platform
* Added SunOS Platform
* Added OpenSolaris Platform
* Added support of the Iceweazel Browser
* Added isChromeFrame() call to check if chromeframe is in use
* Moved the Opera check in front of the Firefox check due to legacy Opera User Agents
* Added the __toString() method (Thanks Deano)

4/27/2010: Update (Version 1.8)
* Added iPad support

8/20/2010: Update (Version 1.9)
* Added MSN Explorer Browser
* Added Bing/MSN Robot
* Added the Android Platform
* Fixed issue with Android 1.6/2.2