<?php

  $servername = "localhost";
  $username = "root";
  $password = "toor"; 
  $dbname = "myDB";

class banco_de_dados
{ 
  static public function Criar_banco_dados() { 
    global $servername;
    global $username;
    global $password;    
    global $dbname;

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }    
    // Create database
    $sql = "CREATE DATABASE $dbname";
    if (mysqli_query($conn, $sql)) {
      echo "Database created successfully\n";
    } else {
      echo "Error creating database: " . mysqli_error($conn);
    }    
    mysqli_close($conn);     
  } 
  //------------------------------------
  static public function Criar_Tabela_Cadastro() {  
    global $servername;
    global $username;
    global $password;
    global $dbname;  

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // sql to create table
    $sql = "CREATE TABLE Cadastro (
    tipo_de_usuario VARCHAR(30) NOT NULL,
    CPF_CNPJ VARCHAR(30) NOT NULL,
    Nome_Completo VARCHAR(30) NOT NULL,
    e_mail VARCHAR(30) NOT NULL,
    Senha VARCHAR(30) NOT NULL,
    CONSTRAINT UC_Cadastro UNIQUE (CPF_CNPJ,e_mail)
    )";

    if ($conn->query($sql) === TRUE) {
      echo "Table Cadastro created successfully\n";
    } else {
      echo "Error creating table: " . mysqli_error($conn);
    }
    mysqli_close($conn); 
  } 
  //------------------------------------   
  static public function Criar_Tabela_Produtos() {  
    global $servername;
    global $username;
    global $password;  
    global $dbname;  

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . mysqli_connect_error());
    }
    // sql to create table
    $sql = "CREATE TABLE produtos (
    CPF_CNPJ VARCHAR(30) NOT NULL,
    produto VARCHAR(30) NOT NULL,
    quantidade VARCHAR(30) NOT NULL,
    tipo_de_usuario VARCHAR(30) NOT NULL
    )";
    if ($conn->query($sql) === TRUE) {
      echo "Table Produtos created successfully\n";
    } else {
      echo "Error creating table: " . mysqli_error($conn);
    }
    mysqli_close($conn); 
  }
//------------------------------------
static public function inserir_dados_produtos($CPF_CNPJ, $produto, $quantidade,$tipo_de_usuario) {  
  global $servername;
  global $username;
  global $password;  
  global $dbname;  

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
  }
  // sql to create table
  $sql = "INSERT INTO produtos (CPF_CNPJ, produto, quantidade, tipo_de_usuario)
  VALUES ('$CPF_CNPJ', '$produto', '$quantidade','$tipo_de_usuario')";

  if ($conn->query($sql) === TRUE) {
    echo "Inserir Dados Produtos\n";
  } else {
    echo "Error ao Inserir:" . mysqli_error($conn);
  }
  mysqli_close($conn); 
}
//------------------------------------
static public function inserir_dados_Cadastro($tipo_de_usuario,$CPF_CNPJ,$Nome_Completo,$e_mail,$Senha) {  
  global $servername;
  global $username;
  global $password;  
  global $dbname;  

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
  }
  // sql to create table
  $sql = "INSERT INTO Cadastro (tipo_de_usuario, CPF_CNPJ, Nome_Completo, e_mail, Senha)
  VALUES ('$tipo_de_usuario', '$CPF_CNPJ', '$Nome_Completo','$e_mail' ,'$Senha')";

  if ($conn->query($sql) === TRUE) {
    echo "Inserir Dados Cadastro\n";
  } else {
    echo "Error ao Inserir:" . mysqli_error($conn);
  }
  mysqli_close($conn); 
}
//------------------------------------
static public function Select_id($ID_) { 
  global $servername;
  global $username;
  global $password;  
  global $dbname;  

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT CPF_CNPJ, produto, quantidade, tipo_de_usuario FROM produtos WHERE CPF_CNPJ='$ID_'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "CPF_CNPJ: " . $row["CPF_CNPJ"]. " - produto: " . $row["produto"]. " " . $row["quantidade"]. " " . $row["tipo_de_usuario"]. "\n";
    }
  } else {
    echo "0 results";
}
$conn->close();
}
//------------------------------------
static public function Transferencia($ID_,$Tipo) { 
  global $servername;
  global $username;
  global $password;  
  global $dbname;  
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $sql = "UPDATE produtos SET tipo_de_usuario='$Tipo' WHERE CPF_CNPJ='$ID_'";
  if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully\n";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
  mysqli_close($conn);
}
//------------------------------------  
static public function Estoque($ID_) { 
  global $servername;
  global $username;
  global $password;  
  global $dbname;  

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT CPF_CNPJ, produto, quantidade, tipo_de_usuario FROM produtos WHERE CPF_CNPJ='$ID_'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      //echo "quantidade: " . $row["quantidade"]. "\n";
      return $row["quantidade"];
    }
  } else {
    echo "0 results";
}
$conn->close();
}
//------------------------------------   
static public function tipo_de_usuario($ID_) { 
  global $servername;
  global $username;
  global $password;  
  global $dbname;  

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT CPF_CNPJ, produto, quantidade, tipo_de_usuario FROM produtos WHERE CPF_CNPJ='$ID_'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      //echo "quantidade: " . $row["quantidade"]. "\n";
      return $row["tipo_de_usuario"];
    }
  } else {
    echo "0 results";
}
$conn->close();
}
//------------------------------------ 
static public function Estoque_Update($ID_,$valor) { 
  global $servername;
  global $username;
  global $password;  
  global $dbname;  
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $sql = "UPDATE produtos SET quantidade='$valor' WHERE CPF_CNPJ='$ID_'";
  if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully\n";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
  mysqli_close($conn);
}
//------------------------------------  

}
?>