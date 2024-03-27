<?php
require_once "core/models/BaseModel.php";

class User extends BaseModel {

  public static $name = 'users';

  public static $validations = [
    'first_name' => 'required|string|min:4',
    'last_name' => 'required|string|min:4',
    'email' => 'required|string|email',
    // 'password' => 'required|string|min:8|confirmed',
  ];

  public static $fillableFields = [
    'first_name', 'last_name', 'created_at', 'updated_at', 'email', 'password'
  ];

  public function posts() {
    return $this->hasMany(Post::class, 'user_id', 'id');
  }

  public function messages() {
    return $this->hasMany(Message::class, 'user_id', 'id');
  }
}
