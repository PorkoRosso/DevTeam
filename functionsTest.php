<?php
include 'functions.php';
/*PHP automated unit Tests*/
/*implementation from http://codeception.com/11-12-2013/working-with-phpunit-and-selenium-webdriver.html*/
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
 	protected $url = 'http://localhost:8888/rj_user.php';/*our path to login page here*/

    public function testCheckLogin()
    {
        $this->webDriver->get($this->url);
        //execute logon function on page
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
        $this->assertContains('Home', $this->webDriver->getTitle());
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
