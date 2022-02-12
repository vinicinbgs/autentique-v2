#### AUTENTIQUE Api v2

[![Latest Stable Version](https://img.shields.io/packagist/v/vinicinbgs/autentique-v2)](https://packagist.org/packages/vinicinbgs/autentique-v2)
[![Total Downloads](https://poser.pugx.org/vinicinbgs/autentique-v2/downloads)](https://packagist.org/packages/vinicinbgs/autentique-v2)
[![Build Status](https://travis-ci.org/vinicinbgs/autentique-v2.svg?branch=master)](https://travis-ci.org/vinicinbgs/autentique-v2)
[![codecov](https://codecov.io/gh/vinicinbgs/autentique-v2/branch/master/graph/badge.svg)](https://codecov.io/gh/vinicinbgs/autentique-v2)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vinicinbgs/autentique-v2/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/vinicinbgs/autentique-v2/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/vinicinbgs/autentique-v2/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![License](https://poser.pugx.org/vinicinbgs/autentique-v2/license)](https://packagist.org/packages/vinicinbgs/autentique-v2)

# 🚀 Usage

## This package is so simple to use that it will save your time.

```bash
phpcomposer require vinicinbgs/autentique-v2
```

## ⚠️ IMPORTANT

This library depends on **vlucas/phpdotenv** to get environments variables **(.env)** <br>
If you use a framework like **Laravel**, you don't need to download this library.

```bash
composer require vlucas/phpdotenv
```

**Set in file .env**

```env
AUTENTIQUE_URL=https://api.autentique.com.br/v2/graphql
AUTENTIQUE_TOKEN="YOUR_TOKEN"
AUTENTIQUE_DEV_MODE="true" || "false"
# if TRUE, document will be created in mode sandbox
```

# Instance
**Import library**

```php
use vinicinbgs\Autentique\Documents;

$AUTENTIQUE_TOKEN="xxxxxxxx" (set or will be take in .env)

$documents = new Documents($AUTENTIQUE_TOKEN);

$folders = new Folders($AUTENTIQUE_TOKEN);
```

Why documents/folders receive token?
- Easily to manage Documents in multiples accounts (token)

# 📝 Documents
### 1 - List all documents with pagination

```php
$documentsPaginated = documents->listAll($page); // if not isset $page is equal 1
```

### 2 - List the document by id

```php
$document = $documents->listById($documentId);
```

### 3 - Create a document

```php
$attributes = [
         'document' => [
             'name' => 'NOME DO DOCUMENTO',
         ],
         'signers' => [
             [
                 'email' => 'email@email.com',
                 'action' => 'SIGN',
                 'positions' => [
                     [
                         'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
                         'y' => '80', // Posição do Eixo Y da ASSINATURA (0 a 100)
                         'z' => '1', // Página da ASSINATURA
                     ],
                     [
                         'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
                         'y' => '50', // Posição do Eixo Y da ASSINATURA (0 a 100)
                         'z' => '2', // Página da ASSINATURA
                     ],
                 ],
             ],
             [
                 'email' => 'email@email.com',
                 'action' => 'SIGN',
                 'positions' => [
                     [
                         'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
                         'y' => '80', // Posição do Eixo Y da ASSINATURA (0 a 100)
                         'z' => '1', // Página da ASSINATURA
                     ],
                     [
                         'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
                         'y' => '50', // Posição do Eixo Y da ASSINATURA (0 a 100)
                         'z' => '2', // Página da ASSINATURA
                     ],
                 ],
             ],
         ],
         'file' => './dummy.pdf',
     ];
 
 $documentCreated = $documents->create($attributes);
 ```

### 4 - Sign the document by id

```php
$documentSign = $documents->signById($documentId);
```

### 5 - Delete the document by id

```php
$documentDeleted = $documents->deleteById($documentId);
```


# 📁 Folders
### 1 - List all folders

```php
$foldersPaginated = folders->listAll($page); // if not isset $page is equal 1
```

### 2 - List the folder by id

```php
$folder = $folders->listById($folderId);
```

### 3 - Create a folder

```php
$attributes = [
    "folder" => [
                "name" => "folder name",
            ],
];
 
$folder = $folders->create($attributes);
 ```

### 4 - List the folder contents by id

```php
$folderContents = $folders->listContentsById($folderId, $page = 1);
```

### 5 - Delete a folder

```php 
$folderDeleted = $folders->deleteById($folderId);
```
# 🔧 Contributing

### 💻 Setup

```sh
git clone git@github.com:vinicinbgs/autentique-v2.git
cd autentique-v2
composer install
npm install
```

### ⚙️ Configure

#### Create .env with variables

```sh
./contribute.sh
```

#### Configure prettier php in vscode

(CTRL + P) > Preferences: Open Setting (JSON)

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
