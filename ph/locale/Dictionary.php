<?php

namespace ph\locale;

class Dictionary {

    private static $lexicon = array(
        "ru" => array(
            "Ph_Button_View" => "Подробнее",
            "Ph_Button_Edit" => "Редактировать",
            "Ph_Button_Delete" => "Удалить",
            "Ph_Button_Add" => "Добавить",
            "Ph_Button_Save" => "Сохранить",
            "Ph_Button_Cancel" => "Отмена",

            "Ph_NavBar_Users" => "Пользователи",
            "Ph_NavBar_Themes" => "Темы",
            "Ph_NavBar_Login" => "Вход",
            "Ph_NavBar_Logout" => "Выход",

            "Ph_Message_Welcome" => "Добро пожаловать в панель администрирования",
            "Ph_Message_Error" => "Ошибка",
            "Ph_Message_UnknownError" => "Неизвестная ошибка сервера",

            "Ph_Message_User_IdNotFound" => "Пользователь с таким ID не найден",
            "Ph_Message_User_Added" => "Пользователь '#{login}' успешно добавлен",
            "Ph_Message_User_Updated" => "Пользователь '#{login}' сохранен",
            "Ph_Message_User_DeleteConfirmation" => "Вы уверены, что хотите удалить пользователя '#{login}' ?",
            "Ph_Message_User_Deleted" => "Пользователь '#{login}' удален",
            "Ph_Message_User_DeleteCurrentUser" => "Вы не можете удалить текущего пользователя",
            "Ph_Message_User_EmptyLogin" => "Логин не может быть пустым",
            "Ph_Message_User_ExistingLogin" => "Пользователь с логином '#{login}' уже существует",
            "Ph_Message_User_EmptyName" => "Имя не может быть пустым",
            "Ph_Message_User_EmptyPassword" => "Пароль не может быть пустым",
            "Ph_Message_User_PasswordNotConfirmed" => "Пароли не совпадают",
            "Ph_Message_User_EmptyRole" => "Пользователь должен иметь роль",
            "Ph_Message_User_Password_Updated" => "Пароль пользователя успешно изменен",
            "Ph_Message_Auth_WrongLoginPassword" => "Неправильный логин или пароль",
            "Ph_Message_Auth_UserLoggedIn" => "Пользователь '#{login}' вошёл",

            "Ph_Message_Theme_ThemeChanged" => "Тема '#{name}' успешно сохранена",
            "Ph_Message_Theme_ThemeRestored" => "Тема по умолчанию '#{name}' восстановлена",
            "Ph_Message_Theme_ThemeNotFound" => "Тема '#{name}' не найдена",

            "Ph_Message_Catalog_IdNotFound" => "Каталог с таким ID не найден",
            "Ph_Message_Catalog_Updated" => "Каталог '#{name}' сохранен",
            "Ph_Message_Catalog_DescriptionUpdated" => "Описание каталога сохранено",
            "Ph_Message_Catalog_EmptyName" => "Имя каталога не может быть пустым",
            "Ph_Message_Catalog_EmptyUrl" => "URL каталога не может быть пустым",
            "Ph_Message_Catalog_ExistingUrl" => "Каталог с URL '#{url}' уже существует",
            "Ph_Message_Catalog_PriorityOutOfBounds" => "Приоритет каталога должен являться числом от 0 до 99",
            "Ph_Message_Catalog_ImageNotUploaded" => "Не выбрано изображение или его размер превышает допустимое значение",
            "Ph_Message_Catalog_InvalidImageFormat" => "Файл изображения иммет неправильный формат",
            "Ph_Message_Catalog_ImageUploadError" => "Ошибка при загрузке изображения",
            "Ph_Message_Catalog_ImageSaved" => "Изображение каталога сохранено",
            "Ph_Message_Catalog_Added" => "Каталог '#{name}' успешно добавлен",
            "Ph_Message_Catalog_DeleteConfirmation" => "Вы уверены, что хотите удалить каталог '#{name}' ?",
            "Ph_Message_Catalog_Deleted" => "Каталог '#{name}' успешно удален",

            "Ph_Message_Product_IdNotFound" => "Товар с таким ID не найден",
            "Ph_Message_Product_TableCreated" => "Таблица товаров успешно создана",
            "Ph_Message_Product_TableDeleted" => "Таблица товаров успешно удалена",
            "Ph_Message_Product_TableNotFound" => "Таблица товаров не найдена данного каталога",
            "Ph_Message_Product_EmptyName" => "Имя товара не может быть пустым",
            "Ph_Message_Product_PriorityOutOfBounds" => "Приоритет товара должен являться числом от 0 до 99",
            "Ph_Message_Product_Added" => "Товар '#{name}' успешно добавлен",
            "Ph_Message_Product_Updated" => "Товар '#{name}' сохранен",
            "Ph_Message_Product_Deleted" => "Товар '#{name}' успешно удален",
            "Ph_Message_Product_DeleteConfirmation" => "Вы уверены, что хотите удалить товар '#{name}' каталога '#{catalogName}' ?",
            "Ph_Message_Product_ImageNotUploaded" => "Не выбрано изображение или его размер превышает допустимое значение",
            "Ph_Message_Product_InvalidImageFormat" => "Файл изображения иммет неправильный формат",
            "Ph_Message_Product_ImageUploadError" => "Ошибка при загрузке изображения",
            "Ph_Message_Product_ImageSaved" => "Изображение товара сохранено",
            "Ph_Message_Product_PriceConverted" => "Цена товара '#{name}' пересчитана с учетом курса доллара сайта",
            "Ph_Message_Product_CatalogPricesConverted" => "Цены всех товаров каталога '#{name}' пересчитаны с учетом курса доллара сайта",
            "Ph_Message_Product_AllPricesConverted" => "Цены всех товаров сайта пересчитаны с учетом курса доллара сайта",

            "Ph_Message_Currency_Saved" => "Курсы валют сохранены",

            "Ph_Message_SpecialOffer_Deleted" => "Специальное предложение удалено",

            "Ph_User_Name" => "Имя",
            "Ph_User_Login" => "Логин",
            "Ph_User_Role" => "Роль",
            "Ph_User_Role_Guest" => "Гость",
            "Ph_User_Role_Admin" => "Администратор",
            "Ph_User_Password" => "Пароль",
            "Ph_User_PasswordConfirm" => "Подтвердите пароль",

            "Ph_User_Index_Button_AddUser" => "Добавить пользователя",

            "Ph_User_Add_Button_ViewAllUsers" => "Все пользователи",
            "Ph_User_Add_FormTitle" => "Добавить пользователя",

            "Ph_User_Show_Button_ViewAllUsers" => "Все пользователи",

            "Ph_User_Edit_Button_ViewAllUsers" => "Все пользователи",
            "Ph_User_Edit_FormTitle" => "Редактировать пользователя",
            "Ph_User_Edit_FormButton_EditPassword" => "Изменить пароль",

            "Ph_User_EditPassword_Button_ViewAllUsers" => "Все пользователи",
            "Ph_User_EditPassword_FormTitle" => "Изменить пароль пользователя",

            "Ph_Theme_Index_CurrentTheme" => "Текущая тема",
            "Ph_Theme_Index_Button_Change" => "Поменять тему",
            "Ph_Theme_Index_Button_SetDefault" => "Восстановить по умолчанию",

            "Ph_Theme_Change_FormTitle" => "Выбор темы",
            "Ph_Theme_Change_FormLabel_Theme" => "Тема",

            "Ph_Auth_Index_FormTitle" => "Введите Ваш логин и пароль",
            "Ph_Auth_Index_FormButton_Enter" => "Войти"
        ),
        "en" => array(
            "Ph_Button_View" => "View",
            "Ph_Button_Edit" => "Edit",
            "Ph_Button_Delete" => "Delete",
            "Ph_Button_Add" => "Add",
            "Ph_Button_Save" => "Save",
            "Ph_Button_Cancel" => "Cancel",

            "Ph_NavBar_Users" => "Users",
            "Ph_NavBar_Themes" => "Themes",
            "Ph_NavBar_Login" => "Login",
            "Ph_NavBar_Logout" => "Logout",

            "Ph_Message_Welcome" => "Welcome to phAdmin console",

            "Ph_Message_User_IdNotFound" => "User with such ID was not found",
            "Ph_Message_User_Added" => "User '#{login}' successfully added",
            "Ph_Message_User_Updated" => "User '#{login}' successfully updated",
            "Ph_Message_User_DeleteConfirmation" => "Are you sure you want to permanently delete user '#{login}' ?",
            "Ph_Message_User_Deleted" => "User '#{login}' successfully deleted",
            "Ph_Message_User_DeleteCurrentUser" => "You can not delete current user",
            "Ph_Message_User_EmptyLogin" => "Login is empty",
            "Ph_Message_User_ExistingLogin" => "User with login '#{login}' already exist",
            "Ph_Message_User_EmptyName" => "Name is empty",
            "Ph_Message_User_EmptyPassword" => "Password is empty",
            "Ph_Message_User_PasswordNotConfirmed" => "Password fields are not identical",
            "Ph_Message_User_EmptyRole" => "User must have a role",
            "Ph_Message_User_Password_Updated" => "User password changed",
            "Ph_Message_Auth_WrongLoginPassword" => "Wrong credentials",
            "Ph_Message_Auth_UserLoggedIn" => "User '#{login}' logged in",

            "Ph_Message_Theme_ThemeChanged" => "Theme '#{name}' successfully changed",
            "Ph_Message_Theme_ThemeRestored" => "Default theme '#{name}' successfully restored",
            "Ph_Message_Theme_ThemeNotFound" => "Theme '#{name}' not found",

            "Ph_User_Name" => "Name",
            "Ph_User_Login" => "Login",
            "Ph_User_Role" => "Role",
            "Ph_User_Role_Guest" => "Guest",
            "Ph_User_Role_Admin" => "Admin",
            "Ph_User_Password" => "Password",
            "Ph_User_PasswordConfirm" => "Confirm password",

            "Ph_User_Index_Button_AddUser" => "Add user",

            "Ph_User_Add_Button_ViewAllUsers" => "View all users",
            "Ph_User_Add_FormTitle" => "Add new user",

            "Ph_User_Show_Button_ViewAllUsers" => "View all users",

            "Ph_User_Edit_Button_ViewAllUsers" => "View all users",
            "Ph_User_Edit_FormTitle" => "Edit user",
            "Ph_User_Edit_FormButton_EditPassword" => "Edit password",

            "Ph_User_EditPassword_Button_ViewAllUsers" => "View all users",
            "Ph_User_EditPassword_FormTitle" => "Edit user password",

            "Ph_Theme_Index_CurrentTheme" => "Current theme",
            "Ph_Theme_Index_Button_Change" => "Change theme",
            "Ph_Theme_Index_Button_SetDefault" => "Set default theme",

            "Ph_Theme_Change_FormTitle" => "Change theme",
            "Ph_Theme_Change_FormLabel_Theme" => "Theme",

            "Ph_Auth_Index_FormTitle" => "Enter your login and password",
            "Ph_Auth_Index_FormButton_Enter" => "Enter"
        )
    );

    public static function getLexicon() {
        return self::$lexicon;
    }
}
