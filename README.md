Entwickler Dokumentation:
To install this module via composer you need to execute the following commands in you root directory.

```
composer config repositories.testa github https://github.com/icecream-testa/blog_netz98.git
composer require icecream-testa/blog_netz98:dev-main
bin/magento setup:upgrade
```

Uninstall Module
To clean out the database run the following queries
```
DELETE FROM setup_module WHERE module = 'Testa_Blog'; 
DELETE FROM cms_page WHERE identifier = 'devblog'; 
DELETE FROM url_rewrite WHERE request_path = 'devblog'"
```
