<?php

class Student{
    
    private $name;
    private $studentId;
    protected $address;//accessible in the classes
    CONST numCourses = 5; //cannot be overrident, no $
    
    //final methods CANNOT be overrident in subclass
    final public function __get($prop) {
        return $this->$prop;
    }
    
    public function __set($prop, $value) {
        $this->$prop = $value;
    }
    
    //constructor
    public function __construct($name, $studentId) {
        $this->studentId = $studentId;
        $this->name =  $name;
    }
    
    public function __destruct() {
        echo "OBJECT DESTROYED <br>";
    }
    
    public static function PrintSchool(){
        echo "NBCC <br>"; //static method
    }
    
  //  public abstract function SomeMethod(); //abstract method can only go in abstract class
}

?>
