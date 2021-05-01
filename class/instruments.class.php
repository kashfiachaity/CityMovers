<?php 

Class Instruments extends Database{
    static protected $tableName = "moving_instruments";
    static protected $dbColumns = ['id','instruments_name','instruments_image','quantity','instruments_price'];

    public $id;
    public $instruments_name;
    public $instruments_image;
    public $quantity;
    public $instruments_price;
    
    


    

    public function __construct($args=[])
    {
    $this->instruments_name = $args['instruments']['instruments_name'] ?? '';
    $this->instruments_image = $args['fileUpload']['upimage']['name'] ?? '';
    $this->quantity = $args['instruments']['quantity'] ?? '';
    $this->instruments_price = $args['instruments']['instruments_price'] ?? '';
    
    


    }
    // will upload image file to server
    function uploadPhoto(){
    
        
        $result_message="";
       
        $target_dir = "uploads/";
        $fileName= basename($_FILES["upimage"]["name"]);
        $target_file = $target_dir . $fileName;
        
        $uploadOk = 1; //Flag 
        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

        $file_upload_error_messages='';
  
        

        // make sure that file is a real image
        $check = getimagesize($_FILES["upimage"]["tmp_name"]);
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
            if(move_uploaded_file($_FILES["upimage"]["tmp_name"], $target_file)){
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
        
        if(is_blank($this->instruments_name)) {
            $this->errors[] = "Name of the Intruments Name cannot be blank.";
        } elseif (!has_length($this->instruments_name, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Name of the Intruments must have at least 2 characters.";
        }

        if(is_blank($this->instruments_image)) {
            $this->errors[] = "Image cannot be blank.";
        }

        if(is_blank($this->quantity)) {
            $this->errors[] = "Quantity cannot be blank.";
        } elseif (!preg_match('/[0-9]/', $this->quantity)) {
            $this->errors[] = "Quantity input cannot contain Letter.";
        }

        
        if(is_blank($this->instruments_price)) {
            $this->errors[] = "Instrument Price cannot be blank.";
        } elseif (!preg_match('/[0-9]/', $this->instruments_price)) {
            $this->errors[] = "Instrument Price input cannot contain Letter.";
        }
  
        return $this->errors;
    }
  
    
}

?>