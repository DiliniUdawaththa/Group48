<!DOCTYPE html>
<html>

<head>
    <title>More Details of Driver Registration</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/RideMore.css">

    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
</head>

<body>

    <div class='outer-box'>
        <div class="wrapper-box" style="overflow-y: auto;">
            <div class='wrapper-hdr'>
                <h2><?php echo isset($row2->name) ? $row2->name : 'N/A'; ?></h2>

            </div>
            <img src="<?= ROOT . '/' . $row->profileimg ?>" alt="Profile Image"
                style="position: absolute; right: 10px; width: 100px; height: 100px;">
            <div class='content'>
                <h4>Email: <?php echo isset($row2->email) ? $row2->email : 'N/A'; ?></h4>
                <h4>Contact Number: <?php echo isset($row2->phone) ? $row2->phone : 'N/A'; ?></h4>
                <h4>Address: <?php echo isset($row2->address) ? $row2->address : 'N/A'; ?></h4>
                <h4>NIC NO: <?php echo isset($row2->nic) ? $row2->nic : 'N/A'; ?></h4>
                <h4>Date Of Birth: <?php echo isset($row2->dob) ? $row2->dob : 'N/A'; ?></h4>

                <center><img src="<?= ROOT . '/' . $row->driverlicenseimg ?>" alt="Driver Licensse"
                        style="display: flex;align-items: center;justify-content: center; width: 200px; height: 200px;">
                    <img src="<?= ROOT . '/' . $row->revenuelicenseimg ?>" alt="Revenue Licensse"
                        style="position:center; width: 200px; height: 200px;">
                    <img src="<?= ROOT . '/' . $row->vehregistrationimg ?>" alt="vehicle Registration"
                        style="position:center; width: 200px; height: 200px;">
                    <img src="<?= ROOT . '/' . $row->vehinsuranceimg ?>" alt="Vehicle insurence"
                        style="position:center; width: 200px; height: 200px;">
                </center>



            </div>
        </div>
        <div class='bttn'>
            <button class="ok-btn" type="submit">OK</button>
        </div>
    </div>

    <script>
    const ok_button = document.querySelector('.ok-btn')

    ok_button.addEventListener('click', () => {
        window.location.href = "<?=ROOT?>/Officer/complains";
    })
    </script>
</body>

</html>