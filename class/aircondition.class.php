<?php

class Aircondition extends Database {
    static protected $tableName = "aircondition";
    static protected $dbColumns = ['id','user_id','company_name','worker_number','per_worker_wages'];

    public $id;
    public $user_id;
    public $company_name;
    public $worker_number;
    public $per_worker_wages;
    public $isApproved;
    


    public function __construct($args=[])
    {
        
        $this->user_id = $args['user_id'] ?? '';
        $this->company_name = $args['company_name'] ?? '';
        $this->worker_number = $args['worker_number'] ?? '';
        $this->per_worker_wages = $args['per_worker_wages'] ?? '';
        


    }

    Public function validate() {
        $this->errors = [];
  
        if(is_blank($this->company_name)) {
            $this->errors[] = "Name of the Company Name cannot be blank.";
        } elseif (!has_length($this->company_name, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Name of the Company must have at least 2 characters.";
        }

        if(is_blank($this->worker_number)) {
            $this->errors[] = "Worker Number cannot be blank.";
        } elseif (!preg_match('/[0-9]/', $this->worker_number)) {
            $this->errors[] = "Worker Number input cannot contain Letter.";
        }

        if(is_blank($this->per_worker_wages)) {
            $this->errors[] = "Per Worker Wages cannot be blank.";
        } elseif (!preg_match('/[0-9]/', $this->per_worker_wages)) {
            $this->errors[] = "Per Worker Wages input cannot contain Letter.";
        }

  
        return $this->errors;
    }
  

}
?>