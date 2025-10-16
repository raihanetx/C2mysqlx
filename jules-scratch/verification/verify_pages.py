from playwright.sync_api import sync_playwright

def run():
    with sync_playwright() as p:
        browser = p.chromium.launch(headless=True)
        page = browser.new_page()
        page.goto("http://localhost:8000")
        page.click("a[href*='about-us']")
        page.wait_for_selector("div.preserve-whitespace")
        page.screenshot(path="jules-scratch/verification/about-us.png")
        browser.close()

run()