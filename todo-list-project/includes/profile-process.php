<?php

$profile_edit_error = [];
if(isset($_POST['edit_profile'])){
    $name       = isset($_POST['first_name']) ? db_escape($_POST['first_name']) : '';

    $family     = isset($_POST['last_name']) ? db_escape($_POST['last_name']) : '';

    $phone      = isset($_POST['phone']) ? db_escape($_POST['phone']) : '';

    $birthdate  = isset($_POST['birthdate']) ? db_escape($_POST['birthdate']) : '';


 if( mb_strlen( $name, 'uft_8') < 2 ){
    $profile_edit_error[] = 'نام حداقل باید دو کاراکتر باشد';
 }

 if( mb_strlen( $family, 'uft_8') < 2 ){
    $profile_edit_error[] = 'نام خانوادگی حداقل باید دو کاراکتر باشد';
 }

 if( strlen($phone) != 11 ){
    $profile_edit_error[] = 'تلفن باید 11 کاراکتر باشد ';
 }elseif( ! ctype_digit($phone)){
    $profile_edit_error[] = ' تلفن فقط باید شامل اعداد انگلیسی باشد' ;
 }

 if(! $birthdate){
    $profile_edit_error[] = 'تاریح تولد را وارد کنید';  
 }elseif( ! strtotime($birthdate)){
    $profile_edit_error[] = 'تاریخ تولد را صحیح وارد کنید ';
 }

 $profile_image = '';

 if (  isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK){
    
        $upload_dir = 'uploads/profiles/'. date('Y/m/');
      if( ! file_exists($upload_dir)){
        mkdir( directory:$upload_dir , recursive:true);
    }
    
    $file_info = pathinfo($_FILES['photo']['name']);
    $extension = strtolower($file_info['extension']);

    if(  in_array( $extension , ['jpg', 'png'])){

    $file_name = generate_random_string(15) . '.' . $file_info['extension'];

    $file_path = $upload_dir . $file_name ; 
 
    $moved  = move_uploaded_file( $_FILES['photo']['tmp_name'], $file_path);
    
    if($moved){
        $profile_image = $file_path ;
    }else{
        $profile_edit_error[]= 'خطا در  انتفال تصویر  شاخض';
    }
    }else{
     $profile_edit_error [] = 'تنها مجاز به بارگذاری تصویر jpg و png هستید ' ;
    }

 }

 if( empty( $profile_edit_error )){

   $new_data =  [
        'name '     => $name , 
        'family'    => $family,
        'phone'     => $phone,
        'birthdate' => $birthdate
   ];

   if($profile_image){
    $new_data['photo'] = $profile_image ;
   }

   $updated =  db_update(
        'users',
       $new_data,
        [
            'ID' => get_current_user_id()
        ]
    );

    if($updated || $updated === 0 ){
        redirect('profile.php?updated=true');
    }else{
        $profile_edit_error[] = 'بروزرسانی حساب کاربری با خطا روبرو شد';
    }
}
}

$password_error = [] ;
if(isset($_POST['change_password'])){

    $old_password   = isset($_POST['old_password']) ? db_escape($_POST['old_password'])  : '' ;
    $new_password   = isset($_POST['new_password']) ? db_escape($_POST['new_password'])  : '' ;
    $new_repassword = isset($_POST['new_repassword']) ? db_escape($_POST['new_repassword'])  : '' ;

    if(! $old_password){
        $password_error[] = 'گذرواژه قبلی را وارد کنید ';
    }

    $user = current_user() ;
    if( ! user_login($user['username'] , $old_password )){
       $password_error[] = 'گذرواژه قبلی شما درست نیست ' ;
    }

    if($user['password'] == my_hash_password($new_password)){
        $password_error [] = 'گذرواژه شما باید جدید باشد' ;
    }

    if(strlen($new_password) < 8 ){
       $password_error[] = 'حداقل گذرواژه باید 8 کاراکتر باشد ';
    }

    if( ! $new_password = $new_repassword){
        $password_error[] = 'گذرواژه ها یکی نیستند ';
    }

    if(ctype_digit($new_password)){
        $password_error[] = 'از کاراکتر هم استفاده کنید' ;
    }

    if(empty($password_error)){
        
      $updated =db_update( 
        'users' ,
        [
           'password' => my_hash_password($new_password)
        ],
        [
          'ID' => get_current_user_id()
        ]
    );

    if($updated){
        redirect('change-password.php?changed=true');
    }else{
        $password_error[] = 'خطا در تغییر گذرواژه' ;
    }

  }

}


