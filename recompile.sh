#!/bin/bash

# Check if the OS is Windows
if [ "$(expr substr $(uname -s) 1 10)" = "MINGW32_NT" ] || [ "$(expr substr $(uname -s) 1 9)" = "CYGWIN_NT" ] || [ "$(expr substr $(uname -s) 1 5)" = "MSYS_NT" ]; then
    echo "Windows OS detected. Skipping permission-related commands."
else
    # Give permissions
    sudo chmod -R 0777 .
    sudo chown -R maneza:maneza .
fi

# Composer clean and run
composer dump
composer clearcache
composer install
composer update

# Give permissions again (if not on Windows)
if [ "$(expr substr $(uname -s) 1 10)" != "MINGW32_NT" ] && [ "$(expr substr $(uname -s) 1 9)" != "CYGWIN_NT" ] && [ "$(expr substr $(uname -s) 1 5)" != "MSYS_NT" ]; then
    sudo chmod -R 0777 .
    sudo chown -R maneza:maneza .
fi

# Run: sh recompile.sh to execute all those commands at once
