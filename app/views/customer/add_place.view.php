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
                      <a href="<?=ROOT?>/customer/add_place_delete/<?=$row->id?>"><button class="delete_btn"><i class="fa-solid fa-trash" style="color: #7b1417;"></i></button></a>
                      </td>
                     </tr>
                 <?php endforeach; ?>
                  
                </table>
                <a href="<?=ROOT?>/customer/add_place_insert"><i class="fa-solid fa-square-plus"  id="plus"></i></a>
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

            //   const table = document.querySelector('.add_table')
            //   const form = document.querySelector('.add_form')
            //   const skip = document.querySelector('.skip')
            //   const plus = document.getElementById('plus')
             

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

                      });

      // --------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
        // ------------------------------------------------------------------------------------------------------------------------
          // const plus=document.getElementById("plus")
          // plus.addEventListener('click', ()=>{
          //               window.location.href = "http://localhost/FAREFLEX/public/customer/add_place_insert";
          //           })
          </script>

      </body>