---
title: Folders
layout: index
filename: /docs/folders
permalink: folders
--- 
# 📁 Folders

### Import and (3-Ways of Instancing)

1) Using environment variables
```php
use vinicinbgs\Autentique\Folders;

$folders = new Folders(); // AUTENTIQUE_TOKEN in .env
```

2) Passing token in constructor

```php
use vinicinbgs\Autentique\Folders;

$token = "YOUR_ALTERNATIVE_TOKEN";
$folders = new Folders($token); // Alternative token
```

3) Setting Api instance (url and timeout) and sandbox mode `("true"|"false")` in **Folders instance**

```php
use vinicinbgs\Autentique\Utils\Api;
use vinicinbgs\Autentique\Folders;

$api = new Api('https://api.autentique.com.br/v2/graphql', 100);
$folders = new Folders($token);
$folders->setApi($api) // use only if you want to change the default timeout 60 seconds
$folders->setSandbox("true") // string. "true"|"false"
```

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
