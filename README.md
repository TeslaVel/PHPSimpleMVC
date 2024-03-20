# Simple PHP with MVC pattern.

# Folder Structure

- `config/`
    * `routes.php`
    * `config.php`
- `db/`
    * `connection.php`
- `controllers/`
    * `BaseController.php`
    * `HomeController.php`
    * `MessagesController.php`
    * `UsersController.php`
- `models/`
    * `concerns/`
        * `FieldsConcern.php`
    * `BaseModel.php`
    * `MessageModel.php`
    * `UserModel.php`
- `helpers/`
    * `Flashify.php`
- `views/`
    - `users/`
        * `index.php`
        * `show.php`
        * `edit.php`
        * `new.php`
    - `messages/`
        * `index.php`
        * `show.php`
        * `edit.php`
        * `new.php`
    * `footer.php`
    * `layout.php`
    * `menu.php`
* `index.php`
* `README.md`
