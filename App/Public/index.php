<?php

$pdo = new PDO("sqlite:test.db");

$pdo->exec("CREATE TABLE test (id INTEGER PRIMARY KEY, name TEXT)");

$pdo->exec("INSERT INTO test (name) VALUES ('Julie')");

$result = $pdo->query("SELECT * FROM test");

foreach ($result as $row) {
    echo $row['name'];
}