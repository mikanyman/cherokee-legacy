<?php
    /**
     *	Base include file for SimpleTest
     *	@package	SimpleTest
     *	@subpackage	WebTester
     *	@version	$Id: user_agent.php 5387 2006-05-15 11:20:13Z nbm $
     */

    /**#@+
     *	include other SimpleTest class files
     */
    require_once(dirname(__FILE__) . '/cookies.php');
    require_once(dirname(__FILE__) . '/http.php');
    require_once(dirname(__FILE__) . '/encoding.php');
    require_once(dirname(__FILE__) . '/authentication.php');
    /**#@-*/
   
    if (! defined('DEFAULT_MAX_REDIRECTS')) {
        define('DEFAULT_MAX_REDIRECTS', 3);
    }
    
    if (! defined('DEFAULT_CONNECTION_TIMEOUT')) {
        define('DEFAULT_CONNECTION_TIMEOUT', 15);
    }

    /**
     *    Fetches web pages whilst keeping track of
     *    cookies and authentication.
	 *    @package SimpleTest
	 *    @subpackage WebTester
     */
    class SimpleUserAgent {
        var $_cookie_jar;
        var $_cookies_enabled = true;
        var $_authenticator;
        var $_max_redirects = DEFAULT_MAX_REDIRECTS;
        var $_proxy = false;
        var $_proxy_username = false;
        var $_proxy_password = false;
        var $_connection_timeout = DEFAULT_CONNECTION_TIMEOUT;
        var $_additional_headers = array();
        
        /**
         *    Starts with no cookies, realms or proxies.
         *    @access public
         */
        function SimpleUserAgent() {
            $this->_cookie_jar = &new SimpleCookieJar();
            $this->_authenticator = &new SimpleAuthenticator();
        }
        
        /**
         *    Removes expired and temporary cookies as if
         *    the browser was closed and re-opened. Authorisation
         *    has to be obtained again as well.
         *    @param string/integer $date   Time when session restarted.
         *                                  If omitted then all persistent
         *                                  cookies are kept.
         *    @access public
         */
        function restart($date = false) {
            $this->_cookie_jar->restartSession($date);
            $this->_authenticator->restartSession();
        }
        
        /**
         *    Adds a header to every fetch.
         *    @param string $header       Header line to add to every
         *                                request until cleared.
         *    @access public
         */
        function addHeader($header) {
            $this->_additional_headers[] = $header;
        }
        
        /**
         *    Ages the cookies by the specified time.
         *    @param integer $interval    Amount in seconds.
         *    @access public
         */
        function ageCookies($interval) {
            $this->_cookie_jar->agePrematurely($interval);
        }
        
        /**
         *    Sets an additional cookie. If a cookie has
         *    the same name and path it is replaced.
         *    @param string $name            Cookie key.
         *    @param string $value           Value of cookie.
         *    @param string $host            Host upon which the cookie is valid.
         *    @param string $path            Cookie path if not host wide.
         *    @param string $expiry          Expiry date.
         *    @access public
         */
        function setCookie($name, $value, $host = false, $path = '/', $expiry = false) {
            $this->_cookie_jar->setCookie($name, $value, $host, $path, $expiry);
        }
        
        /**
         *    Reads the most specific cookie value from the
         *    browser cookies.
         *    @param string $host        Host to search.
         *    @param string $path        Applicable path.
         *    @param string $name        Name of cookie to read.
         *    @return string             False if not present, else the
         *                               value as a string.
         *    @access public
         */
        function getCookieValue($host, $path, $name) {
            return $this->_cookie_jar->getCookieValue($host, $path, $name);
        }
        
        /**
         *    Reads the current cookies within the base URL.
         *    @param string $name     Key of cookie to find.
         *    @param SimpleUrl $base  Base URL to search from.
         *    @return string/boolean  Null if there is no base URL, false
         *                            if the cookie is not set.
         *    @access public
         */
        function getBaseCookieValue($name, $base) {
            if (! $base) {
                return null;
            }
            return $this->getCookieValue($base->getHost(), $base->getPath(), $name);
        }
        
        /**
         *    Switches off cookie sending and recieving.
         *    @access public
         */
        function ignoreCookies() {
            $this->_cookies_enabled = false;
        }
        
        /**
         *    Switches back on the cookie sending and recieving.
         *    @access public
         */
        function useCookies() {
            $this->_cookies_enabled = true;
        }
        
        /**
         *    Sets the socket timeout for opening a connection.
         *    @param integer $timeout      Maximum time in seconds.
         *    @access public
         */
        function setConnectionTimeout($timeout) {
            $this->_connection_timeout = $timeout;
        }
        
        /**
         *    Sets the maximum number of redirects before
         *    a page will be loaded anyway.
         *    @param integer $max        Most hops allowed.
         *    @access public
         */
        function setMaximumRedirects($max) {
            $this->_max_redirects = $max;
        }
        
        /**
         *    Sets proxy to use on all requests for when
         *    testing from behind a firewall. Set URL
         *    to false to disable.
         *    @param string $proxy        Proxy URL.
         *    @param string $username     Proxy username for authentication.
         *    @param string $password     Proxy password for authentication.
         *    @access public
         */
        function useProxy($proxy, $username, $password) {
            if (! $proxy) {
                $this->_proxy = false;
                return;
            }
            if ((strncmp($proxy, 'http://', 7) != 0) && (strncmp($proxy, 'https://', 8) != 0)) {
                $proxy = 'http://'. $proxy;
            }
            $this->_proxy = &new SimpleUrl($proxy);
            $this->_proxy_username = $username;
            $this->_proxy_password = $password;
        }
        
        /**
         *    Test to see if the redirect limit is passed.
         *    @param integer $redirects        Count so far.
         *    @return boolean                  True if over.
         *    @access private
         */
        function _isTooManyRedirects($redirects) {
            return ($redirects > $this->_max_redirects);
        }
        
        /**
         *    Sets the identity for the current realm.
         *    @param string $host        Host to which realm applies.
         *    @param string $realm       Full name of realm.
         *    @param string $username    Username for realm.
         *    @param string $password    Password for realm.
         *    @access public
         */
        function setIdentity($host, $realm, $username, $password) {
            $this->_authenticator->setIdentityForRealm($host, $realm, $username, $password);
        }
        
        /**
         *    Fetches a URL as a response object. Will keep trying if redirected.
         *    It will also collect authentication realm information.
         *    @param string/SimpleUrl $url      Target to fetch.
         *    @param SimpleEncoding $encoding   Additional parameters for request.
         *    @return SimpleHttpResponse        Hopefully the target page.
         *    @access public
         */
        function &fetchResponse($url, $encoding) {
            if ($encoding->getMethod() != 'POST') {
                $url->addRequestParameters($encoding);
                $encoding->clear();
            }
            $response = &$this->_fetchWhileRedirected($url, $encoding);
            if ($headers = $response->getHeaders()) {
                if ($headers->isChallenge()) {
                    $this->_authenticator->addRealm(
                            $url,
                            $headers->getAuthentication(),
                            $headers->getRealm());
                }
            }
            return $response;
        }
        
        /**
         *    Fetches the page until no longer redirected or
         *    until the redirect limit runs out.
         *    @param SimpleUrl $url                  Target to fetch.
         *    @param SimpelFormEncoding $encoding    Additional parameters for request.
         *    @return SimpleHttpResponse             Hopefully the target page.
         *    @access private
         */
        function &_fetchWhileRedirected($url, $encoding) {
            $redirects = 0;
            do {
                $response = &$this->_fetch($url, $encoding);
                if ($response->isError()) {
                    return $response;
                }
                $headers = $response->getHeaders();
                $location = new SimpleUrl($headers->getLocation());
                $url = $location->makeAbsolute($url);
                if ($this->_cookies_enabled) {
                    $headers->writeCookiesToJar($this->_cookie_jar, $url);
                }
                if (! $headers->isRedirect()) {
                    break;
                }
                $encoding = new SimpleGetEncoding();
            } while (! $this->_isTooManyRedirects(++$redirects));
            return $response;
        }
        
        /**
         *    Actually make the web request.
         *    @param SimpleUrl $url                   Target to fetch.
         *    @param SimpleFormEncoding $encoding     Additional parameters for request.
         *    @return SimpleHttpResponse              Headers and hopefully content.
         *    @access protected
         */
        function &_fetch($url, $encoding) {
            $request = &$this->_createRequest($url, $encoding);
            $response = &$request->fetch($this->_connection_timeout);
            return $response;
        }
        
        /**
         *    Creates a full page request.
         *    @param SimpleUrl $url                 Target to fetch as url object.
         *    @param SimpleFormEncoding $encoding   POST/GET parameters.
         *    @return SimpleHttpRequest             New request.
         *    @access private
         */
        function &_createRequest($url, $encoding) {
            $request = &$this->_createHttpRequest($url, $encoding);
            $this->_addAdditionalHeaders($request);
            if ($this->_cookies_enabled) {
                $request->readCookiesFromJar($this->_cookie_jar, $url);
            }
            $this->_authenticator->addHeaders($request, $url);
            return $request;
        }
        
        /**
         *    Builds the appropriate HTTP request object.
         *    @param SimpleUrl $url                  Target to fetch as url object.
         *    @param SimpleFormEncoding $parameters  POST/GET parameters.
         *    @return SimpleHttpRequest              New request object.
         *    @access protected
         */
        function &_createHttpRequest($url, $encoding) {
            $request = &new SimpleHttpRequest($this->_createRoute($url), $encoding);
            return $request;
        }
        
        /**
         *    Sets up either a direct route or via a proxy.
         *    @param SimpleUrl $url   Target to fetch as url object.
         *    @return SimpleRoute     Route to take to fetch URL.
         *    @access protected
         */
        function &_createRoute($url) {
            if ($this->_proxy) {
                $route = &new SimpleProxyRoute(
                        $url,
                        $this->_proxy,
                        $this->_proxy_username,
                        $this->_proxy_password);
            } else {
                $route = &new SimpleRoute($url);
            }
            return $route;
        }
        
        /**
         *    Adds additional manual headers.
         *    @param SimpleHttpRequest $request    Outgoing request.
         *    @access private
         */
        function _addAdditionalHeaders(&$request) {
            foreach ($this->_additional_headers as $header) {
                $request->addHeaderLine($header);
            }
        }
    }
?>