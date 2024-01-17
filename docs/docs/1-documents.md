---
title: Documents
layout: index
filename: /docs/1-documents
permalink: documents
---

# 📄 Documents

> To use SANDBOX Documents is necessary set the environment variable `AUTENTIQUE_DEV_MODE="true"` in `.env` file or set `setSandbox("true")` in Documents instance.

### Import and (3-Ways of Instancing)

1) Using environment variables
```php
use vinicinbgs\Autentique\Documents;

$documents = new Documents(); // AUTENTIQUE_TOKEN in .env
```

2) Passing token in constructor

```php
use vinicinbgs\Autentique\Documents;

$token = "YOUR_ALTERNATIVE_TOKEN";
$documents = new Documents($token); // Alternative token
```

3) Setting Api instance (url and timeout) and sandbox mode `("true" | "false")` in **Documents instance**

```php
use vinicinbgs\Autentique\Utils\Api;
use vinicinbgs\Autentique\Documents;

$api = new Api('https://api.autentique.com.br/v2/graphql', 100);
$document = new Documents($token);
$document->setApi($api) // use only if you want to change the default timeout 60 seconds
$document->setSandbox("true") // string. "true"|"false"
```

### 1 - List all documents with pagination

```php
$documentsPaginated = $documents->listAll($page);
// if not isset $page is equal 1
```

### 2 - List the document by id

```php
$document = $documents->listById($documentId);
```

### 3 - Create a document

Fields required/optional

```php
$attributes = [
    "organization_id" => "1000", // (optional, remove the field if you not using)
    "document" => [
        // Document (required)
        "name" => "(string)",
    ],
    "signers" => [
        [
            // Signer 1 (required)
            "email" => "(string)",
            "action" => "SIGN",
            "positions" => [
                [
                    "x" => "50", // Position of Axios X of Signature (0 a 100)
                    "y" => "85", // Position of Axios Y of Signature (0 a 100)
                    "z" => "1", // Page of Signature
                ],
                [
                    "x" => "50", // Position of Axios X of Signature (0 a 100)
                    "y" => "85", // Position of Axios X of Signature (0 a 100)
                    "z" => "2", // Page of Signature
                ],
            ],
        ],
        [
            // Other Signer (optional)
            "email" => "(string)",
            "action" => "SIGN",
            "positions" => [
                [
                    "x" => "50", // Position of Axios X of Signature (0 a 100)
                    "y" => "80", // Position of Axios Y of Signature (0 a 100)
                    "z" => "1", // Page of Signature
                ],
                [
                    "x" => "50", // Position of Axios X of Signature (0 a 100)
                    "y" => "80", // Position of Axios X of Signature (0 a 100)
                    "z" => "2", // Page of Signature
                ],
            ],
        ],
    ],
    "file" => "./dummy.pdf", // Path of file (required),
];

$documentCreated = $documents->create($attributes);
```

### 4 - Update document

```php
$attributes = [
    "document" => [
      "name" => "NOME_DOCUMENTO",
      "message" => "Mensagem customizada enviada para os emails dos signatários",
      "reminder" => "WEEKLY",
      "sortable" => true,
      "footer" => "BOTTOM",
      "refusable" => true,
      "new_signature_style" => true,
      "show_audit_page" => false,
      "ignore_cpf" => true,
      "email_template_id" => 1234,
      "deadline_at" => "2023-11-24T02:59:59.999Z",
      "cc" => [
        [ "email" => "email-cc-1@tuamaeaquelaursa.com" ],
        [ "email" => "email-cc-2@tuamaeaquelaursa.com" ]
      ],
      "expiration" => {
        "days_before" => 7,
        "notify_at" => "20/01/2026"
    }
]

$documentUpdated = $document->update($documentId, $attributes);
```

### 5 - Sign the document by id

```php
$documentSign = $documents->signById($documentId);
```

### 6 - Delete the document by id

```php
$documentDeleted = $documents->deleteById($documentId);
```

### 7 - Move document to folder

```php
$documents->moveToFolder($documentId, $folderId);
```

### 8 - Move document between folders

```php
$documents->moveToFolderByFolder($documentId, $targetFolderId, $currentFolderId);
```

### 9 - Create Signer to document

Check fields [here](https://docs.autentique.com.br/api/mutations/adicionar-signatario)

```php
$attributes = [
    "name" => "",
    "email" => "",
    "action" => "SIGN",
    "phone"=> "",
    "delivery_method" => "EMAIL",
    "positions" => [
        [
            "x" => "50", // Position of Axios X of Signature (0 a 100)
            "y" => "85", // Position of Axios Y of Signature (0 a 100)
            "z" => "1", // Page of Signature
        ],
        [
            "x" => "50", // Position of Axios X of Signature (0 a 100)
            "y" => "85", // Position of Axios X of Signature (0 a 100)
            "z" => "2", // Page of Signature
        ],
    ],
    "configs" => [
        "cpf"=> ""
    ]
];

$documents->createSigner($documentId, $attributes);
```

### 10 - Remove Signer from document

```php
$documents->deleteSigner($documentId, $signerPublicId);
```