---
title: Folders
layout: index
filename: folders
--- 
# Import and Instance
```php
use vinicinbgs\Autentique\Documents;

$AUTENTIQUE_TOKEN="xxxxxxxx" (set or will be take in .env)

$folders = new Folders($AUTENTIQUE_TOKEN);
```

Why documents/folders receive token?
- Easily to manage Documents in multiples accounts (token)


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
