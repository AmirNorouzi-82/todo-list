<?php
$page_name = 'profile';
$profile_edit_error = [];
?>
<?php include('partial/header.php') ; ?>
   <?php 
   $user = current_user();
   ?>
   <?php include('partial/sidebar.php') ; ?> 
   <main>
        <h1>ویرایش حساب کاربری</h1>
        <?php foreach($profile_edit_error as $error): ?>  
        <div class="message error">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"><path d="m14 16.16-3.96-3.96M13.96 12.24 10 16.2M10 6h4c2 0 2-1 2-2 0-2-1-2-2-2h-4C9 2 8 2 8 4s1 2 2 2Z" stroke="#FF8A65" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M16 4.02c3.33.18 5 1.41 5 5.98v6c0 4-1 6-6 6H9c-5 0-6-2-6-6v-6c0-4.56 1.67-5.8 5-5.98" stroke="#FF8A65" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            <p><?php echo $error;?></p>
        </div><!--.message-->
        <?php endforeach ;?>
        <?php if(isset($_GET['updated'])) : ?>
        <div class="message success">
            <svg xmlns="http://www.w3.org/2000/svg" width="19.5" height="21.5" viewBox="0 0 19.5 21.5">
                <g id="clipboard-tick" transform="translate(-2.25 -1.25)">
                    <path id="Path_84" data-name="Path 84" d="M10.81,16.95a.75.75,0,0,1-.53-.22l-1.5-1.5A.75.75,0,1,1,9.841,14.17l.97.97,3.47-3.47a.75.75,0,1,1,1.061,1.061l-4,4A.75.75,0,0,1,10.81,16.95Z" fill="#00954f"/>
                    <path id="Path_85" data-name="Path 85" d="M14,6.75H10a3.083,3.083,0,0,1-1.791-.376A2.626,2.626,0,0,1,7.25,4a2.626,2.626,0,0,1,.959-2.374A3.083,3.083,0,0,1,10,1.25h.96a.75.75,0,0,1,0,1.5H10a2.1,2.1,0,0,0-.959.124C8.853,3,8.75,3.4,8.75,4s.1,1,.291,1.126A2.1,2.1,0,0,0,10,5.25h4c.6,0,1-.1,1.126-.291A2.1,2.1,0,0,0,15.25,4c0-.6-.1-1-.291-1.126A2.1,2.1,0,0,0,14,2.75a.75.75,0,0,1,0-1.5,3.083,3.083,0,0,1,1.791.376A2.626,2.626,0,0,1,16.75,4a3.083,3.083,0,0,1-.376,1.791A2.626,2.626,0,0,1,14,6.75Z" fill="#00954f"/>
                    <path id="Path_86" data-name="Path 86" d="M3,10.75A.75.75,0,0,1,2.25,10c0-2.437.461-4.07,1.45-5.141.913-.988,2.226-1.478,4.259-1.587a.75.75,0,1,1,.081,1.5A4.5,4.5,0,0,0,4.8,5.876C4.094,6.643,3.75,7.992,3.75,10A.75.75,0,0,1,3,10.75Z" fill="#00954f"/>
                    <path id="Path_87" data-name="Path 87" d="M15,22.75H9c-2.663,0-4.391-.558-5.439-1.756C2.406,19.674,2.25,17.729,2.25,16V13.91a.75.75,0,0,1,1.5,0V16c0,2.055.281,3.254.939,4.006C5.432,20.855,6.8,21.25,9,21.25h6c2.2,0,3.568-.4,4.311-1.244.658-.753.939-1.951.939-4.006V10c0-2.012-.344-3.362-1.052-4.127a4.507,4.507,0,0,0-3.239-1.1.75.75,0,0,1,.081-1.5c2.034.11,3.348.6,4.259,1.583.99,1.07,1.451,2.7,1.451,5.146v6c0,1.729-.156,3.674-1.311,4.994C19.391,22.192,17.663,22.75,15,22.75Z" fill="#00954f"/>
                </g>
            </svg>
            <p>
                حساب کاربری با موفقیت ویرایش شد
            </p>
        </div><!--.message-->
        <?php endif;  //isset($_GET['updated']) ?>
        <form action="" class="" method="post" enctype="multipart/form-data">
            <div class="col col-9">
                <div class="row">
                    <div class="col col-4">
                        <div class="form-group">
                            <label for="username">نام کاربری</label>
                            <input type="text" disabled  class="form-control" id="username" name="username" value="<?php echo $user['username'] ;?>">
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="form-group">
                            <label for="first_name">نام</label>
                            <input type="text"  class="form-control" id="first_name" name="first_name" value="<?php echo $user['name'] ;?>">
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="form-group">
                            <label for="last_name">نام خانوادگی</label>
                            <input type="text"  class="form-control" id="last_name" name="last_name" value="<?php echo $user['family'] ;?>">
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="form-group">
                            <label for="phone">تلفن همراه</label>
                            <input type="text"  class="form-control ltr" id="phone" name="phone" value="<?php echo $user['phone'] ;?>">
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="form-group">
                            <label for="birthdate">تاریخ تولد</label>
                            <input type="text"  class="form-control ltr" id="birthdate" name="birthdate" value="<?php echo $user['birthdate'] ;?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-3">
                <div class="form-group">
                    <label for="photo">تصویر حساب کاربری</label>
                    <input type="file" accept="image/jpeg,image/png" name="photo" id="photo">
                    <img src="<?php echo  $user['photo']; ?> " class="profile-photo" id="photo_preview" alt="" width="512" height="512">
                </div>
            </div>
            <div class="col col-12">
                <button class="btn btn-primary" name="edit_profile">
                    ویرایش حساب کاربری
                </button>
            </div>
        </form>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>

            const imageInput = document.getElementById('photo');
            const previewImage = document.getElementById('photo_preview');
            function previewSelectedImage() {
                const file = imageInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                    }
                }
            }
            imageInput.addEventListener('change', previewSelectedImage);

            flatpickr("#birthdate", {
                enableTime  : true,
                dateFormat  : "Y-m-d",
            });
        </script>

    </main>
<?php include('partial/footer.php') ; ?>