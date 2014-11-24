Blabot
=================

Exceptionally language faithful generator of dummy text, 
originally designed for Czech typography.

Feel free to have some fun using [Blabot.net](http://blabot.net)

Install & Setup
---------------

1. Clone project: `$ git clone git@github.com:tomaskuba/blabot.git`
2. Update composer `$ composer update`
3. Run tests `$ vendor/bin/behat && vendor/bin/phpunit tests/`

Usage
-------

Please remember that you should set `mb_internal_encoding("UTF-8");`
to be sure that Blabot will handle multi-byte strings properly.
