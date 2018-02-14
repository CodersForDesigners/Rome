
# Resarch
## 13/02/2018
- [ ] Figure out SQLite to prevent concurrent access which can lead to queue corruption.
- [ ] Simulate concurrent requests to the controller w/o any queue infrastructure
- [ ] Simulate concurrent requests to the controller w/ a queue infrastructure
- [ ] Maintain two separate queues for live query data and pdf generation
- [ ] Build the scheduler to load-balance requests among these two queues
- [ ] Figure out your genius idea to bypass all this queue non-sense alltogether.

## 12/02/2018
- [x] Prepare a simple sample pricing engine on Google Sheets
- [x] Use the Google Sheets API to write and read off a sheet
- [x] Figure out cross-linking cells / formulaes across Google Sheets
- [ ] Understand other mechanisms for API access to Google Sheets
- [ ] Develop a way to simulate license key scene via the API key management scene.
- [x] Figure out task scheduling in PHP or BASH or cron or combination of them.
- [x] Figure out a queue / task list system.
- [ ] Prototype @page CSS rules and sub-rules like @top-left, etc.
- [x] Figure out templating.
- [x] Other PDF Generator Apps part of Google Apps Ecosystem
- [x] Figure out PDF publishing with Chrome Puppeteer (support vs longevity).



# How to navigate this project
## Tests
This folder contains scripts that test / validate assumptions.
- `concurrentWritesAndReadsToAGoogleSheet.php` aims to determine if concurrent requests to a Google Sheet leads to incorrect / invalid data being returned.




# What's in the name
- Real Estate
- Data Merge
- Publishing
- PDF
- In and Out

## portmanteaus
- Redameiop
- Remo
- Rome
- Remio
