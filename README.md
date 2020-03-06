#### <span style="text-align: center">AUTENTIQUE Api v2</span>

[![Monthly Downloads](https://poser.pugx.org/vinicibgs/autentique-v2/d/monthly)](https://packagist.org/packages/vinicibgs/autentique-v2)
[![Daily Downloads](https://poser.pugx.org/vinicibgs/autentique-v2/d/daily)](https://packagist.org/packages/vinicibgs/autentique-v2)
[![Latest Version on Packagist](https://img.shields.io/badge/stable-1.0.0-brightgreen)](https://packagist.org/packages/vinicibgs/autentique-v2)
# 🚀 Usage
**Set file .env**
<pre>
AUTENTIQUE_URL=https://api.autentique.com.br/v2/graphql
AUTENTIQUE_TOKEN=YOURTOKEN
AUTENTIQUE_DEV_MODE=true || false
# IF TRUE, DOCUMENT CREATE IN MODE SANDBOX
</pre>

**Import library** `use vinicinbgs\Autentique\Documents;`

**Instance** `$documents = new Documents();`
]
#### 1 - Listar todos os Documentos
`$documents->listAll();`

#### 2 - Listar um Documento
`$documents->listById($documentId);`

#### 3 - Criar um Documento
<pre>$attributes = [
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
 ];
 
 $documents->create($attributes);
 </pre>

#### 4 - Assinar um Documento
`$documents->signById($documentId);`

#### 5 - Deletar um Documento
`$documents->deleteById($documentId);`