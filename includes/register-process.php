<?php
$register_error = '';
if(isset($_POST['register'])){
 
   $username   = isset($_POST['username'])? db_escape (trim($_POST['username'])) : '' ;
   $password   = isset($_POST['password'])? db_escape($_POST['password']) : ''; 

   $name       = isset($_POST['name']) ? db_escape($_POST['name']) :'' ;

    if (strlen($username) < 8 || strlen($password) < 8 ){
     $register_error = 'نام کاربری و رمز ورود خداقل باید 8 کاراکتر باشد' ;
    }else{
        $result = mysqli_query(db(), "SELECT * FROM users WHERE username = '$username'");
    if($result->num_rows){
     $register_error = 'نام کاربری' . $username . 'از قبل وجود دارد' ;
    }else{
      
     $user_id =  db_insert('users',[
       'username'      => $username,
       'password'      => my_hash_password($password),
       'name'          => $name,
       'register_date' => date('Y-m-d H:i:s')   
     ]);

     
     if($user_id){
        redirect('login.php?registered=true');
     }else{
        $register_error = 'خطا در ثبت نام . با پشتیبانی تماس بگیرید .';
     }
    }
  }  

}