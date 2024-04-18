<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Телефонный справочник</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv=Content-Type content="text/html;charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="templates/css/app.css">

    <script src="templates/js/jquery/jquery-3.7.1.min.js"></script>
    <script src="templates/js/app.js"></script>


</head>
<body>
<div id="message"></div>
<div class="wrapper">
    <div class="main-page">

        <div id="contactsList" class="contacts-list-container">
            <table id="contactsListTable"><tbody>
            </tbody></table>
        </div>


        <form id="contactForm">

            <input type="hidden" id="action" value="addContact">


            <div class="contact-form__fio-label-container align-items-center ">
                Фамилия Имя Отчество
            </div>

            <div class="contact-form__fio-text-container align-items-center ">
                <input type="text" name="fio" id="fio" class="text-field input-field">
            </div>


            <div class="contact-form__phone-number-container align-items-center ">
                Номер телефона
            </div>

            <div class="contact-form__phone-number-text-container align-items-center ">
                <input type="tel" name="phone_number" id="phone_number" class="text-field input-field">
            </div>


            <div class="contact-form__submit-href-container">
                <a class="href-button" id="add_contact_href">Добавить контакт</a>
            </div>

        </form>


    </div>
</div>
</body>
</html>