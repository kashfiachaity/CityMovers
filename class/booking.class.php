<?php
class Booking extends Database {
    static protected $tableName = "bookinginformation";
    static protected $dbColumns = ['id','presentAddress','newAddress','distance','movingDate','type','houseTypeDetails','officeAreaOne','officeAreaTwo','presentFloor','newFloor'];

    public $id;
    public $presentAddress;
    public $newAddress;
    public $distance;
    public $movingDate;
    public $type;
    public $houseTypeDetails;
    public $officeAreaOne;
    public $officeAreaTwo;
    public $presentFloor;
    Public $newFloor;


    public function __construct($args=[])
    {
        
        $this->presentAddress = $args['presentAddress'] ?? '';
        $this->newAddress = $args['newAddress'] ?? '';
        $this->distance = $args['distance'] ?? '';
        $this->movingDate = $args['movingDate'] ?? '';
        $this->type = $args['type'] ?? '';
        $this->houseTypeDetails = $args['houseTypeDetails'] ?? '';
        $this->officeAreaOne = $args['officeAreaOne'] ?? '';
        $this->officeAreaTwo = $args['officeAreaTwo'] ?? '';
        $this->presentFloor = $args['presentFloor'] ?? '';
        $this->newFloor = $args['newFloor'] ?? '';


    }

    Public function validate() {
        $this->errors = [];
  
        if(is_blank($this->presentAddress)) {
            $this->errors[] = "Present Address cannot be blank.";
        } elseif (!has_length($this->presentAddress, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Present Address must have at least 2 characters.";
        }

        if(is_blank($this->newAddress)) {
            $this->errors[] = "New Address cannot be blank.";
        } elseif (!has_length($this->newAddress, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Present Address must have at least 2 characters.";
        }

        if($this->presentAddress === $this->newAddress){
            $this->errors[] = "Two Address cannot be Same.";
        }

        if(is_blank($this->movingDate)) {
            $this->errors[] = "Date cannot be blank.";
        } elseif ($this->movingDate < date("Y-m-d")) {
            $this->errors[] = "Previous date cannot be selected";
        }


        if($this->type === '') {
            $this->errors[] = "Type should  be Selected..";
        }
        if($this->presentFloor === '0') {
            $this->errors[] = "Present Floor should  be Selected..";
        }
        if($this->newFloor === '0') {
            $this->errors[] = "New Floor should  be Selected..";
        }

  
        return $this->errors;
    }

}



?>