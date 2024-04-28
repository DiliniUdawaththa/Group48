<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/Add_Place.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_side.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
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
                <img src="<?= ROOT ?>/assets/img/logonamenw.png" alt="" class="barimage">
             </div>


             <div class="profile">
                <img src="<?= ROOT ?>/assets/img/customer/profile/<?=$img?>" alt="" class="userimage">
                <H3 class="username"><?php echo $_SESSION['USER_DATA']->role; ?> - <?=Auth::getname();?></H3>
                <h6>
                 <?php for($i=0; $i<$rating; $i++){ ?>
                  <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                  <?php } for($i=$rating; $i<5; $i++){?>
                  <i class="fa-solid fa-star" ></i>
                  <?php }?>
                </h6>
             </div>
             

             <div class="linktag">
                <a href="<?= ROOT ?>/customer" class="link2"><div class="linkbutton"><i class="fa-solid fa-car-tunnel"></i>Ride</div></a>
                <a href="<?= ROOT ?>/customer/add_place" class="link"><div class="linkbutton1"><i class="fa-solid fa-map-location-dot"></i>Add Place</div></a>
                <a href="<?= ROOT ?>/customer/activity" class="link2"><div class="linkbutton"><i class="fa-solid fa-file-lines"></i>Activity</div></a>
                <a href="<?=ROOT?>/customer/profile" class="link2"><div class="linkbutton"><i class="fa-solid fa-user"></i>Profile</div></a>
                <a href="<?= ROOT ?>/customer/help" class="link2"><div class="linkbutton"><i class="fa-solid fa-handshake-angle"></i>Help</div></a>
                <a href="#" class="link2"><div class="linkbutton2"><i class="fa-solid fa-right-from-bracket"></i>Logout</div></a>
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
                    <?php if($row->passenger_id==$_SESSION['USER_DATA']->id) { ?>
                    <tr class="data"> 
                      <td class="td_i"><i class="<?= $row->icon; ?>"></i></td>
                      <td class="td_name"><?= $row->name; ?></td>
                      <td class="td_address"><?= $row->location; ?></td>
                      <td class="td_button">
                       <a href="<?=ROOT?>/customer/add_place_update/<?=$row->id?>"><button class="update_btn"><i class="fa-solid fa-pen-to-square" style="color: #407217;"></i></i></button></a>
                       <button class="delete_btn" id="delete_<?=$row->id?>" onclick="delete_line('delete_<?=$row->id?>')"><i class="fa-solid fa-trash" style="color: #7b1417;"></i></button>
                      </td>
                     </tr>
                    
                     <!-- // delete container---------------------------------------------- -->
                    <div class="delete-container" id="delete-container_<?=$row->id?>">
                      <h2><i class="<?= $row->icon; ?>"></i> <?= $row->name; ?></h2>
                      <p class="delete-text">Are you sure you want to delete?</p>
                      <div class="cancel-delete"  >
                        <button class="cancel-btn-delete" id="cancel-btn-delete_<?=$row->id?>">Cancel</button>
                         <button class="delete-btn" id="delete-btn_<?=$row->id?>">Delete</button>
                      </div>
                    </div>
                    <!-- //------------------------------------------------------------------------ -->
                   <?php }?>
                    <?php endforeach; ?>
                </table>
                <a href="<?=ROOT?>/customer/add_place_insert"><i class="fa-solid fa-square-plus"  id="plus"></i></a>
            </div>
                
               

                
           
          </div>
         </center>
         </div>

         <script>

          function delete_line(data)
          {
            
            //  const place=document.querySelector('.data');
             const plus=document.getElementById('plus');
            <?php foreach ($rows as $row) : ?>
              if(data=="delete_<?=$row->id?>"){ 
                  const delete_container= document.getElementById('delete-container_<?=$row->id?>') 
                  const cancel_delete_button = document.getElementById('cancel-btn-delete_<?=$row->id?>')
                  const delete_button = document.getElementById('delete-btn_<?=$row->id?>')
                  delete_container.style.display = 'block'
                  plus.style.display="none";
                  // place.style.display="none";

                    cancel_delete_button.addEventListener('click', ()=>{
                      window.location.href ="<?=ROOT?>/customer/add_place";
                    })
                    delete_button.addEventListener('click', ()=>{
                        window.location.href ="<?=ROOT?>/customer/add_place_delete/<?=$row->id?>";
                    })
              }
              <?php endforeach; ?>
          }
              
          
            //  ------------------------------------------------------------------------------------------------------------------------ 
            const logout_option = document.querySelector('.linkbutton2')
            const logout_container = document.querySelector('.logout-container')
            const cancel_button = document.querySelector('.cancel-btn')
           const logout_button = document.querySelector('.logout-btn')
           const plus=document.getElementById('plus');
                   logout_option.addEventListener('click',()=>{
                      logout_container.style.display = 'block'
                      plus.style.display="none";
                      })

                    cancel_button.addEventListener('click', ()=>{
                      window.location.href ="<?=ROOT?>/customer/add_place";
                      })
                    logout_button.addEventListener('click', ()=>{
                        window.location.href = "<?=ROOT?>/logout";
                    })
            // categery list part 
            // const categoryInput = document.getElementById('categoryInput');

            //           categoryInput.addEventListener('input', function () {
            //               const enteredValue = this.value;
            //               const options = document.getElementById('categorys').getElementsByTagName('option');
            //               let validOption = false;

            //               for (let i = 0; i < options.length; i++) {
            //                   if (options[i].value === enteredValue) {
            //                       validOption = true;
            //                       break;
            //                   }
            //               }

            //           });

      // --------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
        // ------------------------------------------------------------------------------------------------------------------------
          // const plus=document.getElementById("plus")
          // plus.addEventListener('click', ()=>{
          //               window.location.href = "http://localhost/FAREFLEX/public/customer/add_place_insert";
          //           })
          </script>

      </body>