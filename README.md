
# Resarch
## 19/02/2018
- [x] Google Sheets Custom Function that triggers the caching function
- [x] Dynamically create a MySQL table based on what's in the Google Sheet
- [ ] Understand other mechanisms for API access to Google Sheets
- [ ] Develop a way to simulate license key scene via the API key management scene.
- [ ] Prototype @page CSS rules and sub-rules like @top-left, etc.

# 16/02/2018
- [x] Prototype basic write / read interactions through PHP for MySQL
- [ ] Prototype reading a large range from a Google Sheet and ingesting it into a database

## 13/02/2018
- [-] Figure out SQLite to prevent concurrent access which can lead to queue corruption.
- [x] Simulate concurrent requests to the controller w/o any queue infrastructure
- [-] Simulate concurrent requests to the controller w/ a queue infrastructure
- [-] Maintain two separate queues for live query data and pdf generation
- [-] Build the scheduler to load-balance requests among these two queues
- [x] Figure out your genius idea to bypass all this queue non-sense alltogether.

## 12/02/2018
- [x] Prepare a simple sample pricing engine on Google Sheets
- [x] Use the Google Sheets API to write and read off a sheet
- [x] Figure out cross-linking cells / formulaes across Google Sheets
- [x] Figure out task scheduling in PHP or BASH or cron or combination of them.
- [x] Figure out a queue / task list system.
- [x] Figure out templating.
- [x] Other PDF Generator Apps part of Google Apps Ecosystem
- [x] Figure out PDF publishing with Chrome Puppeteer (support vs longevity).



# How to navigate this project
## Tests
This folder contains scripts that test / validate assumptions.
- `concurrentWritesAndReadsToAGoogleSheet.php` aims to determine if concurrent requests to a Google Sheet leads to incorrect / invalid data being returned.




# File structure
config.json
controller.php
log.php ( not done )
database.php
google-sheet.php
template.php
mailer.php ( not done )
crm.php ( not sure what this will be )
caching.php
scheduler.php

snippet-google-sheet.js
snippet-apache.conf (have to see if anything need be done)
snippet-frontend-requests.js (not done)

media/
vendor/

## config.json
Contains values like,
- Omega License key
- Google Sheets API client key
- Google Sheets Spreadsheet ID

## controller.php
This file orchestrates the flow of actions, namely
- Logging
- Reading off a database
- Building a template and generating the PDF
- Sending an email
- Ingesting a lead to a CRM

## log.php
Has functions that,
- Extract info about the request, such as customer name, unit number, configurations.....
- Stores that data in a file or database, along with a timestamp.

## database.php
Has functions that interact with a database.

## google-sheet.php
Has functions that interact with a Google Sheet

## template.php
Has functions that,
- Build a template
- Generate a PDF given a template

## mailer.php
Has functions for sending out emails.

## crm.php
Has functions for interfacing with a CRM.

## caching.php
This script syncs the local database with what is on the Google Spreadsheet.
This script is trigger by a custom function on Google Sheets.

## scheduler.php
This script schedules a flow of actions from,
- writing / reading data off Google Sheets
- generating a PDF
- ingesting a lead in a CRM

every 10 seconds.





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
