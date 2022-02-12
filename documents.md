---
title: Documents
layout: index
filename: documents
--- 
# Import and Instance
```php
use vinicinbgs\Autentique\Documents;

$AUTENTIQUE_TOKEN="xxxxxxxx" (set or will be take in .env)

$documents = new Documents($AUTENTIQUE_TOKEN);
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
