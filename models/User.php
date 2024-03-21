<?php
require_once "BaseModel.php";
class User extends BaseModel {

  public static $name = 'users';

  public static $fillableFields = [
    'first_name', 'last_name', 'created_at', 'updated_at', 'email', 'password'
  ];
}
