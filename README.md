# Simple PHP with MVC pattern.

# Folder Structure

- `config/`
    * `ActionLogger.php`
    * `Config.php`
    * `Handler.php`
    * `Logger.php`
    * `Routes.php`
- `controllers/`
     * `concerns/`
        * `Renderize.php`
    * `BaseController.php`
    * `HomeController.php`
    * `MessagesController.php`
    * `PostsController.php`
    * `SessionsController.php`
    * `UsersController.php`
- `db/`
    * `Connection.php`
- `helpers/`
    * `Auth.php`
    * `Cookie.php`
    * `Flashify.php`
    * `Redirect.php`
- `middlewares/`
    * `AuthMiddleware.php`
- `models/`
    * `concerns/`
        * `FieldsConcern.php`
    * `BaseModel.php`
    * `Message.php`
    * `Post.php`
    * `User.php`
- `views/`
    - `home/`
        * `index.php`
    - `users/`
        * `index.php`
        * `show.php`
        * `edit.php`
        * `new.php`
    - `messages/`
        * `index.php`
        * `show.php`
        * `edit.php`
    - `posts/`
        * `index.php`
        * `show.php`
        * `edit.php`
        * `mew.php`
    - `sessions/`
        * `signin.php`
        * `signup.php`
    * `footer.php`
    * `layout.php`
    * `menu.php`
* `index.php`
* `README.md`
