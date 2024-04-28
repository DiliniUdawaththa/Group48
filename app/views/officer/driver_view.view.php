<!DOCTYPE html>
<html>

<head>
    <title>More Details of Driver</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/RideMore.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <style>
    .complaint-btn {
        background-color: #ff6347;
        /* Coral color */
        color: #fff;
        /* White text */
        border: none;

        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .complaint-btn:hover {
        background-color: #ff4c00;
        /* Darker shade of coral on hover */
    }
    </style>
</head>


<body>

    <div class='outer-box'>
        <div class="wrapper-box">
            <div class='wrapper-hdr'>
                <h2><?php echo isset($row->name) ? $row->name : 'N/A'; ?></h2>
                <img src="<?= ROOT . '/' . $row->img_path ?>" alt="Profile Image"
                    style="position: absolute; right: 10px; width: 100px; height: 100px;">

            </div>
            <div class='content'>
                <h4>Driver ID: <?php echo isset($row->id) ? $row->id : 'N/A'; ?></h4>
                <h4>Contact Number: <?php echo isset($row->phone) ? $row->phone : 'N/A'; ?></h4>
                <h4>Email: <?php echo isset($row->email) ? $row->email : 'N/A'; ?></h4>
                <h4>Address: <?php echo isset($row->address) ? $row->adress : 'N/A'; ?></h4>
                <h4>NIC NO: <?php echo isset($row->nic) ? $row->nic : 'N/A'; ?></h4>
                <h4>Date Of Birth: <?php echo isset($row->dob) ? $row->dob : 'N/A'; ?></h4>
                <br>
                <div class='bttn'>
                    <button class="complaint-btn" type="submit">Complains Details</button>
                </div>

            </div>
        </div>
        <div class='bttn'>
            <button class="ok-btn" type="submit">OK</button>
        </div>
    </div>

    <script>
    const ok_button = document.querySelector('.ok-btn')

    ok_button.addEventListener('click', () => {
        window.location.href = "<?=ROOT?>/officer/driver";
    })

    const complaint_button = document.querySelector('.complaint-btn')

    complaint_button.addEventListener('click', () => {
        window.location.href = "<?=ROOT?>/officer/driver_complain/<?= urlencode($row->id) ?>";
    })
    </script>
</body>

</html>