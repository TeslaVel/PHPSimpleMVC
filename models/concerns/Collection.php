<?php
trait Collection {

  protected $collection = [];

  public function add($item) {
    $this->collection[] = $item;
  }

  public function remove($item) {
    unset($this->collection[$item]);
  }

  public function removeAll($item) {
    unset($this->collection);
  }

  public function get() {
    return $this->collection;
  }

  public function first($number = 1) {
    // return array_slice($this->collection, 0, $number);
    return $this->collection[0];
  }

  public function last($number = 1) {
    // return array_slice($this->collection, -1 * $number, $number);
    return end($this->collection);
  }

  public function all() {
    return $this->collection;
  }

  public function collect($array) {
    // $data = array_map(function ($arr, $index) {
    //   $className = get_called_class();
    //   $obj = $index === 0 ? $this : new $className();
    //   $obj->object = $arr;
    //   return $obj;
    // }, $array, array_keys($array));

    array_walk($array, function ($arr, $index) {
      $className = get_called_class();
      $obj = $index === 0 ? $this : new $className();
      $obj->object = $arr;
      self::add($obj);
    });

    return $this;
  }

  // public function find($id) {
  //   return parent::find($id);
  // }

  // public function save($data) {
  //   return parent::save($data);
  // }

  // public function update($data) {
  //   return parent::update($data);
  // }

  public static function __callStatic($method, $args) {
    echo "Intercepted static method is " . $method . "<br>";
    echo "Intercepted static args <br>";
    print_r($args);
    exit;
  }
}