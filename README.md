# IOSanitizationCMS
# Project 2 - Input/Output Sanitization

Time spent: **10** hours spent in total

## User Stories

The following **required** functionality is completed:

1\. [X]  Required: Import the Starting Database

2\. [X]  Required: Set Up the Starting Code

3\. [X]  Required: Review code for Staff CMS for Users

4\. [X]  Required: Complete Staff CMS for Salespeople
  * [X]  Required: index.php
  * [X]  Required: show.php
  * [X]  Required: new.php
  * [X]  Required: edit.php

5\. [X]  Required: Complete Staff CMS for States
  * [X]  Required: index.php
  * [X]  Required: show.php
  * [X]  Required: new.php
  * [X]  Required: edit.php

6\. [X]  Required: Complete Staff CMS for Territories
  * [X]  Required: index.php
  * [X]  Required: show.php
  * [X]  Required: new.php
  * [X]  Required: edit.php

7\. [X]  Required: Add Data Validations
  * [X]  Required: Validate that no values are left blank.
  * [X]  Required: Validate that all string values are less than 255 characters.
  * [X]  Required: Validate that usernames contain only the whitelisted characters.
  * [X]  Required: Validate that phone numbers contain only the whitelisted characters.
  * [X]  Required: Validate that email addresses contain only whitelisted characters.
  * [X]  Required: Add *at least 5* other validations of your choosing.

8\. [X]  Required: Sanitization
  * [X]  Required: All input and dynamic output should be sanitized.
  * [X]  Required: Sanitize dynamic data for URLs
  * [X]  Required: Sanitize dynamic data for HTML
  * [X]  Required: Sanitize dynamic data for SQL

9\. [X]  Required: Penetration Testing
  * [X]  Required: Verify form inputs are not vulnerable to SQLI attacks.
  * [X]  Required: Verify query strings are not vulnerable to SQLI attacks.
  * [X]  Required: Verify form inputs are not vulnerable to XSS attacks.
  * [X]  Required: Verify query strings are not vulnerable to XSS attacks.
  * [X]  Required: Listed other bugs or security vulnerabilities


The following advanced user stories are optional:

- [ ]  Bonus: On "public/staff/territories/show.php", display the name of the state.

- [ ]  Bonus: Validate the uniqueness of `users.username`.

- [ ]  Bonus: Add a page for "public/staff/users/delete.php".

- [ ]  Bonus: Add a Staff CMS for countries.

- [ ]  Advanced: Nest the CMS for states inside of the Staff CMS for countries


## Video Walkthrough

Here's a walkthrough of implemented user stories:

<img src='./project2UserStories.gif' title='Video Walkthrough' width='' alt='Video Walkthrough' />

GIF created with [LiceCap](http://www.cockos.com/licecap/).

## Notes

Describe any challenges encountered while building the app.

Markup: *Keeping track the development of so many different web pages was a challenge.

## License

    Copyright [yyyy] [name of copyright owner]

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.