<?php
include 'config.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from user where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from user where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';
        echo '</script>';
    }
    else if($amount > $sql1['balance']) 
    {
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")'; 
        echo '</script>';
    }
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE user set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
             

                
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE user set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transactions(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='history.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Customer's Details</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="Homestyle.css">
        
        <style type="text/css">
    	
		    button{
			border:none;
			background: #d9d9d9;
		    }
	        button:hover{
			background-color:#777E8B;
			transform: scale(1.1);
			color:white;
		    }

        </style>
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
        <div class="container" style="text-align: center; background-color:grey;" >
        <h2 class="text-center pt-4">Transaction</h2>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  user where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
                <tr>
                    <th class="text-center" style="padding-left: 550px;">Id</th>
                    <th class="text-center" style="padding-left: 15px;">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
                <tr>
                    <td class="py-2" style="padding-left: 550px;"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2" style="padding-left: 10px;"><?php echo $rows['email'] ?></td>
                    <td class="py-2"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br><br><br>
        <label>Transfer To:</label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM user where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: 
                    <?php echo $rows['balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
        <br>
            <label>Amount:</label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
            <button class="btn mt-3" name="submit" type="submit" id="myBtn" style="color: brown; ">Transfer</button>
            </div>
        </form>
    </div>
    <br>
       <footer class="text-center mt-5 py-2" >
       <br>
            <p style="padding-left: 20px;"><b>ADDRESS:</b> Coloba,Mumbai-400001</p>
            <p style="padding-left: 20px;"><b>PHONE:</b> 9867357319</p>
            <p style="padding-left: 20px;"><b>EMAIL:</b>singhmihir77@gmail.com</p>
            <p style="text-align: center;">&copy 2021. Made by <b>MIHIR SINGH</b> <br> </p>
      </footer>

    </body>
</html>

