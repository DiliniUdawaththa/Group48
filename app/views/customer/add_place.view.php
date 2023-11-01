<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/Add_Place.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <title>Document</title>
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
              <form action="" method="post">
                 <div class="place_top"><h1><i class="fa-solid fa-map-location-dot"></i> Add Place</h1></div>
                 <div class="input_box">
                      <div>
                          <label for="" class="label">Placename</label><br>
                        </div>
                          <input type="text" name="name"  required>
                          <?php if(!empty($errors['name'])):?>
                        <small id="Firstname-error" class="signup-error" style="color: red;"> <?=$errors['name']?></small>
                          <?php endif;?>
                          <br>
                       <div>
                          <label for="" class="label" >Category</label><br>
                        </div>
                          <input list="categorys" name="category" id="categoryInput" required>
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
                              
                              <?php if(!empty($errors['category'])):?>
                              <small id="Firstname-error" class="signup-error" style="color: red;"> <?=$errors['category']?></small>
                              <?php endif;?>
                              <br>
                         <div class="address">
                          <label for="" class="label">Address</label>
                          <!-- <i class="fa-solid fa-location-dot"></i> -->
                          <br>
                        </div>
                          <input type="text" name="address" required>
                          
                          <?php if(!empty($errors['address'])):?>
                             <small id="Firstname-error" class="signup-error" style="color: red;"> <?=$errors['address']?></small>
                          <?php endif;?>
                          <br>
                          <button type="submit" class="submit_btn">Submit</button>
                          <br>
                          <small class="skip"><center>skip</center></small>
                  </div>
              </form>
            </div>
            <div class="add_table ">
                <table>
                  <tr class="title">
                    <th class="th1">Icon</th>
                    <th class="th2">Name</th>
                    <th class="th3">Location</th>
                    <th class="th4"></th>
                  </tr>
                  <?php foreach ($rows as $row) : ?>
                    <tr class="data"> 
                      <td class="td_i"><i class="<?= $row->icon; ?>"></i></td>
                      <td class="td_name"><?= $row->name; ?></td>
                      <td class="td_address"><?= $row->address; ?></td>
                      <td class="td_button">
                      <button class="update_btn"><i class="fa-solid fa-pen-to-square" style="color: #407217;"></i></i></button>
                      <button class="delete_btn"><i class="fa-solid fa-trash" style="color: #7b1417;"></i></button>
                      </td>
                     </tr>
                 <?php endforeach; ?>
                  <!-- <tr class="data">
                    <td class="td_i"><i class="fa-solid fa-house"></i></td>
                    <td class="td_name">Home</td>
                    <td class="td_address">wellawatta East</td>
                    <td class="td_button">
                      <button class="update_btn"><i class="fa-solid fa-pen-to-square" style="color: #407217;"></i></i></button>
                      <button class="delete_btn"><i class="fa-solid fa-trash" style="color: #7b1417;"></i></button>
                    </td>
                  </tr>
                  <tr class="data">
                    <td class="td_i"><i class="fa-solid fa-house"></i></td>
                    <td class="td_name">Home</td>
                    <td class="td_address">wellawatta East</td>
                    <td class="td_button">
                      <button class="update_btn"><i class="fa-solid fa-pen-to-square" style="color: #407217;"></i></i></button>
                      <button class="delete_btn"><i class="fa-solid fa-trash" style="color: #7b1417;"></i></button>
                    </td>
                  </tr> -->
                </table>
                <i class="fa-solid fa-square-plus" id="plus" id="plus"></i>
            </div>
           
          </div>
         </center>
         </div>

         <script>
            const logout_option = document.querySelector('.linkbutton2')
            const logout_container = document.querySelector('.logout-container')
            const cancel_button = document.querySelector('.cancel-btn')
          //  const logout_button = document.querySelector('.logout-btn')
                logout_option.addEventListener('click',()=>{
                    logout_container.style.display = 'block'
                    })

                    cancel_button.addEventListener('click', ()=>{
                    logout_container.style.display = 'none'
                    })

                    // --------------------------------------------------------------------------------------------

              const table = document.querySelector('.add_table')
              const form = document.querySelector('.add_form')
              const skip = document.querySelector('.skip')
              const plus = document.getElementById('plus')
             

            plus.addEventListener('click',()=>{
                form.style.display = 'block'
                table.style.display = 'none'
              })

              skip.addEventListener('click',()=>{
                form.style.display = 'none'
                table.style.display = 'block'
              })
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


          </script>

      </body>