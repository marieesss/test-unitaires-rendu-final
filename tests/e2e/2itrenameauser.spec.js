// Generated by Selenium IDE
const { Builder, By, Key, until } = require('selenium-webdriver')
const assert = require('assert')
require('mocha');


describe('2 - it rename a user', function() {
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
  it('2 - it rename a user', async function() {
    await driver.get("http://localhost/efrei/tests-rendu/src/model/");

    await driver.wait(until.elementsLocated(By.css("li")), 5000);

    {
      const elements = await driver.findElements(By.css("li"))
      assert(elements.length)
    }
    await driver.findElement(By.css("button:nth-child(1)")).click()
    await driver.findElement(By.id("name")).click()
    await driver.findElement(By.id("name")).click()
    {
      const element = await driver.findElement(By.id("name"))
      await driver.actions({ bridge: true}).doubleClick(element).perform()
    }
    await driver.findElement(By.id("name")).click()
    await driver.findElement(By.id("name")).sendKeys("lucie")
    await driver.findElement(By.css("button:nth-child(5)")).click()
    {
      const elements = await driver.findElements(By.css("li"))
      assert(elements.length)
    }
  })
})
