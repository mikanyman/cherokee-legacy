<?php
    /**
     *	Base include file for SimpleTest.
     *	@package	SimpleTest
     *	@subpackage	WebTester
     *	@version	$Id: web_tester.php 5387 2006-05-15 11:20:13Z nbm $
     */

    /**#@+
     *	include other SimpleTest class files
     */
    require_once(dirname(__FILE__) . '/test_case.php');
    require_once(dirname(__FILE__) . '/browser.php');
    require_once(dirname(__FILE__) . '/page.php');
    require_once(dirname(__FILE__) . '/expectation.php');
    /**#@-*/
    
    /**
     *    Test for an HTML widget value match.
	 *	  @package SimpleTest
	 *	  @subpackage WebTester
     */
    class FieldExpectation extends SimpleExpectation {
        var $_value;
        
        /**
         *    Sets the field value to compare against.
         *    @param mixed $value     Test value to match. Can be an
         *                            expectation for say pattern matching.
         *    @param string $message  Optiona message override. Can use %s as
         *                            a placeholder for the original message.
         *    @access public
         */
        function FieldExpectation($value, $message = '%s') {
            $this->SimpleExpectation($message);
            if (is_array($value)) {
                sort($value);
            }
            $this->_value = $value;
        }
        
        /**
         *    Tests the expectation. True if it matches
         *    a string value or an array value in any order.
         *    @param mixed $compare        Comparison value. False for
         *                                 an unset field.
         *    @return boolean              True if correct.
         *    @access public
         */
        function test($compare) {
            if ($this->_value === false) {
                return ($compare === false);
            }
            if ($this->_isSingle($this->_value)) {
                return $this->_testSingle($compare);
            }
            if (is_array($this->_value)) {
                return $this->_testMultiple($compare);
            }
            return false;
        }
        
        /**
         *    Tests for valid field comparisons with a single option.
         *    @param mixed $value       Value to type check.
         *    @return boolean           True if integer, string or float.
         *    @access private
         */
        function _isSingle($value) {
            return is_string($value) || is_integer($value) || is_float($value);
        }
        
        /**
         *    String comparison for simple field with a single option.
         *    @param mixed $compare    String to test against.
         *    @returns boolean         True if matching.
         *    @access private
         */
        function _testSingle($compare) {
            if (is_array($compare) && count($compare) == 1) {
                $compare = $compare[0];
            }
            if (! $this->_isSingle($compare)) {
                return false;
            }
            return ($this->_value == $compare);
        }
        
        /**
         *    List comparison for multivalue field.
         *    @param mixed $compare    List in any order to test against.
         *    @returns boolean         True if matching.
         *    @access private
         */
        function _testMultiple($compare) {
            if (is_string($compare)) {
                $compare = array($compare);
            }
            if (! is_array($compare)) {
                return false;
            }
            sort($compare);
            return ($this->_value === $compare);
        }
        
        /**
         *    Returns a human readable test message.
         *    @param mixed $compare      Comparison value.
         *    @return string             Description of success
         *                               or failure.
         *    @access public
         */
        function testMessage($compare) {
            $dumper = &$this->_getDumper();
            if (is_array($compare)) {
                sort($compare);
            }
            if ($this->test($compare)) {
                return "Field expectation [" . $dumper->describeValue($this->_value) . "]";
            } else {
                return "Field expectation [" . $dumper->describeValue($this->_value) .
                        "] fails with [" .
                        $this->_dumper->describeValue($compare) . "] " .
                        $this->_dumper->describeDifference($this->_value, $compare);
            }
        }
    }
    
    /**
     *    Test for a specific HTTP header within a header block.
	 *	  @package SimpleTest
	 *	  @subpackage WebTester
     */
    class HttpHeaderExpectation extends SimpleExpectation {
        var $_expected_header;
        var $_expected_value;
        
        /**
         *    Sets the field and value to compare against.
         *    @param string $header   Case insenstive trimmed header name.
         *    @param mixed $value     Optional value to compare. If not
         *                            given then any value will match. If
         *                            an expectation object then that will
         *                            be used instead.
         *    @param string $message  Optiona message override. Can use %s as
         *                            a placeholder for the original message.
         */
        function HttpHeaderExpectation($header, $value = false, $message = '%s') {
            $this->SimpleExpectation($message);
            $this->_expected_header = $this->_normaliseHeader($header);
            $this->_expected_value = $value;
        }
        
        /**
         *    Accessor for aggregated object.
         *    @return mixed        Expectation set in constructor.
         *    @access protected
         */
        function _getExpectation() {
            return $this->_expected_value;
        }
        
        /**
         *    Removes whitespace at ends and case variations.
         *    @param string $header    Name of header.
         *    @param string            Trimmed and lowecased header
         *                             name.
         *    @access private
         */
        function _normaliseHeader($header) {
            return strtolower(trim($header));
        }
        
        /**
         *    Tests the expectation. True if it matches
         *    a string value or an array value in any order.
         *    @param mixed $compare   Raw header block to search.
         *    @return boolean         True if header present.
         *    @access public
         */
        function test($compare) {
            return is_string($this->_findHeader($compare));
        }
        
        /**
         *    Searches the incoming result. Will extract the matching
         *    line as text.
         *    @param mixed $compare   Raw header block to search.
         *    @return string          Matching header line.
         *    @access protected
         */
        function _findHeader($compare) {
            $lines = split("\r\n", $compare);
            foreach ($lines as $line) {
                if ($this->_testHeaderLine($line)) {
                    return $line;
                }
            }
            return false;
        }
        
        /**
         *    Compares a single header line against the expectation.
         *    @param string $line      A single line to compare.
         *    @return boolean          True if matched.
         *    @access private
         */
        function _testHeaderLine($line) {
            if (count($parsed = split(':', $line, 2)) < 2) {
                return false;
            }
            list($header, $value) = $parsed;
            if ($this->_normaliseHeader($header) != $this->_expected_header) {
                return false;
            }
            return $this->_testHeaderValue($value, $this->_expected_value);
        }
        
        /**
         *    Tests the value part of the header.
         *    @param string $value        Value to test.
         *    @param mixed $expected      Value to test against.
         *    @return boolean             True if matched.
         *    @access protected
         */
        function _testHeaderValue($value, $expected) {
            if ($expected === false) {
                return true;
            }
            if (SimpleExpectation::isExpectation($expected)) {
                return $expected->test(trim($value));
            }
            return (trim($value) == trim($expected));
        }
        
        /**
         *    Returns a human readable test message.
         *    @param mixed $compare      Raw header block to search.
         *    @return string             Description of success
         *                               or failure.
         *    @access public
         */
        function testMessage($compare) {
            if (SimpleExpectation::isExpectation($this->_expected_value)) {
                $message = $this->_expected_value->testMessage($compare);
            } else {
                $message = $this->_expected_header .
                        ($this->_expected_value ? ': ' . $this->_expected_value : '');
            }
            if (is_string($line = $this->_findHeader($compare))) {
                return "Searching for header [$message] found [$line]";
            } else {
                return "Failed to find header [$message]";
            }
        }
    }
      
    /**
     *    Test for a specific HTTP header within a header block that
     *    should not be found.
	 *	  @package SimpleTest
	 *	  @subpackage WebTester
     */
    class NoHttpHeaderExpectation extends HttpHeaderExpectation {
        var $_expected_header;
        var $_expected_value;
        
        /**
         *    Sets the field and value to compare against.
         *    @param string $unwanted   Case insenstive trimmed header name.
         *    @param string $message    Optiona message override. Can use %s as
         *                              a placeholder for the original message.
         */
        function NoHttpHeaderExpectation($unwanted, $message = '%s') {
            $this->HttpHeaderExpectation($unwanted, false, $message);
        }
        
        /**
         *    Tests that the unwanted header is not found.
         *    @param mixed $compare   Raw header block to search.
         *    @return boolean         True if header present.
         *    @access public
         */
        function test($compare) {
            return ($this->_findHeader($compare) === false);
        }
        
        /**
         *    Returns a human readable test message.
         *    @param mixed $compare      Raw header block to search.
         *    @return string             Description of success
         *                               or failure.
         *    @access public
         */
        function testMessage($compare) {
            $expectation = $this->_getExpectation();
            if (is_string($line = $this->_findHeader($compare))) {
                return "Found unwanted header [$expectation] with [$line]";
            } else {
                return "Did not find unwanted header [$expectation]";
            }
        }
    }
    
    /**
     *    Test for a text substring.
	 *	  @package SimpleTest
	 *	  @subpackage UnitTester
     */
    class TextExpectation extends SimpleExpectation {
        var $_substring;
        
        /**
         *    Sets the value to compare against.
         *    @param string $substring  Text to search for.
         *    @param string $message    Customised message on failure.
         *    @access public
         */
        function TextExpectation($substring, $message = '%s') {
            $this->SimpleExpectation($message);
            $this->_substring = $substring;
        }
        
        /**
         *    Accessor for the substring.
         *    @return string       Text to match.
         *    @access protected
         */
        function _getSubstring() {
            return $this->_substring;
        }
        
        /**
         *    Tests the expectation. True if the text contains the
         *    substring.
         *    @param string $compare        Comparison value.
         *    @return boolean               True if correct.
         *    @access public
         */
        function test($compare) {
            return (strpos($compare, $this->_substring) !== false);
        }
        
        /**
         *    Returns a human readable test message.
         *    @param mixed $compare      Comparison value.
         *    @return string             Description of success
         *                               or failure.
         *    @access public
         */
        function testMessage($compare) {
            if ($this->test($compare)) {
                return $this->_describeTextMatch($this->_getSubstring(), $compare);
            } else {
                $dumper = &$this->_getDumper();
                return "Text [" . $this->_getSubstring() .
                        "] not detected in [" .
                        $dumper->describeValue($compare) . "]";
            }
        }
        
        /**
         *    Describes a pattern match including the string
         *    found and it's position.
         *    @param string $substring      Text to search for.
         *    @param string $subject        Subject to search.
         *    @access protected
         */
        function _describeTextMatch($substring, $subject) {
            $position = strpos($subject, $substring);
            $dumper = &$this->_getDumper();
            return "Text [$substring] detected at character [$position] in [" .
                    $dumper->describeValue($subject) . "] in region [" .
                    $dumper->clipString($subject, 100, $position) . "]";
        }
    }
    
    /**
     *    Fail if a substring is detected within the
     *    comparison text.
	 *	  @package SimpleTest
	 *	  @subpackage UnitTester
     */
    class NoTextExpectation extends TextExpectation {
        
        /**
         *    Sets the reject pattern
         *    @param string $substring  Text to search for.
         *    @param string $message    Customised message on failure.
         *    @access public
         */
        function NoTextExpectation($substring, $message = '%s') {
            $this->TextExpectation($substring, $message);
        }
        
        /**
         *    Tests the expectation. False if the substring appears
         *    in the text.
         *    @param string $compare        Comparison value.
         *    @return boolean               True if correct.
         *    @access public
         */
        function test($compare) {
            return ! parent::test($compare);
        }
        
        /**
         *    Returns a human readable test message.
         *    @param string $compare      Comparison value.
         *    @return string              Description of success
         *                                or failure.
         *    @access public
         */
        function testMessage($compare) {
            if ($this->test($compare)) {
                $dumper = &$this->_getDumper();
                return "Text [" . $this->_getSubstring() .
                        "] not detected in [" .
                        $dumper->describeValue($compare) . "]";
            } else {
                return $this->_describeTextMatch($this->_getSubstring(), $compare);
            }
        }
    }
    
    /**
     *    Test case for testing of web pages. Allows
     *    fetching of pages, parsing of HTML and
     *    submitting forms.
	 *    @package SimpleTest
	 *    @subpackage WebTester
     */
    class WebTestCase extends SimpleTestCase {
        var $_browser;
        var $_ignore_errors = false;
        
        /**
         *    Creates an empty test case. Should be subclassed
         *    with test methods for a functional test case.
         *    @param string $label     Name of test case. Will use
         *                             the class name if none specified.
         *    @access public
         */
        function WebTestCase($label = false) {
            $this->SimpleTestCase($label);
        }
        
        /**
         *    Announces the start of the test.
         *    @param string $method    Test method just started.
         *    @access public
         */
        function before($method) {
            parent::before($method);
            $this->setBrowser($this->createBrowser());
        }

        /**
         *    Announces the end of the test. Includes private clean up.
         *    @param string $method    Test method just finished.
         *    @access public
         */
        function after($method) {
            $this->unsetBrowser();
            parent::after($method);
        }
        
        /**
         *    Gets a current browser reference for setting
         *    special expectations or for detailed
         *    examination of page fetches.
         *    @return SimpleBrowser     Current test browser object.
         *    @access public
         */
        function &getBrowser() {
            return $this->_browser;
        }
        
        /**
         *    Gets a current browser reference for setting
         *    special expectations or for detailed
         *    examination of page fetches.
         *    @param SimpleBrowser $browser    New test browser object.
         *    @access public
         */
        function setBrowser(&$browser) {
            return $this->_browser = &$browser;
        }
          
        /**
         *    Clears the current browser reference to help the
         *    PHP garbage collector.
         *    @access public
         */
        function unsetBrowser() {
            unset($this->_browser);
        }
      
        /**
         *    Creates a new default web browser object.
         *    Will be cleared at the end of the test method.
         *    @return TestBrowser           New browser.
         *    @access public
         */
        function &createBrowser() {
            $browser = &new SimpleBrowser();
            return $browser;
        }
        
        /**
         *    Gets the last response error.
         *    @return string    Last low level HTTP error.
         *    @access public
         */
        function getTransportError() {
            return $this->_browser->getTransportError();
        }
          
        /**
         *    Accessor for the currently selected URL.
         *    @return string        Current location or false if
         *                          no page yet fetched.
         *    @access public
         */
        function getUrl() {
            return $this->_browser->getUrl();
        }
        
        /**
         *    Dumps the current request for debugging.
         *    @access public
         */
        function showRequest() {
            $this->dump($this->_browser->getRequest());
        }
        
        /**
         *    Dumps the current HTTP headers for debugging.
         *    @access public
         */
        function showHeaders() {
            $this->dump($this->_browser->getHeaders());
        }
      
        /**
         *    Dumps the current HTML source for debugging.
         *    @access public
         */
        function showSource() {
            $this->dump($this->_browser->getContent());
        }
      
        /**
         *    Dumps the visible text only for debugging.
         *    @access public
         */
        function showText() {
            $this->dump(wordwrap($this->_browser->getContentAsText(), 80));
        }
        
        /**
         *    Simulates the closing and reopening of the browser.
         *    Temporary cookies will be discarded and timed
         *    cookies will be expired if later than the
         *    specified time.
         *    @param string/integer $date Time when session restarted.
         *                                If ommitted then all persistent
         *                                cookies are kept. Time is either
         *                                Cookie format string or timestamp.
         *    @access public
         */
        function restart($date = false) {
            if ($date === false) {
                $date = time();
            }
            $this->_browser->restart($date);
        }
        
        /**
         *    Moves cookie expiry times back into the past.
         *    Useful for testing timeouts and expiries.
         *    @param integer $interval    Amount to age in seconds.
         *    @access public
         */
        function ageCookies($interval) {
            $this->_browser->ageCookies($interval);
        }
        
        /**
         *    Disables frames support. Frames will not be fetched
         *    and the frameset page will be used instead.
         *    @access public
         */
        function ignoreFrames() {
            $this->_browser->ignoreFrames();
        }
        
        /**
         *    Switches off cookie sending and recieving.
         *    @access public
         */
        function ignoreCookies() {
            $this->_browser->ignoreCookies();
        }
        
        /**
         *    Skips errors for the next request only. You might
         *    want to confirm that a page is unreachable for
         *    example.
         *    @access public
         */
        function ignoreErrors() {
            $this->_ignore_errors = true;
        }
        
        /**
         *    Issues a fail if there is a transport error anywhere
         *    in the current frameset. Only one such error is
         *    reported.
         *    @param string/boolean $result   HTML or failure.
         *    @return string/boolean $result  Passes through result.
         *    @access private
         */
        function _failOnError($result) {
            if (! $this->_ignore_errors) {
                if ($error = $this->_browser->getTransportError()) {
                    $this->fail($error);
                }
            }
            $this->_ignore_errors = false;
            return $result;
        }

        /**
         *    Adds a header to every fetch.
         *    @param string $header       Header line to add to every
         *                                request until cleared.
         *    @access public
         */
        function addHeader($header) {
            $this->_browser->addHeader($header);
        }
        
        /**
         *    Sets the maximum number of redirects before
         *    the web page is loaded regardless.
         *    @param integer $max        Maximum hops.
         *    @access public
         */
        function setMaximumRedirects($max) {
            if (! $this->_browser) {
                trigger_error(
                        'Can only set maximum redirects in a test method, setUp() or tearDown()');
            }
            $this->_browser->setMaximumRedirects($max);
        }
        
        /**
         *    Sets the socket timeout for opening a connection and
         *    receiving at least one byte of information.
         *    @param integer $timeout      Maximum time in seconds.
         *    @access public
         */
        function setConnectionTimeout($timeout) {
            $this->_browser->setConnectionTimeout($timeout);
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
        function useProxy($proxy, $username = false, $password = false) {
            $this->_browser->useProxy($proxy, $username, $password);
        }
        
        /**
         *    Fetches a page into the page buffer. If
         *    there is no base for the URL then the
         *    current base URL is used. After the fetch
         *    the base URL reflects the new location.
         *    @param string $url          URL to fetch.
         *    @param hash $parameters     Optional additional GET data.
         *    @return boolean/string      Raw page on success.
         *    @access public
         */
        function get($url, $parameters = false) {
            return $this->_failOnError($this->_browser->get($url, $parameters));
        }
        
        /**
         *    Fetches a page by POST into the page buffer.
         *    If there is no base for the URL then the
         *    current base URL is used. After the fetch
         *    the base URL reflects the new location.
         *    @param string $url          URL to fetch.
         *    @param hash $parameters     Optional additional GET data.
         *    @return boolean/string      Raw page on success.
         *    @access public
         */
        function post($url, $parameters = false) {
            return $this->_failOnError($this->_browser->post($url, $parameters));
        }
        
        /**
         *    Does a HTTP HEAD fetch, fetching only the page
         *    headers. The current base URL is unchanged by this.
         *    @param string $url          URL to fetch.
         *    @param hash $parameters     Optional additional GET data.
         *    @return boolean             True on success.
         *    @access public
         */
        function head($url, $parameters = false) {
            return $this->_failOnError($this->_browser->head($url, $parameters));
        }
        
        /**
         *    Equivalent to hitting the retry button on the
         *    browser. Will attempt to repeat the page fetch.
         *    @return boolean     True if fetch succeeded.
         *    @access public
         */
        function retry() {
            return $this->_failOnError($this->_browser->retry());
        }
        
        /**
         *    Equivalent to hitting the back button on the
         *    browser.
         *    @return boolean     True if history entry and
         *                        fetch succeeded.
         *    @access public
         */
        function back() {
            return $this->_failOnError($this->_browser->back());
        }
        
        /**
         *    Equivalent to hitting the forward button on the
         *    browser.
         *    @return boolean     True if history entry and
         *                        fetch succeeded.
         *    @access public
         */
        function forward() {
            return $this->_failOnError($this->_browser->forward());
        }
        
        /**
         *    Retries a request after setting the authentication
         *    for the current realm.
         *    @param string $username    Username for realm.
         *    @param string $password    Password for realm.
         *    @return boolean/string     HTML on successful fetch. Note
         *                               that authentication may still have
         *                               failed.
         *    @access public
         */
        function authenticate($username, $password) {
            return $this->_failOnError(
                    $this->_browser->authenticate($username, $password));
        }
        
        /**
         *    Gets the cookie value for the current browser context.
         *    @param string $name          Name of cookie.
         *    @return string               Value of cookie or false if unset.
         *    @access public
         */
        function getCookie($name) {
            return $this->_browser->getCurrentCookieValue($name);
        }
        
        /**
         *    Sets a cookie in the current browser.
         *    @param string $name          Name of cookie.
         *    @param string $value         Cookie value.
         *    @param string $host          Host upon which the cookie is valid.
         *    @param string $path          Cookie path if not host wide.
         *    @param string $expiry        Expiry date.
         *    @access public
         */
        function setCookie($name, $value, $host = false, $path = "/", $expiry = false) {
            $this->_browser->setCookie($name, $value, $host, $path, $expiry);
        }
        
        /**
         *    Accessor for current frame focus. Will be
         *    false if no frame has focus.
         *    @return integer/string/boolean    Label if any, otherwise
         *                                      the position in the frameset
         *                                      or false if none.
         *    @access public
         */
        function getFrameFocus() {
            return $this->_browser->getFrameFocus();
        }
        
        /**
         *    Sets the focus by index. The integer index starts from 1.
         *    @param integer $choice    Chosen frame.
         *    @return boolean           True if frame exists.
         *    @access public
         */
        function setFrameFocusByIndex($choice) {
            return $this->_browser->setFrameFocusByIndex($choice);
        }
        
        /**
         *    Sets the focus by name.
         *    @param string $name    Chosen frame.
         *    @return boolean        True if frame exists.
         *    @access public
         */
        function setFrameFocus($name) {
            return $this->_browser->setFrameFocus($name);
        }
        
        /**
         *    Clears the frame focus. All frames will be searched
         *    for content.
         *    @access public
         */
        function clearFrameFocus() {
            return $this->_browser->clearFrameFocus();
        }
        
        /**
         *    Clicks a visible text item. Will first try buttons,
         *    then links and then images.
         *    @param string $label        Visible text or alt text.
         *    @return string/boolean      Raw page or false.
         *    @access public
         */
        function click($label) {
            return $this->_failOnError($this->_browser->click($label));
        }
        
        /**
         *    Clicks the submit button by label. The owning
         *    form will be submitted by this.
         *    @param string $label    Button label. An unlabeled
         *                            button can be triggered by 'Submit'.
         *    @param hash $additional Additional form values.
         *    @return boolean/string  Page on success, else false.
         *    @access public
         */
        function clickSubmit($label = 'Submit', $additional = false) {
            return $this->_failOnError(
                    $this->_browser->clickSubmit($label, $additional));
        }
        
        /**
         *    Clicks the submit button by name attribute. The owning
         *    form will be submitted by this.
         *    @param string $name     Name attribute of button.
         *    @param hash $additional Additional form values.
         *    @return boolean/string  Page on success.
         *    @access public
         */
        function clickSubmitByName($name, $additional = false) {
            return $this->_failOnError(
                    $this->_browser->clickSubmitByName($name, $additional));
        }
        
        /**
         *    Clicks the submit button by ID attribute. The owning
         *    form will be submitted by this.
         *    @param string $id       ID attribute of button.
         *    @param hash $additional Additional form values.
         *    @return boolean/string  Page on success.
         *    @access public
         */
        function clickSubmitById($id, $additional = false) {
            return $this->_failOnError(
                    $this->_browser->clickSubmitById($id, $additional));
        }
        
        /**
         *    Clicks the submit image by some kind of label. Usually
         *    the alt tag or the nearest equivalent. The owning
         *    form will be submitted by this. Clicking outside of
         *    the boundary of the coordinates will result in
         *    a failure.
         *    @param string $label    Alt attribute of button.
         *    @param integer $x       X-coordinate of imaginary click.
         *    @param integer $y       Y-coordinate of imaginary click.
         *    @param hash $additional Additional form values.
         *    @return boolean/string  Page on success.
         *    @access public
         */
        function clickImage($label, $x = 1, $y = 1, $additional = false) {
            return $this->_failOnError(
                    $this->_browser->clickImage($label, $x, $y, $additional));
        }
        
        /**
         *    Clicks the submit image by the name. Usually
         *    the alt tag or the nearest equivalent. The owning
         *    form will be submitted by this. Clicking outside of
         *    the boundary of the coordinates will result in
         *    a failure.
         *    @param string $name     Name attribute of button.
         *    @param integer $x       X-coordinate of imaginary click.
         *    @param integer $y       Y-coordinate of imaginary click.
         *    @param hash $additional Additional form values.
         *    @return boolean/string  Page on success.
         *    @access public
         */
        function clickImageByName($name, $x = 1, $y = 1, $additional = false) {
            return $this->_failOnError(
                    $this->_browser->clickImageByName($name, $x, $y, $additional));
        }
        
        /**
         *    Clicks the submit image by ID attribute. The owning
         *    form will be submitted by this. Clicking outside of
         *    the boundary of the coordinates will result in
         *    a failure.
         *    @param integer/string $id   ID attribute of button.
         *    @param integer $x           X-coordinate of imaginary click.
         *    @param integer $y           Y-coordinate of imaginary click.
         *    @param hash $additional     Additional form values.
         *    @return boolean/string      Page on success.
         *    @access public
         */
        function clickImageById($id, $x = 1, $y = 1, $additional = false) {
            return $this->_failOnError(
                    $this->_browser->clickImageById($id, $x, $y, $additional));
        }
        
        /**
         *    Submits a form by the ID.
         *    @param string $id       Form ID. No button information
         *                            is submitted this way.
         *    @return boolean/string  Page on success.
         *    @access public
         */
        function submitFormById($id) {
            return $this->_failOnError($this->_browser->submitFormById($id));
        }
        
        /**
         *    Follows a link by name. Will click the first link
         *    found with this link text by default, or a later
         *    one if an index is given. Match is case insensitive
         *    with normalised space.
         *    @param string $label     Text between the anchor tags.
         *    @param integer $index    Link position counting from zero.
         *    @return boolean/string   Page on success.
         *    @access public
         */
        function clickLink($label, $index = 0) {
            return $this->_failOnError($this->_browser->clickLink($label, $index));
        }
        
        /**
         *    Follows a link by id attribute.
         *    @param string $id        ID attribute value.
         *    @return boolean/string   Page on success.
         *    @access public
         */
        function clickLinkById($id) {
            return $this->_failOnError($this->_browser->clickLinkById($id));
        }
        
        /**
         *    Will trigger a pass if the two parameters have
         *    the same value only. Otherwise a fail. This
         *    is for testing hand extracted text, etc.
         *    @param mixed $first          Value to compare.
         *    @param mixed $second         Value to compare.
         *    @param string $message       Message to display.
         *    @return boolean              True on pass
         *    @access public
         */
        function assertEqual($first, $second, $message = "%s") {
            return $this->assert(
                    new EqualExpectation($first),
                    $second,
                    $message);
        }
        
        /**
         *    Will trigger a pass if the two parameters have
         *    a different value. Otherwise a fail. This
         *    is for testing hand extracted text, etc.
         *    @param mixed $first           Value to compare.
         *    @param mixed $second          Value to compare.
         *    @param string $message        Message to display.
         *    @return boolean               True on pass
         *    @access public
         */
        function assertNotEqual($first, $second, $message = "%s") {
            return $this->assert(
                    new NotEqualExpectation($first),
                    $second,
                    $message);
        }
        
        /**
         *    Tests for the presence of a link label. Match is
         *    case insensitive with normalised space.
         *    @param string $label     Text between the anchor tags.
         *    @param string $message   Message to display. Default
         *                             can be embedded with %s.
         *    @return boolean          True if link present.
         *    @access public
         */
        function assertLink($label, $message = "%s") {
            return $this->assertTrue(
                    $this->_browser->isLink($label),
                    sprintf($message, "Link [$label] should exist"));
        }

        /**
         *    Tests for the non-presence of a link label. Match is
         *    case insensitive with normalised space.
         *    @param string/integer $label    Text between the anchor tags
         *                                    or ID attribute.
         *    @param string $message          Message to display. Default
         *                                    can be embedded with %s.
         *    @return boolean                 True if link missing.
         *    @access public
         */
        function assertNoLink($label, $message = "%s") {
            return $this->assertFalse(
                    $this->_browser->isLink($label),
                    sprintf($message, "Link [$label] should not exist"));
        }
        
        /**
         *    Tests for the presence of a link id attribute.
         *    @param string $id        Id attribute value.
         *    @param string $message   Message to display. Default
         *                             can be embedded with %s.
         *    @return boolean          True if link present.
         *    @access public
         */
        function assertLinkById($id, $message = "%s") {
            return $this->assertTrue(
                    $this->_browser->isLinkById($id),
                    sprintf($message, "Link ID [$id] should exist"));
        }

        /**
         *    Tests for the non-presence of a link label. Match is
         *    case insensitive with normalised space.
         *    @param string $id        Id attribute value.
         *    @param string $message   Message to display. Default
         *                             can be embedded with %s.
         *    @return boolean          True if link missing.
         *    @access public
         */
        function assertNoLinkById($id, $message = "%s") {
            return $this->assertFalse(
                    $this->_browser->isLinkById($id),
                    sprintf($message, "Link ID [$id] should not exist"));
        }
        
        /**
         *    Sets all form fields with that label, or name if there
         *    is no label attached.
         *    @param string $name    Name of field in forms.
         *    @param string $value   New value of field.
         *    @return boolean        True if field exists, otherwise false.
         *    @access public
         */
        function setField($label, $value) {
            return $this->_browser->setField($label, $value);
        }
        
        /**
         *    Sets all form fields with that name.
         *    @param string $name    Name of field in forms.
         *    @param string $value   New value of field.
         *    @return boolean        True if field exists, otherwise false.
         *    @access public
         */
        function setFieldByName($name, $value) {
            return $this->_browser->setFieldByName($name, $value);
        }
          
        /**
         *    Sets all form fields with that name.
         *    @param string/integer $id   Id of field in forms.
         *    @param string $value        New value of field.
         *    @return boolean             True if field exists, otherwise false.
         *    @access public
         */
        function setFieldById($id, $value) {
            return $this->_browser->setFieldById($id, $value);
        }
        
        /**
         *    Confirms that the form element is currently set
         *    to the expected value. A missing form will always
         *    fail. If no value is given then only the existence
         *    of the field is checked.
         *    @param string $name       Name of field in forms.
         *    @param mixed $expected    Expected string/array value or
         *                              false for unset fields.
         *    @param string $message    Message to display. Default
         *                              can be embedded with %s.
         *    @return boolean           True if pass.
         *    @access public
         */
        function assertField($label, $expected = true, $message = '%s') {
            $value = $this->_browser->getField($label);
            return $this->_assertFieldValue($label, $value, $expected, $message);
        }
        
        /**
         *    Confirms that the form element is currently set
         *    to the expected value. A missing form element will always
         *    fail. If no value is given then only the existence
         *    of the field is checked.
         *    @param string $name       Name of field in forms.
         *    @param mixed $expected    Expected string/array value or
         *                              false for unset fields.
         *    @param string $message    Message to display. Default
         *                              can be embedded with %s.
         *    @return boolean           True if pass.
         *    @access public
         */
        function assertFieldByName($name, $expected = true, $message = '%s') {
            $value = $this->_browser->getFieldByName($name);
            return $this->_assertFieldValue($name, $value, $expected, $message);
        }
         
        /**
         *    Confirms that the form element is currently set
         *    to the expected value. A missing form will always
         *    fail. If no ID is given then only the existence
         *    of the field is checked.
         *    @param string/integer $id  Name of field in forms.
         *    @param mixed $expected     Expected string/array value or
         *                               false for unset fields.
         *    @param string $message     Message to display. Default
         *                               can be embedded with %s.
         *    @return boolean            True if pass.
         *    @access public
         */
        function assertFieldById($id, $expected = true, $message = '%s') {
            $value = $this->_browser->getFieldById($id);
            return $this->_assertFieldValue($id, $value, $expected, $message);
        }
        
        /**
         *    Tests the field value against the expectation.
         *    @param string $identifier      Name, ID or label.
         *    @param mixed $value            Current field value.
         *    @param mixed $expected         Expected value to match.
         *    @param string $message         Failure message.
         *    @return boolean                True if pass
         *    @access protected
         */
        function _assertFieldValue($identifier, $value, $expected, $message) {
            if ($expected === true) {
                return $this->assertTrue(
                        isset($value),
                        sprintf($message, "Field [$identifier] should exist"));
            }
            if (! SimpleExpectation::isExpectation($expected)) {
                $identifier = str_replace('%', '%%', $identifier);
                $expected = new FieldExpectation(
                        $expected,
                        "Field [$identifier] should match with [%s]");
            }
            return $this->assert($expected, $value, $message);
        }
       
        /**
         *    Checks the response code against a list
         *    of possible values.
         *    @param array $responses    Possible responses for a pass.
         *    @param string $message     Message to display. Default
         *                               can be embedded with %s.
         *    @return boolean            True if pass.
         *    @access public
         */
        function assertResponse($responses, $message = '%s') {
            $responses = (is_array($responses) ? $responses : array($responses));
            $code = $this->_browser->getResponseCode();
            $message = sprintf($message, "Expecting response in [" .
                    implode(", ", $responses) . "] got [$code]");
            return $this->assertTrue(in_array($code, $responses), $message);
        }
        
        /**
         *    Checks the mime type against a list
         *    of possible values.
         *    @param array $types      Possible mime types for a pass.
         *    @param string $message   Message to display.
         *    @return boolean          True if pass.
         *    @access public
         */
        function assertMime($types, $message = '%s') {
            $types = (is_array($types) ? $types : array($types));
            $type = $this->_browser->getMimeType();
            $message = sprintf($message, "Expecting mime type in [" .
                    implode(", ", $types) . "] got [$type]");
            return $this->assertTrue(in_array($type, $types), $message);
        }
        
        /**
         *    Attempt to match the authentication type within
         *    the security realm we are currently matching.
         *    @param string $authentication   Usually basic.
         *    @param string $message          Message to display.
         *    @return boolean                 True if pass.
         *    @access public
         */
        function assertAuthentication($authentication = false, $message = '%s') {
            if (! $authentication) {
                $message = sprintf($message, "Expected any authentication type, got [" .
                        $this->_browser->getAuthentication() . "]");
                return $this->assertTrue(
                        $this->_browser->getAuthentication(),
                        $message);
            } else {
                $message = sprintf($message, "Expected authentication [$authentication] got [" .
                        $this->_browser->getAuthentication() . "]");
                return $this->assertTrue(
                        strtolower($this->_browser->getAuthentication()) == strtolower($authentication),
                        $message);
            }
        }
        
        /**
         *    Checks that no authentication is necessary to view
         *    the desired page.
         *    @param string $message     Message to display.
         *    @return boolean            True if pass.
         *    @access public
         */
        function assertNoAuthentication($message = '%s') {
            $message = sprintf($message, "Expected no authentication type, got [" .
                    $this->_browser->getAuthentication() . "]");
            return $this->assertFalse($this->_browser->getAuthentication(), $message);
        }
        
        /**
         *    Attempts to match the current security realm.
         *    @param string $realm     Name of security realm.
         *    @param string $message   Message to display.
         *    @return boolean          True if pass.
         *    @access public
         */
        function assertRealm($realm, $message = '%s') {
            if (! SimpleExpectation::isExpectation($realm)) {
                $realm = new EqualExpectation($realm);
            }
            return $this->assert(
                    $realm,
                    $this->_browser->getRealm(),
                    "Expected realm -> $message");
        }
        
        /**
         *    Checks each header line for the required value. If no
         *    value is given then only an existence check is made.
         *    @param string $header    Case insensitive header name.
         *    @param mixed $value      Case sensitive trimmed string to
         *                             match against. An expectation object
         *                             can be used for pattern matching.
         *    @return boolean          True if pass.
         *    @access public
         */
        function assertHeader($header, $value = false, $message = '%s') {
            return $this->assert(
                    new HttpHeaderExpectation($header, $value),
                    $this->_browser->getHeaders(),
                    $message);
        }
          
        /**
         *    @deprecated
         */
        function assertHeaderPattern($header, $pattern, $message = '%s') {
            return $this->assert(
                    new HttpHeaderExpectation($header, new PatternExpectation($pattern)),
                    $this->_browser->getHeaders(),
                    $message);
        }

        /**
         *    Confirms that the header type has not been received.
         *    Only the landing page is checked. If you want to check
         *    redirect pages, then you should limit redirects so
         *    as to capture the page you want.
         *    @param string $header    Case insensitive header name.
         *    @return boolean          True if pass.
         *    @access public
         */
        function assertNoHeader($header, $message = '%s') {
            return $this->assert(
                    new NoHttpHeaderExpectation($header),
                    $this->_browser->getHeaders(),
                    $message);
        }
          
        /**
         *    @deprecated
         */
        function assertNoUnwantedHeader($header, $message = '%s') {
            return $this->assertNoHeader($header, $message);
        }
        
        /**
         *    Tests the text between the title tags.
         *    @param string $title      Expected title.
         *    @param string $message    Message to display.
         *    @return boolean           True if pass.
         *    @access public
         */
        function assertTitle($title = false, $message = '%s') {
            if (! SimpleExpectation::isExpectation($title)) {
                $title = new EqualExpectation($title);
            }
            return $this->assert($title, $this->_browser->getTitle(), $message);
        }
        
        /**
         *    Will trigger a pass if the text is found in the plain
         *    text form of the page.
         *    @param string $text       Text to look for.
         *    @param string $message    Message to display.
         *    @return boolean           True if pass.
         *    @access public
         */
        function assertText($text, $message = '%s') {
            return $this->assert(
                    new TextExpectation($text),
                    $this->_browser->getContentAsText(),
                    $message);
        }
        
        /**
         *	  @deprecated
         */
        function assertWantedText($text, $message = '%s') {
        	return $this->assertText($text, $message);
        }
        
        /**
         *    Will trigger a pass if the text is not found in the plain
         *    text form of the page.
         *    @param string $text       Text to look for.
         *    @param string $message    Message to display.
         *    @return boolean           True if pass.
         *    @access public
         */
        function assertNoText($text, $message = '%s') {
            return $this->assert(
                    new NoTextExpectation($text),
                    $this->_browser->getContentAsText(),
                    $message);
        }
        
        /**
         *	  @deprecated
         */
        function assertNoUnwantedText($text, $message = '%s') {
        	return $this->assertNoText($text, $message);
        }
        
        /**
         *    Will trigger a pass if the Perl regex pattern
         *    is found in the raw content.
         *    @param string $pattern    Perl regex to look for including
         *                              the regex delimiters.
         *    @param string $message    Message to display.
         *    @return boolean           True if pass.
         *    @access public
         */
        function assertPattern($pattern, $message = '%s') {
            return $this->assert(
                    new PatternExpectation($pattern),
                    $this->_browser->getContent(),
                    $message);
        }
        
        /**
         *	  @deprecated
         */
        function assertWantedPattern($pattern, $message = '%s') {
        	return $this->assertPattern($pattern, $message);
        }
        
        /**
         *    Will trigger a pass if the perl regex pattern
         *    is not present in raw content.
         *    @param string $pattern    Perl regex to look for including
         *                              the regex delimiters.
         *    @param string $message    Message to display.
         *    @return boolean           True if pass.
         *    @access public
         */
        function assertNoPattern($pattern, $message = '%s') {
            return $this->assert(
                    new NoPatternExpectation($pattern),
                    $this->_browser->getContent(),
                    $message);
        }
        
        /**
         *	  @deprecated
         */
        function assertNoUnwantedPattern($pattern, $message = '%s') {
        	return $this->assertNoPattern($pattern, $message);
        }
        
        /**
         *    Checks that a cookie is set for the current page
         *    and optionally checks the value.
         *    @param string $name        Name of cookie to test.
         *    @param string $expected    Expected value as a string or
         *                               false if any value will do.
         *    @param string $message     Message to display.
         *    @return boolean            True if pass.
         *    @access public
         */
        function assertCookie($name, $expected = false, $message = '%s') {
            $value = $this->getCookie($name);
            if (! $expected) {
                return $this->assertTrue(
                        $value,
                        sprintf($message, "Expecting cookie [$name]"));
            }
            if (! SimpleExpectation::isExpectation($expected)) {
                $expected = new EqualExpectation($expected);
            }
            return $this->assert($expected, $value, "Expecting cookie [$name] -> $message");
        }
        
        /**
         *    Checks that no cookie is present or that it has
         *    been successfully cleared.
         *    @param string $name        Name of cookie to test.
         *    @param string $message     Message to display.
         *    @return boolean            True if pass.
         *    @access public
         */
        function assertNoCookie($name, $message = '%s') {
            return $this->assertTrue(
                    $this->getCookie($name) === false,
                    sprintf($message, "Not expecting cookie [$name]"));
        }
    }
?>