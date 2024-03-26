<?php
require_once "core/models/BaseModel.php";

class Post extends BaseModel {
  public static $name = 'posts';

  public static $validations = [
    'title' => 'required|string|min:4',
    'body' => 'required|string|min:4',
    // 'password' => 'required|string|min:8|confirmed',
  ];

  public static $fillableFields = Array(
    'title', 'body', 'created_at', 'updated_at', 'user_id'
  );
}