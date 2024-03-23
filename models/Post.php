<?php
require_once "BaseModel.php";

class Post extends BaseModel {
  public static $name = 'posts';
  // protected $object;

  public static $fillableFields = Array(
    'title', 'body', 'created_at', 'updated_at', 'user_id'
  );
}