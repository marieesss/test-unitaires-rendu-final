// Generated by Selenium IDE
const { Builder, By, Key, until } = require('selenium-webdriver')
const assert = require('assert')
require('mocha');


describe('3 - it delete a user', function() {
  this.timeout(30000)
  let driver
  let vars
  beforeEach(async function() {
    driver = await new Builder().forBrowser('firefox').build()
    vars = {}
  })
  afterEach(async function() {
    await driver.quit();
  })
  it('3 - it delete a user', async function() {
    await driver.get("http://localhost/efrei/tests-rendu/src/model/");
    await driver.manage().window().setRect({ width: 724, height: 672 })
    await driver.findElement(By.css("button:nth-child(2)")).click()
    {
      const elements = await driver.findElements(By.css("li"))
      assert(!elements.length)
    }
  })
})
