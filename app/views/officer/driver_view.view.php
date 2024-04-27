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
                <h2>Driver ID: <?php echo isset($row->id) ? $row->id : 'N/A'; ?></h2>
            </div>
            <div class='content'>
                <h4>Driver Name: <?php echo isset($row2->name) ? $row2->name : 'N/A'; ?></h4>
                <h4>Complaint: <?php echo isset($row->complainant) ? $row->complainant : 'N/A'; ?></h4>
                <h4>Complaint: <?php echo isset($row->complaint) ? $row->complaint : 'N/A'; ?></h4>
                <h4>Date and Time: <?php echo isset($row->datetime) ? $row->datetime : 'N/A'; ?></h4>
                <h4>Complaint Status: <?php echo isset($row->status_check) ? $row->status_check : 'N/A'; ?></h4>

            </div>
        </div>
        <div class='bttn'>
            <button class="ok-btn" type="submit">OK</button>
        </div>
    </div>

    <script>
    const ok_button = document.querySelector('.ok-btn')

    ok_button.addEventListener('click', () => {
        window.location.href = "<?=ROOT?>/admin/ride";
    })
    </script>
</body>

</html>