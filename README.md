PrivateMessaging
================

# Note
This module is currently under heavy development.

## Introduction

A Zend Framework 2 module based on ZfcUser which enables private messaging between users.

## Installation

### Using composer
1. Add `stijnhau/private-messaging` (version `dev-master`) to requirements
2. Run `update` command on composer
3. enable it in your `application.config.php` file.
4. Add the mysql.sql file to your database
5. Add the rest oif the data folder to your data folder
   
### Manually
1. Clone this project into your `./vendor/` directory and enable it in your
   `application.config.php` file.
2. Add the mysql.sql file to your database
3. Add the rest oif the data folder to your data folder

### Requires

1. PHP >= 5.4.0
2. ZfcUser >= 1.0.0

## Features
1. Sending messages to multiple persons.
2. Adjustable amount of messages in inbox and outbox(module based)
3. Removing messages from inbox.[WIP](by checkbox)
4. Removing messages from outbox.[WIP](By checkbox)
5. Removing message from inside the message(received) [WIP]
6. Removing message from inside the message(sent) [WIP]
7. Show message time of time-ago.
8. Option to enable or disable menu (\Zend\Navigation).
9. Configurable login route.
10. Replylink inside message[todo]
11. Multiple pages(usage of use \Zend\Paginator)
12. Starred or not[WIP]
13. Important or not[WIP]
14. Multilanguage (dutch and french ready) [WIP]
15. Unread messages in bold.
16. Configuration if newest or oldest message is first in lists.

# Thanks
Special thanks goes to https://github.com/hrevert/HtMessaging
This module is forked from there because https://github.com/hrevert/HtMessaging decided to go an other way.