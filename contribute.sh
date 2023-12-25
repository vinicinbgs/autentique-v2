#!/bin/sh

# Set .env filename
echo 'What is the name of the file (press enter to .env)?'
read filename

if [ -z "$filename" ]; then
    filename=".env"
fi

# Set AUTENTIQUE_TOKEN
echo 'What is the AUTENTIQUE TOKEN value?'
read autentique_token

if [ -z "$autentique_token" ]; then
    autentique_token="YOUR_ACCOUNT_TOKEN_AUTENTIQUE"
fi

# Write in file
echo "AUTENTIQUE_URL=\"https://api.autentique.com.br/v2/graphql\"
AUTENTIQUE_TOKEN=\"${autentique_token}\"
AUTENTIQUE_DEV_MODE=\"true\"" >> $filename

cp phpunit.xml.dist phpunit.xml

# Node Dependencies (package.json)
npm install

# PHP Dependencies (composer.json)
composer install

# Ruby Dependencies (Gemfile)
bundle install

# PHP Documentor
curl https://github.com/phpDocumentor/phpDocumentor/releases/download/v3.4.3/phpDocumentor.phar -o phpDocumentor.phar

echo '✅ Done'