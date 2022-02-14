<?php
//  
// Softwares Utilizados
//
// mysql-installer-community-8.0.28.0
// xampp-windows-x64-8.1.2-0-VS16-installer - PHP 8.1.2 
// Visual Studio Code 1.64.2
//
//

require ("db.php");


banco_de_dados::Criar_banco_dados();
banco_de_dados::Criar_Tabela_Cadastro();
banco_de_dados::Criar_Tabela_Produtos();
banco_de_dados::inserir_dados_produtos('111111','cueca','1','fornecedor');
banco_de_dados::inserir_dados_produtos('222222','meia','2','comum');
banco_de_dados::inserir_dados_produtos('333333','blusa','3','fornecedor');
banco_de_dados::inserir_dados_produtos('333333','vestido','3','fornecedor');
banco_de_dados::inserir_dados_produtos('333333','garrafa','3','fornecedor');
banco_de_dados::inserir_dados_produtos('444444','blusa','4','comum');
banco_de_dados::inserir_dados_produtos('555555','garrafa','3','fornecedor');
banco_de_dados::inserir_dados_produtos('666666','blusa','3','fornecedor');
banco_de_dados::inserir_dados_produtos('777777','garrafa','3','galpao');
banco_de_dados::inserir_dados_produtos('888888','blusa','3','galpao');
echo "'comum', '1111111111', 'Paulo Mário Drumond', '11111@oi.com','3123456'\n";
banco_de_dados::inserir_dados_Cadastro('comum', '1111111111', 'Paulo Mário Drumond', '11111@oi.com','3123456');
echo "'comum', '2222222222', 'Maitê Helena das Neves', '22222@oi.com','3123456'\n";
banco_de_dados::inserir_dados_Cadastro('comum', '2222222222', 'Maitê Helena das Neves', '22222@oi.com','3123456');
echo "'fornecedor', '3333333333', 'Lucas Yuri Melo', '33333@oi.com','3123456'\n";
banco_de_dados::inserir_dados_Cadastro('fornecedor', '3333333333', 'Lucas Yuri Melo', '33333@oi.com','3123456');
echo "'fornecedor', '4444444444', 'Osvaldo Roberto Manoel da Mata', '44444@oi.com','3123456'\n";
banco_de_dados::inserir_dados_Cadastro('fornecedor', '4444444444', 'Osvaldo Roberto Manoel da Mata', '44444@oi.com','3123456');
banco_de_dados::Select_id('333333');
banco_de_dados::Select_id('222222');
banco_de_dados::Transferencia('222222','fornecedor');
banco_de_dados::Select_id('222222');
banco_de_dados::Transferencia('222222','comum');
banco_de_dados::Select_id('222222');
banco_de_dados::Select_id('222222');

//------------------------------------------------------------
$CPF = "111111";
$Estoque_ = banco_de_dados::Estoque($CPF);
echo "Quantidade:" . $Estoque_ ."\n";

$tipo_de_usuario_ = banco_de_dados::tipo_de_usuario($CPF);
echo "Tipo Usuario:" . $tipo_de_usuario_."\n";

if ($Estoque_ >= 1 and $tipo_de_usuario_ === "fornecedor") {
    $Estoque_ = $Estoque_ + 1;
    banco_de_dados::Estoque_Update($CPF,$Estoque_);
    echo $Estoque_;
  }
//------------------------------------------------------------
//venda
if ($Estoque_ >= 1 and $tipo_de_usuario_ === "fornecedor") {
    $Estoque_ = $Estoque_ - 5;
    banco_de_dados::Estoque_Update($CPF,$Estoque_);
    echo $Estoque_;
  }
  //------------------------------------------------------------
 ?>