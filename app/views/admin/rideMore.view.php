<!DOCTYPE html>
<html>
<head>
    <title>More Details of Ride</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/RideMore.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
</head>
<body>

    <div class='outer-box'>
        <div class="wrapper-box">
            <div class='wrapper-hdr'>
                <h2>Ride NO: <?php echo isset($row->id) ? $row->id : 'N/A'; ?></h2>
            </div>
            <div class='content'>        
                <h4>Customer ID: <?php echo isset($row->passenger_id) ? $row->passenger_id : 'N/A'; ?></h4>
                <h4>Customer Name: <?php echo isset($row1->name) ? $row1->name : 'N/A'; ?></h4>
                <h4>Driver ID: <?php echo isset($row->driver_id) ? $row->driver_id : 'N/A'; ?></h4>
                <h4>Driver Name: <?php echo isset($row2->name) ? $row2->name : 'N/A'; ?></h4>
                <h4>Date: <?php echo isset($row->date) ? $row->date : 'N/A'; ?></h4>
                <h4>Pick up Location: <?php echo isset($row->location) ? $row->location : 'N/A'; ?></h4>
                <h4>Destination: <?php echo isset($row->destination) ? $row->destination : 'N/A'; ?></h4>
                <h4>Vehicle Type: <?php echo isset($row->vehicle) ? $row->vehicle : 'N/A'; ?></h4>
                <h4>Distance: <?php echo isset($row->distance) ? $row->distance : 'N/A'; ?></h4>
                <h4>Fare: <?php echo isset($row->fare) ? $row->fare : 'N/A'; ?></h4>     
            </div>    
        </div>
        <div class='bttn'>
            <button class="ok-btn" type="submit">OK</button>
        </div>
    </div>

    <script>
        const ok_button = document.querySelector('.ok-btn') 
        
        ok_button.addEventListener('click', ()=>{
            window.location.href = "<?=ROOT?>/admin/ride";
        })
        
    </script>
</body>
</html>