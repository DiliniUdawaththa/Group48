<!DOCTYPE html>
<html>

<head>
    <title>Add Comment</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/RideMore.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/Officer.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
</head>

<body>

    <div class='interface'>
        <div class="navi">
            <div class='navi1'>
                <h2>Officer Comment</h2>

            </div>
        </div>
        <center>
            <div class='officer_form'>
                <form name="addcomment" action="" method="post" onsubmit="return validateForm()">
                    <div class="officer_box">
                        <?php foreach ($rows as $row) : ?>
                        <div><label for="officerCmnt" class="label">Officer Comment</label><br></div>
                        <input value="<?= $row->officerCmnt; ?>" type="text" name="officerCmnt"
                            class="<?=!empty($errors['officerCmnt']) ? 'error':'';?>" required>
                        <?php if(!empty($errors['officerCmnt'])):?>
                        <small id="Firstname-error" class="signup-error" style="color: red;">
                            <?=$errors['address']?></small>
                        <?php endif;?><br>


                        <div class="btn">
                            <a href="<?=ROOT?>/officer/complains"><button id="submit_btn"
                                    class="submit_btn">Submit</button></a>
                            <a href="<?=ROOT?>/officer/complains"><small class="skip">
                                    <center>Cancel</center>
                                </small></a>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </form>
            </div>
        </center>
    </div>
    </div>

    <script>
    const table = document.querySelector('.table1')
    const form = document.querySelector('.officer_form')
    const skip = document.querySelector('.skip')
    const operation = document.getElementById('submit_btn')

    const categoryInput = document.getElementById('cmt_id');

    categoryInput.addEventListener('input', function() {
        const enteredValue = this.value;
        const options = document.getElementById('complaint').getElementsByTagName('option');
        let validOption = false;

        for (let i = 0; i < options.length; i++) {
            if (options[i].value === enteredValue) {
                validOption = true;
                break;
            }
        }

        if (!validOption) {
            // Clear the input if the entered value is not in the datalist
            this.value = '';
        }
    });
    </script>


</body>

</html>