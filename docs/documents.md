---
title: Documents
layout: index
filename: documents
--- 
# 📝 Documents

> To use `SANDBOX Documents` is necessary set the environment variable `AUTENTIQUE_SANDBOX=true` in `.env` file.

### Import and Instance
```php
use vinicinbgs\Autentique\Documents;

$documents = new Documents(); // AUTENTIQUE_TOKEN in .env

// or

$token = "YOUR_ALTERNATIVE_TOKEN";
$documents = new Documents($token); // Alternative token
```

> **Why documents/folders receive token?**  
> Easily to manage Documents in multiples autentique accounts (tokens) in same project.

### 1 - List all documents with pagination

```php
$documentsPaginated = documents->listAll($page); 
// if not isset $page is equal 1
```

### 2 - List the document by id

```php
$document = $documents->listById($documentId);
```

---

### 3 - Create a document
Fields required/optional
```php
    $attributes = [
         'document' => [ // Document (required)
             'name' => '(string)',
         ],
         'signers' => [
             [ // Signer 1 (required)
                 'email' => '(string)',
                 'action' => 'SIGN',
                 'positions' => [
                     [
                         'x' => '(string)', // Position of Axios X of Signature (0 a 100)
                         'y' => '(string)', // Position of Axios Y of Signature (0 a 100)
                         'z' => '(string)', // Page of Signature
                     ],
                     [
                         'x' => '(string)',  // Position of Axios X of Signature (0 a 100)
                         'y' => '(string)',  // Position of Axios X of Signature (0 a 100)
                         'z' => '(string)',  // Page of Signature
                     ],
                 ],
             ],
             [ // Other Signer (optional)
                 'email' => '(string)',
                 'action' => 'SIGN',
                 'positions' => [
                     [
                         'x' => '(string)', // Position of Axios X of Signature (0 a 100)
                         'y' => '(string)', // Position of Axios Y of Signature (0 a 100)
                         'z' => '(string)', // Page of Signature
                     ],
                     [
                         'x' => '(string)',  // Position of Axios X of Signature (0 a 100)
                         'y' => '(string)',  // Position of Axios X of Signature (0 a 100)
                         'z' => '(string)', // Page of Signature
                     ],
                 ],
             ],
         ],
         'file' => '(string)' // Path of file (required),
     ];
```


**Usage:**
```php
$attributes = [
         'document' => [
             'name' => 'Rent Contract',
         ],
         'signers' => [
             [
                 'email' => 'landlord@email.com',
                 'action' => 'SIGN',
                 'positions' => [
                     [
                         'x' => '50',
                         'y' => '80',
                         'z' => '1',
                     ],
                     [
                         'x' => '50',
                         'y' => '50',
                         'z' => '2',
                     ],
                 ],
             ],
             [
                 'email' => 'tentant@email.com',
                 'action' => 'SIGN',
                 'positions' => [
                     [
                         'x' => '50',
                         'y' => '80',
                         'z' => '1',
                     ],
                     [
                         'x' => '50',
                         'y' => '50',
                         'z' => '2',
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

---

### 5 - Delete the document by id

```php
$documentDeleted = $documents->deleteById($documentId);
```
