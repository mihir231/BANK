<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bank </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="Homestyle.css">
        
    </head>
    
    <body>
        <div class="top">
            <div id="logo">
                <img src="bank.jpeg" alt="Bank logo" height="90px" width="110px" style="float: left; padding-left: 10px;">
            </div>
            <div id="logo">
                <img src="bank.jpeg" alt="Bank logo" height="90px" width="110px" style="float: right; padding-right: 10px;">
            </div>
            <div id="heading"  style="text-align: center;">
                <header style="text-align: center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 71px; float: unset; ">
                   Bank 
                </header>
                <hr>   
            </div>
        </div>

        <div class="navbar">
            <a href="index.php">Home</a>
            <a href="customer's.php">Customers</a>
            <a href="transfer.php">Transfer Money</a>
            <a href="history.php">History</a>
            
        </div>

        <div class="container" style="background-color: #BDC3C7;">
            <h2 class="text-center pt-4" style="color: black; text-align: center;">Transfer History</h2>
        
            <br>
          <div class="table-responsive-sm">
                <table  id="tabledesign" class="table table-hover table-striped table-condensed table-bordered" style="border-color:black;">
                    <thead>
                         <tr>
                            <th class="text-center">S.No.</th>
                            <th class="text-center">Sender</th>
                            <th class="text-center">Receiver</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                         include 'config.php';

                         $sql ="SELECT * from transactions";

                        $query =mysqli_query($conn,$sql);

                         while($rows = mysqli_fetch_assoc($query)) 
                         {
                        ?>

                         <tr>
                           <td class="py-2"><?php echo $rows['sno']; ?></td>
                           <td class="py-2"><?php echo $rows['sender']; ?></td>
                           <td class="py-2"><?php echo $rows['receiver']; ?></td>
                           <td class="py-2"><?php echo $rows['balance']; ?> </td>
                           <td class="py-2"><?php echo $rows['datetime']; ?> </td>
                
                         <?php
                         }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <footer class="text-center mt-5 py-2" >
            <br>
            <br>
            <p style="padding-left: 20px;"><b>ADDRESS:</b> Coloba,Mumbai-400001</p>
            <p style="padding-left: 20px;"><b>PHONE:</b> 9867357319</p>
            <p style="padding-left: 20px;"><b>EMAIL:</b>singhmihir77@gmail.com</p>
            <p style="text-align: center;">&copy 2021. Made by <b>MIHIR SINGH</b> <br> </p>
        </footer>
    </body>
<html>