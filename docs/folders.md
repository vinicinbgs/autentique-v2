---
title: Folders
layout: index
filename: folders
--- 
# 📁 Folders

### Import and Instance
```php
use vinicinbgs\Autentique\Folders;

$documents = new Folders(); // AUTENTIQUE_TOKEN in .env

// or

$token = "YOUR_ALTERNATIVE_TOKEN";
$documents = new Folders($token); // Alternative token
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
