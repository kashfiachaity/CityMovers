<?php
class Pricing extends Database {
    static protected $tableName = "pricing_details";
    static protected $dbColumns = ['id','distancePrice','roomPrice','officeAreaPrice','floorPrice'];

    public $id;
    public $distancePrice;
    public $roomPrice;
    public $officeAreaPrice;
    public $floorPrice;
    


    public function __construct($args=[])
    {
        
        $this->distancePrice = $args['distancePrice'] ?? '';
        $this->roomPrice = $args['roomPrice'] ?? '';
        $this->officeAreaPrice = $args['officeAreaPrice'] ?? '';
        $this->floorPrice = $args['floorPrice'] ?? '';
        


    }

    Public function validate() {
        $this->errors = [];
        

        if(is_blank($this->distancePrice)) {
            $this->errors[] = "Distance Price cannot be blank.";
        } elseif (!preg_match('/[0-9]/', $this->distancePrice)) {
            $this->errors[] = "Distance Price input cannot contain Letter.";
        }

        
        if(is_blank($this->roomPrice)) {
            $this->errors[] = "Room Price cannot be blank.";
        } elseif (!preg_match('/[0-9]/', $this->roomPrice)) {
            $this->errors[] = "Room Price input cannot contain Letter.";
        }

        if(is_blank($this->officeAreaPrice)) {
            $this->errors[] = "Office Area Price cannot be blank.";
        } elseif (!preg_match('/[0-9]/', $this->officeAreaPrice)) {
            $this->errors[] = "Office Area Price input cannot contain Letter.";
        }

        
        if(is_blank($this->floorPrice)) {
            $this->errors[] = "Floor Price cannot be blank.";
        } elseif (!preg_match('/[0-9]/', $this->floorPrice)) {
            $this->errors[] = "Floor Price input cannot contain Letter.";
        }
  
  
        return $this->errors;
    }

}



?>