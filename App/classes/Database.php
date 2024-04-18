<?php

namespace App\classes;

class Database
{
    private $databaseFilePath;
    private $databaseSequenceFilePath;

    public function __construct($databaseName)
    {
        $this->databaseFilePath = __DIR__ . '/../database/' . $databaseName . '.json';
        $this->databaseSequenceFilePath = __DIR__ . '/../database/' . $databaseName . '_sequence.json';
    }


    // Добавить новую запись.
    public function addRecord($fio, $phone_number)
    {
        // Получаем новый id для записи и данные из БД в виде массива.
        $id = $this->IncreaseId();

        // Загружать все данные для добавления 1 записи, не оптимально. Но в реальных проектах всё хранится в БД и CRUD делается запросами.
        // В тестовом примере загрузим все данные.
        $dataArray = $this->GetFileDataArray();

        // Создаем новую запись.
        $new_record = array(
            "id" => $id,
            "fio" => $fio,
            "phone_number" => $phone_number
        );

        $dataArray[] = $new_record;

        $this->SetFileDataArray($dataArray);

        return 1; // Возвращаем 1 в случае успеха (в тестовом примере всегда возвращаем 1, нет обработки ошибок).
    }


    // Удалить запись.
    public function deleteRecord($id)
    {
        $dataArray = $this->GetFileDataArray();

        foreach ($dataArray as $key => $record) {
            if ($record['id'] == $id) {
                unset($dataArray[$key]);
                break;
            }
        }
        $this->SetFileDataArray($dataArray);
    }


    // Получить все записи.
    public function getAllRecords()
    {
        $dataArray = $this->GetFileDataArray();
        // В тестовом задании немного нарушим MVC, смешав логику с оформлением (не будем писать шаблонизатор).
        $tr = "";
        foreach ($dataArray as $data) {
            $tr = $tr . "<tr data-id=\"$data[id]\"><td>$data[fio]</td><td>$data[phone_number]</td><td> <a class=\"href-button\" id=\"delete_contact_href\" data-id=\"$data[id]\">Удалить контакт</a></td></tr>";
        }
        return $tr;
    }


    // Получить новый id и записать его в БД database_sequence.
    private function IncreaseId()
    {
        $json_data = file_get_contents($this->databaseSequenceFilePath);
        $data = json_decode($json_data, true);
        $data['last_id']++;
        $json_data = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($this->databaseSequenceFilePath, $json_data);
        return $data['last_id'];
    }


    // Получить данные в виде массива из БД database.
    private function GetFileDataArray()
    {
        $json_data = file_get_contents($this->databaseFilePath);
        $data = json_decode($json_data, true);
        return $data;
    }

    // Сохранить все данные из массива в БД database.
    private function SetFileDataArray($dataArray)
    {
        $json_data = json_encode($dataArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($this->databaseFilePath, $json_data);
        return 1; // Возвращаем 1 в случае успеха (в тестовом примере всегда возвращаем 1, нет обработки ошибок, а при операциях ввода-вывода они часто встречаются).
    }
}