<?php
class User extends Database {
    static protected $tableName = "user";
    static protected $dbColumns = ['id','name','phone','email','hashed_password','userRole'];

    public $id;
    public $name;
    public $phone;
    public $email;
    public $password;
    protected $hashed_password;
    public $userRole;
    protected $password_required = true;

    public const UserRole = ['Cutomer', 'Labour', 'Vehicle', 'AC', 'Electrician'];
    


    public function __construct($args=[])
    {
        
        $this->name = $args['name'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->userRole = $args['userRole'] ?? '';

    }

    Public function validate() {
      $this->errors = [];

      if(is_blank($this->name)) {
          $this->errors[] = "Name cannot be blank.";
      } elseif (!has_length($this->name, array('min' => 2, 'max' => 255))) {
          $this->errors[] = "Name must have at least 2 characters.";
      }

     if (is_blank($this->email)) {
          $this->errors[] = "Email cannot be blank.";
      }

      if(is_blank($this->phone)) {
          $this->errors[] = "Phone Number cannot be blank.";
      } elseif (!has_length($this->phone, array('min' => 11, 'max' => 11))) {
          $this->errors[] = "Phone Number Must be 11 Digit";
      }elseif (!preg_match('/[0-9]/', $this->phone)) {
          $this->errors[] = "Phone Number Must Be in number";
      }elseif (!has_unique_phone($this->phone, $this->id ?? 0)) {
        $this->errors[] = "Phone is Already in Use. Try another.";
    }


      if($this->password_required) {
          if(is_blank($this->password)) {
              $this->errors[] = "Password cannot be blank.";
          } elseif (!has_length($this->password, array('min' => 6))) {
              $this->errors[] = "Password must contain 6 or more characters";
          } elseif (!preg_match('/[a-z]/', $this->password)) {
              $this->errors[] = "Password must contain at least 1 letter";
          } elseif (!preg_match('/[0-9]/', $this->password)) {
              $this->errors[] = "Password must contain at least 1 number";
          } 

      }

      return $this->errors;
  }

    protected function set_hashed_password() {
        $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
      }
    
      public function verify_password($password) {
        return password_verify($password, $this->hashed_password);
      }
    
      protected function create() {
        $this->set_hashed_password();
        return parent::create();
      }
    
      protected function update() {
        if($this->password != '') {
          $this->set_hashed_password();
          // validate password
        } else {
          // password not being updated, skip hashing and validation
          $this->password_required = false;
        }
        return parent::update();
      }


      static public function find_by_phone($phone) {
        $sql = "SELECT * FROM " . static::$tableName . " ";
        $sql .= "WHERE phone='" . self::$database->escape_string($phone) . "'";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }

}



?>