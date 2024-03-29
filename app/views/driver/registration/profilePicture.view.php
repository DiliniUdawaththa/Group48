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

            <div class="image-container"><img class="profilepic" id="propic" src="<?= ROOT?>/assets/img/images/profilepic.jpg"></div>
            <button class="upload-btn" id="upload-profile-pic">Upload Photo</button>
            <input type="file" name="photo" id="photoInput" style="display: none;">
        </div>
        
        <div class ="help" id="help">
            <button id="close">&times;</button>
            <ul><li>Click 'Upload Photo' button</li>
                <li>Select your desired profile picture</li>  
                <li>Click Open</li></ul>
        </div>
        <script>
            document.getElementById('upload-profile-pic').addEventListener('click', function() {
                document.getElementById('photoInput').click();
            });

            document.getElementById('photoInput').addEventListener('change', function() {
            const selectedFile = this.files[0];
            if (selectedFile) {
                const imagePathElement = document.getElementById('propic');
                console.log(selectedFile);
                imagePathElement.src = selectedFile.name;
            }
        });

        document.getElementById('help-btn').addEventListener('click', function() {
                    document.getElementById('help').style.display = 'flex';
            });
            document.getElementById('close').addEventListener('click', function() {
                    document.getElementById('help').style.display = 'none';
            });
        </script>
    </body>
</html>