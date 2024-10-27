---
title: Home
layout: index
filename: /index
--- 
#### AUTENTIQUE Api v2

[![Latest Stable Version](https://img.shields.io/packagist/v/vinicinbgs/autentique-v2)](https://packagist.org/packages/vinicinbgs/autentique-v2)
[![Total Downloads](https://poser.pugx.org/vinicinbgs/autentique-v2/downloads)](https://packagist.org/packages/vinicinbgs/autentique-v2)
[![codecov](https://codecov.io/gh/vinicinbgs/autentique-v2/branch/master/graph/badge.svg)](https://codecov.io/gh/vinicinbgs/autentique-v2)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vinicinbgs/autentique-v2/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/vinicinbgs/autentique-v2/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/vinicinbgs/autentique-v2/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![License](https://poser.pugx.org/vinicinbgs/autentique-v2/license)](https://packagist.org/packages/vinicinbgs/autentique-v2)

# Getting Started

This package is so simple to use that will save your time!

```bash
composer require vinicinbgs/autentique-v2
```

### 1) Set `.env` file

```sh
AUTENTIQUE_URL="https://api.autentique.com.br/v2/graphql"
AUTENTIQUE_TOKEN="YOUR_TOKEN"
AUTENTIQUE_DEV_MODE="true" # set "true" for SANDBOX MODE or "false" to PRODUCTION MODE
```

If you not able to use environment variables, you can set it directly in `(Documents | Folders) instance`:

```php
use vinicinbgs\Autentique\Utils\Api;
use vinicinbgs\Autentique\Documents;

$api = new Api('https://api.autentique.com.br/v2/graphql', 100);
$document = new Documents($token);
$document->setApi($api); // use only if you want to change the default timeout 60 seconds
$document->setSandbox("true"); // string. "true"|"false"
```

### 2) API's

- [1) Documents](./documents)
  - [List pagination](./documents#1---list-all-documents-with-pagination)
  - [List by id](./documents#2---list-the-document-by-id)
  - [Create](./documents#3---create-a-document)
  - [Update](./documents#4---update-document)
  - [Sign](./documents#5---sign-the-document-by-id)
  - [Delete](./documents#6---delete-the-document-by-id)
  - [Move to folder](./documents#7---move-document-to-folder)
  - [Move between folders](./documents#8---move-document-between-folders)
  - [Create signer](./documents#9---create-signer-to-document)
  - [Remove signer](./documents#10---remove-signer-from-document)
  
- [2) Folders](./folders)
  - [List pagination](./folders#1---list-all-folders)
  - [List by id](./folders#2---list-the-folder-by-id)
  - [Create](./folders#3---create-a-folder)
  - [List contents](./folders#4---list-the-folder-contents-by-id)
  - [Delete](./folders#5---delete-a-folder)


---

# Contribute

```sh
git clone git@github.com:vinicinbgs/autentique-v2.git
cd autentique-v2
make contribute
```

### Configure prettier php in vscode (optional)

1. `(CTRL + P)` 
2. `> Preferences: Open Setting (JSON)`

```json
 "emeraldwalk.runonsave": {
        "commands": [
            {
                "match": "\\.php$",
                "cmd": "npm run prettier -- ${relativeFile} --write",
            },
        ]
    }
```

## TODO

Check: [https://altair.autentique.com.br/](https://altair.autentique.com.br/)

### 1) Queries
- [ ] me
- [ ] organization
- [ ] organizations
- [ ] groupsByOrganization
- [ ] documentsByFolder
- [ ] emailTemplates

### 2) Mutations
- [ ] moveDocumentToRoot
- [ ] transferDocument

## Tests
The tests are _**integrated directly with Autentique API**_, so you need to set your `.env` file based on `.env.example` Make sure you have set the `AUTENTIQUE_TOKEN`, `AUTENTIQUE_URL` and `AUTENTIQUE_DEV_MODE` to `true` for `SANDBOX MODE` or `false` to `PRODUCTION MODE`.

```bash
composer test
composer test -- --filter ApiTest
```


