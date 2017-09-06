<?php
class Student
{
    private $conn;
    function __construct() {
    session_start();
    $servername = "localhost";
    $dbname = "crud";
    $username = "root";
    $password = "";
  

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
       }else{
        $this->conn=$conn;  
       }

    }


    public function student_list(){
        
       $sql = "SELECT * FROM students ORDER BY student_id asc ";
       $result=  $this->conn->query($sql);
       return $result;  
    }
    
    public function create_student_info($post_data=array()){
         
       if(isset($post_data['create_student'])){
       $student_name= mysqli_real_escape_string($this->conn,trim($post_data['student_name']));
       $email_address= mysqli_real_escape_string($this->conn,trim($post_data['email_address']));
       $gender= mysqli_real_escape_string($this->conn,trim($post_data['gender']));
       $contact= mysqli_real_escape_string($this->conn,trim($post_data['contact']));
       $country= mysqli_real_escape_string($this->conn,trim($post_data['country']));

       $sql="INSERT INTO students (student_name, email_address, contact,country,gender) VALUES ('$student_name', '$email_address', '$contact','$country','$gender')";
        
        $result=  $this->conn->query($sql);
        
           if($result){
           
               $_SESSION['message']="Successfully Created Student Info";
               
              header('Location: index.php');
           }
          
       unset($post_data['create_student']);
       }
       
        
    }
    
    public function view_student_by_student_id($id){
       if(isset($id)){
       $student_id= mysqli_real_escape_string($this->conn,trim($id));
      
       $sql="Select * from students where student_id='$student_id'";
        
       $result=  $this->conn->query($sql);
     
        return $result->fetch_assoc(); 
    
       }  
    }
    
    
    public function update_student_info($post_data=array()){
       if(isset($post_data['update_student'])&& isset($post_data['id'])){
           
       $student_name= mysqli_real_escape_string($this->conn,trim($post_data['student_name']));
       $email_address= mysqli_real_escape_string($this->conn,trim($post_data['email_address']));
       $gender= mysqli_real_escape_string($this->conn,trim($post_data['gender']));
       $contact= mysqli_real_escape_string($this->conn,trim($post_data['contact']));
       $country= mysqli_real_escape_string($this->conn,trim($post_data['country']));
       $student_id= mysqli_real_escape_string($this->conn,trim($post_data['id']));

       $sql="UPDATE students SET student_name='$student_name',email_address='$email_address',contact='$contact',country='$country',gender='$gender' WHERE student_id =$student_id";
     
        $result=  $this->conn->query($sql);
        
           if($result){
               $_SESSION['message']="Successfully Updated Student Info";
           }
       unset($post_data['update_student']);
       }   
    }
    
    public function delete_student_info_by_id($id){
        
       if(isset($id)){
       $student_id= mysqli_real_escape_string($this->conn,trim($id));

       $sql="DELETE FROM  students  WHERE student_id =$student_id";
        $result=  $this->conn->query($sql);
        
           if($result){
               $_SESSION['message']="Successfully Deleted Student Info";
            
           }
       }
         header('Location: index.php'); 
    }
    function __destruct() {
    mysqli_close($this->conn);  
    }
    
}

?>