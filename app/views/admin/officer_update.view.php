<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/Dashboard.css">
</head>
<body>
   <?php $this->view('admin/include/sidebar',$data) ?>
   <section id="interface">
        <div class="navi">
            <div class="navi1">
                <h2>OFFICER</h2>
            </div>

            <div class="operation">
                <button type="button" class="button-style" id="plus">+ Add Officer</button>
            </div>
        </div>

        <div class="officer_form">
            <form action="" method="post">
                 <div class="officer_box">
                      <div>
                          <label for="" class="label">Employee ID</label><br>
                        </div>
                          <input type="text" name="empID"  required>
                          <?php if(!empty($errors['empID'])):?>
                          <?php endif;?>
                          <br>
                        <div>
                          <label for="" class="label" >Name</label><br>
                        </div>
                          <input type="text" name="Name" required>
                            <?php if(!empty($errors['Name'])):?>
                            <?php endif;?>
                            <br>
                        <div>
                          <label for="" class="label">Email</label>
                          <!-- <i class="fa-solid fa-location-dot"></i> -->
                          <br>
                        </div>
                          <input type="text" name="Email" required>
                          
                          <?php if(!empty($errors['Email'])):?>
                             <!-- <small id="Firstname-error" class="signup-error" style="color: red;"> <?=$errors['address']?></small> -->
                          <?php endif;?>
                          <br>
                        <div>
                          <label for="" class="label">Mobile</label>
                          <!-- <i class="fa-solid fa-location-dot"></i> -->
                          <br>
                        </div>
                          <input type="text" name="Mobile" required>
                          
                          <?php if(!empty($errors['Mobile'])):?>
                        <!-- <small id="Firstname-error" class="signup-error" style="color: red;"> <?=$errors['Mobile']?></small>  -->
                          <?php endif;?>
                          <br>
                          <a href="<?=ROOT?>/admin/officer/"><button type="submit" class="submit_btn">Submit</button>
                          <br>
                          <!-- <small class="skip"><center>skip</center></small> -->
                  </div>
              </form>
        </div>

       
                <!-- <tbody>
                    <tr>
                        <td>001</td>
                        <td>Amila Perera</td>
                        <td>amila@gmail.com</td>
                        <td>0771234567</td>
                        <td>
                            <button class="update">Update</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Nuwan Perera</td>
                        <td>nuwan@gmail.com</td>
                        <td>0771234567</td>
                        <td>
                            <button class="update">Update</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Dinithi Fernando</td>
                        <td>dinithi@gmail.com</td>
                        <td>0771234567</td>
                        <td>
                            <button class="update">Update</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                </tbody> -->
            </table>
        </div>
    </section>
    <script>
        // const logout_option = document.querySelector('.linkbutton2')
        // const logout_container = document.querySelector('.logout-container')
        // const cancel_button = document.querySelector('.cancel-btn')
        //   //  const logout_button = document.querySelector('.logout-btn')
        //         logout_option.addEventListener('click',()=>{
        //             logout_container.style.display = 'block'
        //             })

        //             cancel_button.addEventListener('click', ()=>{
        //             logout_container.style.display = 'none'
        //             })

        const table = document.querySelector('.table1')
        const form = document.querySelector('.officer_form')
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
    </script>
</body>