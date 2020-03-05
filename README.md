# 🚀 Usage
**Import library** `use vinicinbgs\Autentique\Documents;`

**Instance** `$documents = new Documents();`

#### 1 - Listar todos os Documentos
`$documents->listAll()`

#### 2 - Listar um Documento
`$documents->listById($documentId)`

#### 3 - Criar um Documento
$attributes = [
     'document' => [
         'name' => 'Package Autentique V2'
     ],
     'signers' => [
         'email' => 'dutra_morais@hotmail.com',
         'x' => '50',
         'y' => '80',
         'z' => '1'
     ],
     'file' => '$filePath'
 ];<br>
`$documents->create($attributes)`

#### 4 - Assinar um Documento
`$documents->signById()`

#### 5 - Deletar um Documento
`$documents->listAll()`