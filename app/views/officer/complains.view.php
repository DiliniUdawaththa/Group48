<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Officer/Officer.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Officer/renewDRegistration.css">
    <style>
    .error {
        border: 1px solid red;
        color: red;
    }

    .message {
        height: 50px;
        width: 100%;
        margin-bottom: 10px;
    }

    .message p {
        padding: 10px;
        font-size: 1em;
        color: #026334;
        background-color: #a7cfbc;
    }

    .con-button {
        width: 80%;
        background-color: #000000;
        color: white;
        border: none;
        border-radius: 10px;
        height: 50px;
        font-size: 20px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .none-dec {
        text-decoration: none;
    }


    .box1 {
        width: 80%;
        margin: auto;
        text-align: center;
        position: relative;
        top: 50px;
    }
    </style>
</head>

<body>
    <div class="main">
        <div class="sidebar">
            <div class="logo">
                <img src="<?= ROOT ?>/assets/img/logoname.png" class="barimage">
                <br>
            </div>
            <div class="profile">
                <img src="<?= ROOT ?>/assets/img/person.jpg" alt="" class="userimage">
                <br>
                <H3 class="username"><?=Auth::getname();?></H3>
            </div>
            <div class="items">
                <a href="<?=ROOT?>/officer" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-gauge"></i>Dashboard</div>
                </a>
                <a href="<?=ROOT?>/officer/officerdriverRegistration" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-users"></i>Driver Registration</div>
                </a>
                <a href="<?=ROOT?>/officer/complains" class="link">
                    <div class="linkbutton1"><i class="fa-sharp fa-solid fa-circle-exclamation"></i>Complains</div>
                </a>
                <a href="<?=ROOT?>/officer/standardFare" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-tag"></i>Standard Fare</div>
                </a>
                <!--<a href="<?=ROOT?>/admin/ride" class="link"><div class="linkbutton"><i class="fa-solid fa-taxi"></i>Rides</div></a>-->
                <a href="#" class="link">
                    <div class="linkbutton2"><i class="fa-solid fa-right-from-bracket fa-rotate-180"></i>Logout</div>
                </a>
            </div>

            <div class="logout-container">
                <h2>Log Out</h2>
                <p class="logout-text">Are you sure you want to log out?</p>
                <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log
                        Out</button></div>
            </div>


        </div>



        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logout_option = document.querySelector('.linkbutton2');
            const logout_container = document.querySelector('.logout-container');
            const cancel_logout_button = document.querySelector('.cancel-btn');
            const logout_button = document.querySelector('.logout-btn');

            logout_option.addEventListener('click', () => {
                logout_container.style.display = 'block';
            });

            cancel_logout_button.addEventListener('click', () => {
                logout_container.style.display = 'none';
            });

            logout_button.addEventListener('click', () => {
                window.location.href = "<?=ROOT?>/logout";
            });

            const accept_buttons = document.querySelectorAll('.accept_btn');
            const reject_buttons = document.querySelectorAll('.reject_btn');
            const accept_container = document.querySelector('.accept-container');
            const reject_container = document.querySelector('.reject-container');
            const cancel_accept_button = document.querySelector('.cancel-accept-btn');
            const cancel_reject_button = document.querySelector('.cancel-reject-btn');

            accept_buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const cmt_id = button.getAttribute('data-cmt_id');
                    accept_container.style.display = 'block';
                    document.querySelector('.ok-btn').addEventListener('click', () => {
                        window.location.href = "<?=ROOT?>/officer/investigate/" +
                            encodeURIComponent(cmt_id);
                    });
                });
            });
            cancel_accept_button.addEventListener('click', () => {
                accept_container.style.display = 'none';
            });

            reject_buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const cmt_id = button.getAttribute('data-cmt_id');
                    reject_container.style.display = 'block';
                    document.querySelector('.reject-btn').addEventListener('click', () => {
                        window.location.href = "<?=ROOT?>/officer/reject/" +
                            encodeURIComponent(cmt_id);
                    });
                });
            });
            cancel_reject_button.addEventListener('click', () => {
                reject_container.style.display = 'none';
            });


        });
        </script>

        <div class="interface">
            <div class="navi">
                <div class="navi1">
                    <h2>COMPLAINTS</h2>
                </div>
            </div>
            <div class="table1">
                <table>
                    <thead>
                        <tr>
                            <td>Complainant</td>
                            <td>Complaint</td>
                            <td>Officer Comment</td>
                            <td>Status</td>
                            <td>Option</td>
                        </tr>
                    </thead>
                    <?php foreach ($rows as $row) : ?>

                    <tr class="data">
                        <td><?= $row->complainant ?></td>

                        <td><?= $row->complaint?></td>
                        <td><?= $row->officerCmnt?></td>
                        <td><?php if ($row->status_check == 0) {
                            echo 'Pending';
                        } elseif ($row->status_check == 1) {
                            echo 'Investigated';
                            } elseif ($row->status_check == 2) {
                                echo 'Rejected';
                            } ?></td>
                        <td class="td_button1">
                            <a href="<?=ROOT?>/officer/complainView/<?= urlencode($row->cmt_id) ?>"><button
                                    class="detail_btn1">
                                    <!--<i
                                        class="fa-solid fa-circle-info" style="color: black;">--></i>
                                    DETAILS
                                </button></a>
                            <a href="<?=ROOT?>/officer/add_comment/<?=$row->cmt_id?>"><button class="detail_btn1">
                                    <!--<i
                                        class="fa-solid fa-circle-info" style="color: black;">--></i>
                                    COMMENT
                                </button></a>

                            <button class="accept_btn" data-cmt_id="<?= $row->cmt_id ?>">INVESTIGATED</button>
                            <button class="reject_btn" data-cmt_id="<?= $row->cmt_id ?>">REJECT</button>


                        </td>
                    </tr>
                    <?php endforeach; ?>

                </table>
            </div>



        </div>


    </div>
    <div class="accept-container">
        <h2>Investigate Complaint</h2>
        <p class="accept-text">Are you sure you investigate this complaint?</p>
        <div class="btn"><button class="cancel-accept-btn">NO</button> <button class="ok-btn">YES</button>
        </div>
    </div>

    <div class="reject-container">
        <h2>Reject Complaint</h2>
        <p class="reject-text">Are you sure you want to reject this Complaint?</p>
        <div class="btn"><button class="cancel-reject-btn">NO</button> <button class="reject-btn">YES</button>
        </div>
    </div>



</body>

</html>