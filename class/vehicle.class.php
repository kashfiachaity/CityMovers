<?php 

Class Vehicle extends Database{
    static protected $tableName = "vehicle";
    static protected $dbColumns = ['id','user_id','name','image','experience_year','vehicle_type','price','isApproved'];

    public $id;
    public $user_id;
    public $name;
    public $image;
    public $experience_year;
    public $vehicle_type;
    public $price;
    public $isApproved;
    
    public const VehicleType = ['Truck', 'Pick Up', 'Van'];

    

    public function __construct($args=[])
    {
    // print_r($args['fileUpload']['uploadImage']['name']);
    // exit;
    $this->user_id = $args['vehicle']['user_id'] ?? '';
    $this->name = $args['vehicle']['name'] ?? '';
    $this->image = $args['fileUpload']['uploadImage']['name'] ?? '';
    $this->experience_year = $args['vehicle']['experience_year'] ?? '';
    $this->vehicle_type = $args['vehicle']['vehicle_type'] ?? '';
    $this->price = $args['vehicle']['price'] ?? '';
    $this->isApproved = $args['vehicle']['isApproved'] ?? '';


    }
    // will upload image file to server
    
    function uploadPhoto(){
        
        
        $result_message="";
       
            $target_dir = "uploads/";
            $fileName= basename($_FILES["uploadImage"]["name"]);
            $target_file = $target_dir . $fileName;
            
            $uploadOk = 1; //Flag 
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

            $file_upload_error_messages='';
    
            

            // make sure that file is a real image
            $check = getimagesize($_FILES["uploadImage"]["tmp_name"]);
            if($check!==false){
                // submitted file is an image
            }else{
                $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
            }
            
            // make sure certain file types are allowed
            $allowed_file_types=array("jpg", "jpeg", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
            }
            
            // make sure file does not exist
            if(file_exists($target_file)){
                $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
            }
            
            // make sure submitted file is not too large, can't be larger than 1 MB
            // if($_FILES['uploadImage']['size'] > (500000)){
            //     $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
            // }

            // if $file_upload_error_messages is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $target_file)){
                    // it means photo was uploaded
                }else{
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="<div>Unable to upload photo.</div>";
                        $result_message.="<div>Update the record to upload photo.</div>";
                    $result_message.="</div>";
                }
            }
            
            // if $file_upload_error_messages is NOT empty
            else{
                // it means there are some errors, so show them to user
                $result_message.="<div class='alert alert-danger'>";
                    $result_message.="{$file_upload_error_messages}";
                    $result_message.="<div>Update the record to upload photo.</div>";
                $result_message.="</div>";
            }
            
            return $result_message;
        }
        
    
    


    Public function validate() {
        $this->errors = [];
  
        if(is_blank($this->name)) {
            $this->errors[] = "Name of the Driver Name cannot be blank.";
        } elseif (!has_length($this->name, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Name of the Company must have at least 2 characters.";
        }

        if(is_blank($this->image)) {
            $this->errors[] = "Image cannot be blank.";
        }

        if(is_blank($this->experience_year)) {
            $this->errors[] = "Experience Year cannot be blank.";
        } elseif (!preg_match('/[0-9]/', $this->experience_year)) {
            $this->errors[] = "Experience Year input cannot contain Letter.";
        }

        if($this->vehicle_type == '0') {
            $this->errors[] = "Vehicle Type should  be Selected.";
        } 
        if(is_blank($this->price)) {
            $this->errors[] = "Price cannot be blank.";
        } elseif (!preg_match('/[0-9]/', $this->price)) {
            $this->errors[] = "Price input cannot contain Letter.";
        }
  
        return $this->errors;
    }
  
    
}

?>