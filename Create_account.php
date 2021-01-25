<?php
// Include config file
require_once "Config.php";
 
// Define variables and initialize with empty values
$accountname = $address = $confirm_address = "";
$accountname_err = $address_err = $confirm_address_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // ValAidate accountname
    if(empty(trim($_POST["accountname"]))){
        $accountname_err = "Please enter an accountname.";
    } else{
        // Prepare a select statement
        $sql = "SELECT Aid FROM Accounts WHERE accountname = :accountname";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":accountname", $param_uname, PDO::PARAM_STR);
            
            // Set parameters
            $param_accountname = trim($_POST["accountname"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $accountname_err = "This accountname is already taken.";
                } else{
                    $accountname = trim($_POST["accountname"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    



    // ValAidate address
    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter a address.";     
    } elseif(strlen(trim($_POST["address"])) < 6){
        $address_err = "address must have atleast 6 characters.";
    } else{
        $address = trim($_POST["address"]);
    }
    
    // ValAidate confirm address
    if(empty(trim($_POST["confirm_address"]))){
        $confirm_address_err = "Please confirm address.";     
    } else{
        $confirm_address = trim($_POST["confirm_address"]);
        if(empty($address_err) && ($address != $confirm_address)){
            $confirm_address_err = "address dAid not match.";
        }
    }



    
    // Check input errors before inserting in database
    if(empty($accountname_err) && empty($address_err) && empty($confirm_address_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO Accounts (accountname, address) VALUES (:accountname, :address)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":accountname", $param_accountname, PDO::PARAM_STR);
            $stmt->bindParam(":address", $param_address, PDO::PARAM_STR);
            
            // Set parameters
            $param_accountname = $accountname;
            $param_address = $address; 
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: Create_Account.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create an account</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ wAidth: 350px; padding: 20px; }
    </style>
</head>
<body>  



    <div class="wrapper">
        <h2>Create an account</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($accountname_err)) ? 'has-error' : ''; ?>">
                <label>accountname</label>
                <input type="text" name="accountname" class="form-control" value="<?php echo $accountname; ?>">
                <span class="help-block"><?php echo $accountname_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                <label>address</label>
                <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                <span class="help-block"><?php echo $address_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_address_err)) ? 'has-error' : ''; ?>">
                <label>Confirm address</label>
                <input type="address" name="confirm_address" class="form-control" value="<?php echo $confirm_address; ?>">
                <span class="help-block"><?php echo $confirm_address_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" onclick="alert('Successfully Done!')">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>	



	
            <p>Already have an account? <a href="Create_Opportunity_form.php">Create Opportunities</a>.</p>
	
		
        </form>
    </div>    
</body>
</html>