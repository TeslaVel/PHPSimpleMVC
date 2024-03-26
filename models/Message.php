<?php
require_once "core/models/BaseModel.php";

class Message extends BaseModel {

  public static $name = 'messages';
  public static $validations = [
    'message' => 'required|string|min:4',
    'user_id' => 'required',
    'post_id' => 'required',
  ];

  public static $fillableFields = Array(
    'message', 'created_at', 'updated_at', 'user_id', 'post_id'
  );
}