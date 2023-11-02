<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/Add_Place.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <title>Document</title>
    <style>
        .error {
            border: 1px solid red;
            color: red;
        }
        .message{
            /* margin-top:; */
            height: 50px;
            width: 100%;
            margin-bottom: 10px;
            
         }
         .message p{
            padding: 10px;
            font-size: 1em;
            color: #026334;
            background-color: #a7cfbc;
            
            
         }
    </style>
</head>

<body>
    <div class="main">
        <!-- side bar========================= -->
        <div class="sidebar">

             <div class="barimagetag">
                <img src="<?= ROOT ?>/assets/img/logoname.png" alt="" class="barimage">
             </div>


             <div class="profile">
                <img src="<?= ROOT ?>/assets/img/person.jpg" alt="" class="userimage">
                <H3 class="username">Thusikaran</H3>
                <h6>
                  <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                  <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                  <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                  <i class="fa-solid fa-star" ></i>
                  <i class="fa-solid fa-star" ></i>
                </h6>
             </div>
             

             <div class="linktag">
                <a href="<?= ROOT ?>/customer" class="link"><div class="linkbutton"><i class="fa-solid fa-car-tunnel"></i>Ride</div></a>
                <a href="<?= ROOT ?>/customer/add_place" class="link"><div class="linkbutton1"><i class="fa-solid fa-map-location-dot"></i>Add Place</div></a>
                <a href="#" class="link"><div class="linkbutton"><i class="fa-solid fa-file-lines"></i>Activity</div></a>
                <a href="#" class="link"><div class="linkbutton"><i class="fa-solid fa-handshake-angle"></i>Help</div></a>
                <a href="#" class="link"><div class="linkbutton2"><i class="fa-solid fa-right-from-bracket"></i>Logout</div></a>
             </div>
      
             <div class="logout-container">
              <h2>Log Out</h2>
              <p class="logout-text">Are you sure you want to log out?</p>
              <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log Out</button></div>
             </div>
           
             
        </div>
<!-- -------------------------------------------------------------------------------------------------------------------------------------- -->
        

         <div class="container_part">
          <!-- <div></div> -->
         <center>
          <div class="place_container">
            <div class="add_form">
              <form name="addPlaceForm" action="" method="post" onsubmit="return validateForm()">
                 <div class="place_top"><h1><i class="fa-solid fa-map-location-dot"></i> Add Place</h1></div>
                 <div class="input_box">

                       

                      <div>
                          <label for="name" class="label">Placename</label><br>
                        </div>
                          <input value="<?= set_value('name') ?>" type="text" name="name" id="name" class="<?=!empty($errors['name']) ? 'error':'';?>" required>
                          <?php if(!empty($errors['name'])):?>
                             <small id="Firstname-error" class="signup-error" style="color: red;"> <?= $errors['name']?> </small>
                           <?php endif;?>
                          <br>
                       <div>
                          <label for="category" class="label" >Category</label><br>
                        </div>
                          <input value="<?= set_value('category') ?>" list="categorys" name="category" id="categoryInput" required>
                              <datalist id="categorys">
                                <option value="Home">
                                <option value="Food & Drink">
                                <option value="Shopping">
                                <option value="Education">
                                <option value="Religion">
                                <option value="Hotels & lodging"></option>
                                <option value="Hospital"></option>
                                <option value="Bank"></option>
                                <option value="Office"></option>
                                <option value="Other"></option>
                              </datalist>
                              <br>
                         <div class="address">
                          <label for="address" class="label">Address</label>
                          <!-- <i class="fa-solid fa-location-dot"></i> -->
                          <br>
                        </div>
                          <input value="<?= set_value('address') ?>" type="text" name="address" id="address" required>
                          <br>
                          <button  id="submit_btn" class="submit_btn">Submit</button>
                          <br>
                          <a href="<?=ROOT?>/customer/add_place"><small class="skip"><center>skip</center></small></a>
                  </div>
              </form>
            </div>
           
           
          </div>
         </center>
         </div>

         <script>
            const logout_option = document.querySelector('.linkbutton2')
            const logout_container = document.querySelector('.logout-container')
            const cancel_button = document.querySelector('.cancel-btn')
           const logout_button = document.querySelector('.logout-btn')
                logout_option.addEventListener('click',()=>{
                    logout_container.style.display = 'block'
                    })

                    cancel_button.addEventListener('click', ()=>{
                    logout_container.style.display = 'none'
                    })
                    logout_button.addEventListener('click', ()=>{
                        window.location.href = "<?=ROOT?>/logout";
                    })

                    // --------------------------------------------------------------------------------------------

              const table = document.querySelector('.add_table')
              const form = document.querySelector('.add_form')
              const skip = document.querySelector('.skip')
              const plus = document.getElementById('plus')
             

            // plus.addEventListener('click',()=>{
            //     form.style.display = 'block'
            //     table.style.display = 'none'
            //   })

            //   skip.addEventListener('click',()=>{
            //     form.style.display = 'none'
            //     table.style.display = 'block'
            //   })
              // ------------------------------------------------------

          


            //  ------------------------------------------------------------------------------------------------------------------------ 
            // categery list part 
            const categoryInput = document.getElementById('categoryInput');

                      categoryInput.addEventListener('input', function () {
                          const enteredValue = this.value;
                          const options = document.getElementById('categorys').getElementsByTagName('option');
                          let validOption = false;

                          for (let i = 0; i < options.length; i++) {
                              if (options[i].value === enteredValue) {
                                  validOption = true;
                                  break;
                              }
                          }

                          if (!validOption) {
                              // Clear the input if the entered value is not in the datalist
                              this.value = '';
                          }
                      });

      // --------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
        // ------------------------------------------------------------------------------------------------------------------------

          </script>

      </body>