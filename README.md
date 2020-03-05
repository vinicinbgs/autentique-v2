# 🚀 Usage
**Import library** `use vinicinbgs\Autentique\Documents;`

**Instance** `$documents = new Documents();`

#### 1 - Listar todos os Documentos
`$documents->listAll()`

#### 2 - Listar um Documento
`$documents->listById($documentId)`

#### 3 - Criar um Documento
`$attributes = [`<br>
     `'document' => [`<br>
         `'name' => 'Package Autentique V2'`<br>
     `],`<br>
     `'signers' => [`<br>
         `'email' => 'dutra_morais@hotmail.com',`<br>
         `'x' => '50',`<br>
         `'y' => '80',`<br>
         `'z' => '1'`<br>
     `],`<br>
     `'file' => '$filePath'`<br>
 `];`<br>
`$documents->create($attributes)`

#### 4 - Assinar um Documento
`$documents->signById()`

#### 5 - Deletar um Documento
`$documents->listAll()`