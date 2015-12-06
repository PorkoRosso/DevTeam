<?php
include 'functions.php';
/*PHP automated unit Tests*/
/*implementation from http://codeception.com/11-12-2013/working-with-phpunit-and-selenium-webdriver.html
We also will need Selenium server executable as well. You need Java installed in order to run the Selenium server. You can launch it by running this:
java -jar selenium-server-standalone-2.37.0.jar
php composer.phar install

*/
class functionTests extends PHPUnit_Framework_TestCase {
	/**
	     * @var \RemoteWebDriver
	     */
	    protected $webDriver;
	    public function setUp()/*starts a webpage for tests to run*/
	    {
	        $capabilities = array(\WebDriverCapabilityType::BROWSER_NAME => 'firefox');
	        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
	    }
 	protected $url = 'http://localhost:8888/login.php';/*our path to login page here*/

    public function testCheckLogin()
    {
        $this->webDriver->get($this->url);
        //fills in info and executes a logon
       // Checklogin('aaabbb@colorado.edu', 'aaabbb');
        //fills in accunt
        $search = $this->webDriver->findElement(WebDriverBy::name('user_email'));
        $search->click();
        $this->webDriver->getKeyboard()->sendKeys('aaabbb@colorado.edu');
        //fills in pass
         $search = $this->webDriver->findElement(WebDriverBy::name('user_pass'));
		$search->click();
        $this->webDriver->getKeyboard()->sendKeys('aaabbb');
        $this->webDriver->getKeyboard()->pressKey(WebDriverKeys::ENTER);
        // checking that page title contains word 'Home'
        $this->assertContains('rj_user.php', $this->webDriver->getTitle());
    } 

    protected $url2 = 'http://localhost:8888/rj_reg.php';/*our path to login page here*/
    public function testCheckSignUp()
    {
        $this->webDriver->get($this->url2);
        //fills in info and executes a register checks that the page changes after register

        //fills in name
        $search = $this->webDriver->findElement(WebDriverBy::name('user_first_name'));
        $search->click();
        $this->webDriver->getKeyboard()->sendKeys('Ralphie');
	//fills in last name
        $search = $this->webDriver->findElement(WebDriverBy::name('user_last_name'));
        $search->click();
        $this->webDriver->getKeyboard()->sendKeys('Buf');
        //fills in phone
        $search = $this->webDriver->findElement(WebDriverBy::name('user_phone'));
        $search->click();
        $this->webDriver->getKeyboard()->sendKeys('555-666-7777');
        //fills in email
        $search = $this->webDriver->findElement(WebDriverBy::name('user_email'));
        $search->click();
        $this->webDriver->getKeyboard()->sendKeys('aaabbb@colorado.edu');
        //fills in pass
        $search = $this->webDriver->findElement(WebDriverBy::name('user_pass'));
        $search->click();
        $this->webDriver->getKeyboard()->sendKeys('SkoBuffs99');

        $this->webDriver->getKeyboard()->pressKey(WebDriverKeys::ENTER);
        // checking that page title contains word 'Home'
        $this->assertContains('login.php', $this->webDriver->getTitle());
    } 

    //makes sure we dont run a test if an element is not found   
	protected function assertElementNotFound($by)
    {
        $els = $this->webDriver->findElements($by);
        if (count($els)) {
            $this->fail("Unexpectedly element was found");
        }
        // increment assertion counter
        $this->assertTrue(true);
        
    }
	public function tearDown()//takes page down after test
    {
        $this->webDriver->quit();
    }
}
?>
