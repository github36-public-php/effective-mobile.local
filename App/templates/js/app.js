$(document).ready(function () {

// Показать все контакты.
    getAllContacts();

    // Добавить контакт.
    $("#add_contact_href").click(function (event) {
        event.preventDefault();

        var formData = {
            action: $("#action").val(),
            fio: $("#fio").val(),
            phone_number: $("#phone_number").val()
        };

        $.ajax({
            type: "POST",
            url: "classes/Router.php",
            data: formData,
            success: function (response) {
                $("#message").html(response);
                getAllContacts();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });


    // Удалить контакт (делегирование событий т.к. объекты созданы динамически)
    $(document).on("click", "a#delete_contact_href", function () {
        // Из DOM (более быстрый вариант).
        // $(this).closest("tr").remove();

        // Из файла.
        var id = $(this).attr('data-id');
        var formData = {
            action: 'deleteContact',
            id: id
        };

        $.ajax({
            type: "POST",
            url: "classes/Router.php",
            data: formData,
            success: function (response) {
                $("#message").html(response);
                getAllContacts();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });


});

// Показать все контакты.
function getAllContacts() {
    $.ajax({
        type: "POST",
        url: "classes/Router.php",
        data: {
            action: "getAllContacts",
        },
        success: function (response) {
            $("#contactsListTable").html(response);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}