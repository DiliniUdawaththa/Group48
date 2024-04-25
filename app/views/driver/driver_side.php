<div class="side-nav">
                <img src="<?= ROOT ?>/assets/img/logonamenw.png" class="logo">
                <div>
                    <img src="<?= ROOT ?>/assets/img/images/profilepic.png" class="profile-pic">
                    
                    <h4 class="name"><?php echo $_SESSION['USER_DATA']->name; ?> - Driver<img src="<?= ROOT ?>/assets/img/images/active.png" id="status_icon" class="status-light"></h4>
                    <img src="<?= ROOT ?>/assets/img/images/rating.png" class="rating">
                </div>
                <div class="options">
                    <a href="<?=ROOT?>/driver/activity"> <div class="opt1"><div><i class="fa fa-tasks" aria-hidden="true" style="margin-right: 10px;"></i>Hire Request</div><i class="fa fa-chevron-right" aria-hidden="true"></i></div></a>
                    <a href="<?=ROOT?>/driver/analytics"><div class="opt2"><div><i class="fa fa-line-chart" aria-hidden="true" style="margin-right: 10px;"></i> Analytics</div><i class="fa fa-chevron-right" aria-hidden="true"></i></div></a>
                    <a href="<?=ROOT?>/driver/vehicles"><div class="opt2-1"><div><i class="fa fa-car" aria-hidden="true" style="margin-right: 10px;"></i> Vehicles</div><i class="fa fa-chevron-right" aria-hidden="true"></i></div></a>
                    <a href="<?=ROOT?>/driver/ride"><div class="opt3"><div><i class="fa fa-user" aria-hidden="true" style="margin-right: 10px;"></i> Profile</div><i class="fa fa-chevron-right" aria-hidden="true"></i></div></a>
                    <div class="opt4"><div><i class="fa fa-sign-out" aria-hidden="true" style="margin-right: 10px;"></i> Logout</div></div>

                </div>
</div>
<div class="navigation-bar">
            <div style="width: 80px;"><img src="<?= ROOT ?>/assets/img/images/more_icon.png"  class="more-icon" ></div>
            <img src="<?= ROOT ?>/assets/img/images/Logo.png" style="height: 60px;">
</div>
<div class="notification-bar">
                    <div>
                        <i class="fa-regular fa-bell noti-icon"></i>
                        <i class="fa-regular fa-message msg-icon"></i>
                    </div>
</div>

