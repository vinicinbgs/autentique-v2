#### <span style="text-align: center">AUTENTIQUE Api v2</span>
[![Latest Stable Version](https://poser.pugx.org/vinicinbgs/autentique-v2/v/stable)](https://packagist.org/packages/vinicinbgs/autentique-v2)
[![Total Downloads](https://poser.pugx.org/vinicinbgs/autentique-v2/downloads)](https://packagist.org/packages/vinicinbgs/autentique-v2)
[![Build Status](https://travis-ci.org/vinicinbgs/autentique-v2.svg?branch=master)](https://travis-ci.org/vinicinbgs/autentique-v2)
[![codecov](https://codecov.io/gh/vinicinbgs/autentique-v2/branch/master/graph/badge.svg)](https://codecov.io/gh/vinicinbgs/autentique-v2)
# 🚀 Usage
<pre>composer install vinicinbgs/autentique-v2</pre>

**Set file .env**
<pre>
AUTENTIQUE_URL=https://api.autentique.com.br/v2/graphql
AUTENTIQUE_TOKEN=YOURTOKEN
AUTENTIQUE_DEV_MODE=true || false
# IF TRUE, DOCUMENT CREATE IN MODE SANDBOX
</pre>

**Import library** `use vinicinbgs\Autentique\Documents;`

**Instance** <pre>$documents = new Documents($AUTENTIQUE_TOKEN);</pre>

#### 1 - Listar todos os Documentos
`$documents->listAll();`

#### 2 - Listar um Documento
`$documents->listById($documentId);`

#### 3 - Criar um Documento
<pre>$attributes = [
         'document' => [
             'name' => 'NOME DO DOCUMENTO'
         ],
         'signers' => [
             'email' => 'EMAIL-QUEM-VAI-ASSINAR@hotmail.com',
             'positions' => [
                 [
                    'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100) 
                    'y' => '80', // Posição do Eixo Y da ASSINATURA (0 a 100)
                    'z' => '1' // Página da ASSINATURA
                 ],
                 [
                    'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
                    'y' => '50', // Posição do Eixo Y da ASSINATURA (0 a 100)
                    'z' => '2' // Página da ASSINATURA
                 ]
             ]
         ],
         'file' => 'C:\Users\vinicinbgs\Downloads\Arquivo.pdf'
     ];
 
 $documents->create($attributes);
 </pre>

#### 4 - Assinar um Documento
`$documents->signById($documentId);`

#### 5 - Deletar um Documento
`$documents->deleteById($documentId);`