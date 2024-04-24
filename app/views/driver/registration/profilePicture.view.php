<!DOCTYPE html>
<html>
    <head>
        <title>
            Driver Set Up
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= ROOT?>/assets/css/driverCSS.css">
    </head>
    <body>
        <div class="header-container">
            <img id="logo" src="<?= ROOT?>/assets/img/images/Logo.png">
            <button class="help-btn" id="help-btn">Help</button>
        </div>
        <div class="upload-container">
        <div style="margin-top:60px;"></div>
            <p class="upload">Upload a picture of yourself</p>
            <?php if(!empty($data['errors'])):?>
                <p class="upload" style="color:red;margin-top:10px;"><?php echo $data['errors'][0]; ?></p>
            <?php endif;?>

            
            <div class="image-container">
                <img class="profilepic" id="propic" src="<?= ROOT?>/assets/img/images/profilepic.jpg">
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="buttons">
                    <button type="button" class="upload-btn" id="upload-profile-pic">Upload Photo</button>
                    <button type="button" onclick="done_upload()" class="done-btn" id="upload-profile-pic">Done</button>
                    <input type="submit" name="done" id="sbmt-btn" style="display:none">
                <div>
                <input onchange="load_image(this.files[0])" type="file" name="photoInput" id="photoInput" style="display: none;">
            </form>
        </div>
        
        <div class ="help" id="help">
            <button id="close">&times;</button>
            <ul><li>Click 'Upload Photo' button</li>
                <li>Select your desired profile picture</li>  
                <li>Click Open</li></ul>
        </div>
        <script>
            var uploadedFlag = 0;
            document.getElementById('upload-profile-pic').addEventListener('click', function() {
                document.getElementById('photoInput').click();
            });

        //     document.getElementById('photoInput').addEventListener('change', function() {
        //     const selectedFile = this.files[0];
        //     if (selectedFile) {
        //         const imagePathElement = document.getElementById('propic');
        //         console.log(selectedFile);
        //         imagePathElement.src = selectedFile.name;
        //     }
        // });

        document.getElementById('help-btn').addEventListener('click', function() {
                    document.getElementById('help').style.display = 'flex';
            });
            document.getElementById('close').addEventListener('click', function() {
                    document.getElementById('help').style.display = 'none';
            });
        
            function load_image(file){
                var mylink = window.URL.createObjectURL(file);
                console.log(mylink);
                document.querySelector(".profilepic").src = mylink;
                uploadedFlag = 1;
                console.log(uploadedFlag);
            }
            function done_upload(){
                if(uploadedFlag == 1){
                    // document.location.href = "<?=ROOT?>/driver/registration";
                    console.log("Works");
                    document.getElementById('sbmt-btn').click();
                }else{
                    alert("Please upload an image");
                }
            }
        </script>
    </body>
</html>