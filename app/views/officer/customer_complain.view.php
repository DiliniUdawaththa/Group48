<!DOCTYPE html>
<html>

<head>
    <title>More Details of Customer Complains</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/RideMore.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Officer/more.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">

</head>


<body>

    <div class='outer-box'>
        <div class="wrapper-box">
            <div class='wrapper-hdr'>
                <h2>Complain Details</h2>
            </div>
            <div class='content'>
                <table>
                    <thead>
                        <tr>
                            <td>Complainant</td>
                            <td>Complaint</td>
                            <td>Complain Date</td>
                            <td>Status</td>

                        </tr>
                    </thead>
                    <?php foreach ($rows as $row) : ?>
                    <tr class="data">
                        <td><?= $row->complainant ?></td>
                        <td><?= $row->complaint?></td>
                        <td><?= $row->datetime?></td>
                        <td><?php if ($row->status_check == 0) {
                            echo 'Pending';
                        } elseif ($row->status_check == 1) {
                            echo 'Investigated';
                            } elseif ($row->status_check == 2) {
                                echo 'Rejected';
                            } ?></td>

                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <div class='bttn'>
            <button class="ok-btn" type="submit">OK</button>
        </div>
    </div>

    <script>
    const ok_button = document.querySelector('.ok-btn')

    ok_button.addEventListener('click', () => {
        window.location.href = "<?=ROOT?>/officer/customer";
    })
    </script>
</body>

</html>