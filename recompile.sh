# give permissions
sudo chmod -R 0777 .

# composer clean and run
composer clearcache
composer dump-autoload
composer install
composer update

# give permitions again
sudo chmod -R 0777 .
sudo chown -R maneza:maneza .

# run: sh recompile.sh to run all those commands at once