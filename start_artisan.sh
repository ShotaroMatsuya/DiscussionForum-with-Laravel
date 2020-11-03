#!/bin/sh
cd /home/users/2/candypop.jp-wispy-moji-9349/web/lara-forum/
/usr/local/php/7.3/bin/php artisan cache:clear
/usr/local/php/7.3/bin/php artisan schedule:run >> /dev/null 2>&1
