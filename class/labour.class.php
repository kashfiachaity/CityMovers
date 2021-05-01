<?php
class Labour extends Database {
    static protected $tableName = "labour";
    static protected $dbColumns = ['id','user_id','company_name','labour_number','labour_wages',];

    public $id;
    public $user_id;
    public $company_name;
    public $labour_number;
    public $labour_wages;
    public $isApproved;
    


    public function __construct($args=[])
    {
        
        $this->user_id = $args['user_id'] ?? '';
        $this->company_name = $args['company_name'] ?? '';
        $this->labour_number = $args['labour_number'] ?? '';
        $this->labour_wages = $args['labour_wages'] ?? '';
        
    }

    Public function validate() {
        $this->errors = [];
  
        if(is_blank($this->company_name)) {
            $this->errors[] = "Name of the Company Name cannot be blank.";
        } elseif (!has_length($this->company_name, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Name of the Company must have at least 2 characters.";
        }

        if(is_blank($this->labour_number)) {
            $this->errors[] = "Labor Number cannot be blank.";
        } elseif (!preg_match('/[0-9]/', $this->labour_number)) {
            $this->errors[] = "Labor Number input cannot contain Letter.";
        }

        if(is_blank($this->labour_wages)) {
            $this->errors[] = "Labour Wages cannot be blank.";
        } elseif (!preg_match('/[0-9]/', $this->labour_wages)) {
            $this->errors[] = "Labour Wages input cannot contain Letter.";
        }

  
        return $this->errors;
    }

}

?>