<?php
/*
 * Возможно, здесь была допущена ошибка, так как в задании указано, что в коде использутеся mysqli_connect и дублирование SQL,
 * но ни того, ни другого здесь не было. Могу предположить, что изначально использовался процедурный стиль для mysqli и задача
 * состояла в том, чтобы перевести код на ООП стиль. Для демонстрации знаний ООП я написал класс, оборачивающий работу с PDO
 */

class Database {
    private ?PDO $pdo = null;
    private string $logFile;
    public function __construct(string $db_host, string $db_name, string $db_user, string $db_password, string $logFile = "db.log")
    {
        $this->logFile = $logFile;
        try{
            $this->pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
        } catch (PDOException $e){
            $this->log("DB connection failed: {$e->getMessage()}");
        }
    }

    public function query(string $sql, array $params = []): array{
        if(is_null($this->pdo)){
            $this->log("No database connection while trying to execute a query");
            return [];
        }
        try{
            $st = $this->pdo->prepare($sql);
            $st->execute($params);
            return $st->fetchAll();
        } catch (PDOException $e){
            $this->log("Query failed: {$e->getMessage()}");
            return [];
        }
    }

    public function products(): array
    {
        return $this->query("SELECT * FROM product");
    }

    private function log(string $msg): void{
        file_put_contents($this->logFile, "$msg\n", FILE_APPEND);
    }
}

$db = new Database("localhost", "test", "root", "");
$products = $db->products();
foreach ($products as $product){
    echo "{$product['name']}\n";
}