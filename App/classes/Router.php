<?php

namespace App\classes;
$config = require_once __DIR__ . '/../config.php';
$databaseName = $config['database_name'];

require_once __DIR__ . '/Database.php';


// Роутер.
// Получаем данные.
$action = $_POST['action'];
$fio = $_POST['fio'] ?? null;
$phone_number = $_POST['phone_number'] ?? null;
$id = $_POST['id'] ?? null;

// TODO В роутере должна быть обязательная фильтрация-проверка передаваемых данных выше на спецсимволы, возможные инъекции и т.д.

$database = new Database($databaseName);

// Добавить контакт.
if ($action == 'addContact') {
    $database->addRecord($fio, $phone_number);
}

// Удалить контакт.
if ($action == 'deleteContact') {
    $database->deleteRecord($id);
}

// Получить все контакты.
if ($action == 'getAllContacts') {
    echo $database->getAllRecords();
}