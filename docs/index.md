---
title: Home
layout: index
filename: index
--- 
#### AUTENTIQUE Api v2

[![Latest Stable Version](https://img.shields.io/packagist/v/vinicinbgs/autentique-v2)](https://packagist.org/packages/vinicinbgs/autentique-v2)
[![Total Downloads](https://poser.pugx.org/vinicinbgs/autentique-v2/downloads)](https://packagist.org/packages/vinicinbgs/autentique-v2)
[![Build Status](https://travis-ci.org/vinicinbgs/autentique-v2.svg?branch=master)](https://travis-ci.org/vinicinbgs/autentique-v2)
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

### 2) API's

- [1) Documents](./documents)
  - [List pagination](./documents#1---list-all-documents-with-pagination)
  - [List by id](./documents#2---list-the-document-by-id)
  - [Create](./documents#3---create-a-document)
  - [Sign](./documents#4---sign-a-document)
  - [Delete](./documents#5---delete-the-document-by-id)
  
- [2) Folders](./folders)
  - [List pagination](./folders#1---list-all-folders)
  - [List by id](./folders#2---list-the-folder-by-id)
  - [Create](./folders#3---create-a-folder)
  - [List contents](./folders#4---list-the-folder-contents-by-id)
  - [Delete](./folders#5---delete-a-folder)


---

# Contribute

### 1) Setup

```sh
git clone git@github.com:vinicinbgs/autentique-v2.git
```

### 2) Configure

```sh
cd autentique-v2
sh ./contribute.sh
```

### 3) Configure prettier php in vscode (optional)

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
