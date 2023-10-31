<!DOCTYPE html>
<html>
    <head>
        <title>
            Profile
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Driver/driverui.css">
    </head>
    <body>
        <div class="page-container">
            <div class="side-nav">
                <img src="images/Logo.png" class="logo">
                <div>
                    <img src="images/profilepic.png" class="profile-pic">
                    
                    <h4 class="name">Thusikaran<img src="<?= ROOT ?>/assets/img/images/active.png" id="status_icon" class="status-light"></h4>
                    <img src="<?= ROOT ?>/assets/img/images/rating.png" class="rating">
                </div>
                <div class="options">
                    <div class="opt1"> Notification</div>
                    <div class="opt2"> Activity</div>
                    <div class="opt3"> Profile</div>
                    <div class="opt4"> Logout</div>

                </div>
            </div>
            <div class="body-container">
                <div class="notification-container">
                    <div class="inner-noticontainer">
                        <p>No Notifications yet!</p>
                    </div>
                </div>
                <div class="activity-container">
                    <div class="status-container">
                        <h2>Hello, Thusikaran</h2>
                        
                        <div class="select-status">
                            <div><p>Active status:</p></div>
                            <div class="active">
                                <p>Active</p>
                            </div>
                            <div class="inactive">
                                <p>Inactive</p>
                            </div>
                            
                        </div>
                    </div>

                    <div class="request-container">
                        <h2>Request for ride</h2>
                        <div class="request-box">
                            <div>
                                <img src="images/default_profile.png" class="request-customer-pic">
                                <img src="images/rating.png" style="height: 10px;display: block;">
                            </div>
                            <div class="destination">
                                <p style="display: block;margin: 5px;">From: 25, Hill Street, Colombo</p>
                                <p style="display: block;margin: 5px;">To: 213/A , Katubedda , Moratuwa</p>
                            </div>
                            <div> 
                                <button class="map-view-btn">Map View</button>
                                <button class="accept-btn">Accept</button> 
                            </div>
                        </div>
                        <div class="request-box">
                            <div>
                                <img src="images/default_profile.png" class="request-customer-pic">
                                <img src="images/rating.png" style="height: 10px;display: block;">
                            </div>
                            <div class="destination">
                                <p style="display: block;margin: 5px;">From: 43, Bambalapitiya, Colombo</p>
                                <p style="display: block;margin: 5px;">To: 243/A , Kollupitiya, Colombo</p>
                            </div>
                            <div> 
                                <button class="map-view-btn">Map View</button>
                                <button class="accept-btn">Accept</button> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-container">
                    <div class="profile-bar">
                        <div class="propic-container">
                            <img src="images/profilepic.png" class="propic">
                            <button class="upload-propic"><img src="images/upload_icon.png" style="height:10px"> Upload</button>
                        </div>
                        <div class="detail-container">
                            <table class="profile-details-table">
                                <tr class="tr1">
                                    <td class="col1">Full Name</td>
                                    <td class="col2">Isuka Premathilake</td>
                                    <td class="col3"><button><img src="images/edit_icon.png"></button></td>
                                </tr>
                                <tr>
                                    <td class="col1">NIC</td>
                                    <td class="col2">200143234422</td>
                                    <td class="col3"><button><img src="images/edit_icon.png"></button></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="col1">Registation ID</td>
                                    <td class="col2">1001324292d</td>
                                    <td class="col3"><button><img src="images/edit_icon.png"></button></td>
                                </tr>
                                <tr>
                                    <td class="col1">Email</td>
                                    <td class="col2">isukapremathilake@gmail.com</td>
                                    <td class="col3"><button><img src="images/edit_icon.png"></button></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="col1">Phone</td>
                                    <td class="col2"> 0783272623</td>
                                    <td class="col3"><button><img src="images/edit_icon.png"></button></td>
                                </tr>
                                <tr>
                                    <td class="col1">Date Of Birth</td>
                                    <td class="col2">09/20/2001</td>
                                    <td class="col3"><button><img src="images/edit_icon.png"></button></td>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                </div>
                <div class="logout-container">
                    <h2>Log Out</h2>
                    <p class="logout-text">Are you sure you want to log out?</p>
                    <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log Out</button></div>
                </div>
            </div>
        </div>
        <script>
            var status = 1
            const active_btn = document.querySelector('.active');
            const inactive_btn = document.querySelector('.inactive');
            const status_icon = document.getElementById('status_icon');
            const notification_option = document.querySelector('.opt1');
            const activity_option = document.querySelector('.opt2');
            const profile_option = document.querySelector('.opt3');
            const logout_option = document.querySelector('.opt4')
            const notification_container = document.querySelector('.notification-container')
            const activity_container = document.querySelector('.activity-container')
            const profile_container = document.querySelector('.profile-container')
            const logout_container = document.querySelector('.logout-container')
            const cancel_button = document.querySelector('.cancel-btn')
            const logout_button = document.querySelector('.logout-btn')
            

            notification_option.addEventListener('click', function (){
                notification_container.style.display = 'block'
                activity_container.style.display = 'none'
                profile_container.style.display = 'none'
                notification_option.style.backgroundColor = '#194672'
                activity_option.style.backgroundColor = ''
                profile_option.style.backgroundColor = ''
            })

            activity_option.addEventListener('click',function (){
                profile_container.style.display = 'none'
                notification_container.style.display = 'none'
                activity_container.style.display = 'block'
                notification_option.style.backgroundColor = ''
                activity_option.style.backgroundColor = '#194672'
                profile_option.style.backgroundColor = ''
            })

            profile_option.addEventListener('click',function (){
                profile_container.style.display = 'block'
                activity_container.style.display = 'none'
                notification_container.style.display = 'none'
                profile_option.style.backgroundColor = '#194672'
                activity_option.style.backgroundColor = ''
                notification_option.style.backgroundColor = ''
            })

            active_btn.addEventListener('click',function (){
                status = 1
                status_icon.src = 'images/active.png';
                active_btn.style.backgroundColor = '#162938'
                active_btn.style.color = 'white'
                inactive_btn.style.backgroundColor = '#E4E4E4'
                inactive_btn.style.color = 'black'
            })
            inactive_btn.addEventListener('click',function (){
                status = 0
                status_icon.src = 'images/inactive.png';
                active_btn.style.backgroundColor = '#E4E4E4'
                active_btn.style.color = 'black'
                inactive_btn.style.backgroundColor = '#162938'
                inactive_btn.style.color = 'white'
            })

            logout_option.addEventListener('click',function (){
                logout_container.style.display = 'block'
            })

            cancel_button.addEventListener('click',function (){
                logout_container.style.display = 'none'
            })
        </script>
    </body>
</html>