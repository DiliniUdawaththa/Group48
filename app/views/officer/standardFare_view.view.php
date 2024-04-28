<!DOCTYPE html>
<html>

<head>
    <title>More Details of Driver</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/RideMore.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
</head>


<body>

    <div class='outer-box'>
        <div class="wrapper-box">
            <div class='wrapper-hdr'>
                <h2>STANDARD FARE</h2>

            </div>
            <div class='content'>
                <h3> Vehicle Type : <?= $row->vehicletype; ?></h3>

                <h3> Fare Type:
                    <?= $row->faretype; ?>
                </h3>
                <h3> Fare per Km:
                    <?= $row->fare; ?>
                </h3>
                <h3> Updated Officer Email Address:
                    <?= $row->updatedby; ?>
                </h3>
                <h3>Updated Date:
                    <?= $row->date; ?>
                </h3>
                <h4>Vehicle Type: <?php echo isset($row->vehicletype) ? $row->vehicletype : 'N/A'; ?></h4>
                <h4>Fare Type: <?php echo isset($row->faretype) ? $row->faretype : 'N/A'; ?></h4>
                <h4>Updated Officer Email: <?php echo isset($row->updatedby) ? $row->updatedby : 'N/A'; ?></h4>
                <h4>Updated Date: <?php echo isset($row->date) ? $row->date : 'N/A'; ?></h4>

            </div>
        </div>
        <div class='bttn'>
            <button class="ok-btn" type="submit">OK</button>
        </div>
    </div>

    <script>
    const ok_button = document.querySelector('.ok-btn')

    ok_button.addEventListener('click', () => {
        window.location.href = "<?=ROOT?>/officer/standardFare";
    })
    </script>
</body>

</html>