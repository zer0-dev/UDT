<?php
$db_host = "localhost";
$db_name = "test";
$db_user = "root";
$db_password = "";
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);

$filename = "product.csv";
$updated = 0;
$inserted = 0;
if($file = fopen($filename, "r")){
    fgetcsv($file, 1000, ';'); //skipping header
    while($data = fgetcsv($file, 1000, ';')){
        $parameters = ["name" => $data[0], "art" => $data[1], "price" => $data[2], "quantity" => $data[3]];

        $check_st = $pdo->prepare("SELECT COUNT(*) FROM product WHERE name = :name AND art = :art");
        $check_st->execute(["name" => $parameters["name"], "art" => $parameters["art"]]);
        if($check_st->fetchColumn() > 0){
            $update_st = $pdo->prepare("UPDATE product SET price = :price, quantity = :quantity WHERE name = :name AND art = :art");
            $update_st->execute($parameters);
            $updated += $update_st->rowCount();
        } else {
            $insert_st = $pdo->prepare("INSERT INTO product (name, art, price, quantity) VALUES (:name, :art, :price, :quantity)");
            $insert_st->execute($parameters);
            $inserted += $insert_st->rowCount();
        }
    }
} else {
    echo "Error opening file";
}
fclose($file);

echo "Updated $updated rows\nInserted $inserted rows";