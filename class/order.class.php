<?php
class Order extends Database {
    static protected $tableName = "orders";
    static protected $dbColumns = ['id','user_id','houseNo','roadNo','postCode','city','isCompleted'];

    public $id;
    public $user_id;
    public $houseNo;
    public $roadNo;
    public $postCode;
    public $city;
    public $isCompleted;

    
    


    public function __construct($args=[])
    {
        
        $this->user_id = $args['user_id'] ?? '';
        $this->houseNo = $args['houseNo'] ?? '';
        $this->roadNo = $args['roadNo'] ?? '';
        $this->postCode = $args['postCode'] ?? '';
        $this->city = $args['city'] ?? '';
        $this->isCompleted = $args['isCompleted'] ?? '';
        


    }
    Public function validate() {
        $this->errors = [];
  

        if(is_blank($this->houseNo)) {
            $this->errors[] = "House Number cannot be blank.";
        } 

        if(is_blank($this->roadNo)) {
            $this->errors[] = "Road Number cannot be blank.";
        } elseif (!preg_match('/[0-9]/', $this->roadNo)) {
            $this->errors[] = "Road Number input cannot contain Letter.";
        }
        if(is_blank($this->postCode)) {
            $this->errors[] = "Post Code cannot be blank.";
        } elseif (!preg_match('/[0-9]/', $this->postCode)) {
            $this->errors[] = "Post Code input cannot contain Letter.";
        }
        if(is_blank($this->city)) {
            $this->errors[] = "Name of the City cannot be blank.";
        } elseif (!has_length($this->city, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Name of the City must have at least 2 characters.";
        }

  
        return $this->errors;
    }

}



?>