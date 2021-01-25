<?php
// Include config file
require_once "Config.php";
 
// Define variables and initialize with empty values
$opportunity = $amount = $stage =  $proposal="";
$opportunity_err = $amount_err = $stage_err = $proposal_err="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // ValOidate opportunity
    if(empty(trim($_POST["opportunity"]))){
        $opportunity_err = "Please enter an opportunity.";
    } else{
        // Prepare a select statement
        $sql = "SELECT Oid FROM Opportunities WHERE opportunity = :opportunity";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":opportunity", $param_uname, PDO::PARAM_STR);
            
            // Set parameters
            $param_opportunity = trim($_POST["opportunity"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $opportunity_err = "This opportunity name is already taken.";
                } else{
                    $opportunity = trim($_POST["opportunity"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    



    // ValOidate amount
    if(empty(trim($_POST["amount"]))){
        $amount_err = "Please enter an amount.";     
    } 
     else{
        $amount = trim($_POST["amount"]);
    }
    
    // ValOidate stage
    if(empty(trim($_POST["stage"]))){
        $stage_err = "Please enter stage.";     
    } else{
        $stage = trim($_POST["stage"]);
        
    }

 	// ValOidate proposal
    if(empty(trim($_POST["proposal"]))){
        $proposal_err = "Please enter proposal.";     
    } else{
        $proposal = trim($_POST["proposal"]);
        
    }




    
    // Check input errors before inserting in database
    if(empty($opportunity_err) && empty($amount_err) && empty($stage_err) && empty($proposal_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO Opportunities (opportunity, amount, stage, proposal) VALUES (:opportunity, :amount, :stage, :proposal)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":opportunity", $param_opportunity, PDO::PARAM_STR);
            $stmt->bindParam(":amount", $param_amount, PDO::PARAM_STR);
	    $stmt->bindParam(":stage", $param_stage, PDO::PARAM_STR);
	    $stmt->bindParam(":proposal", $param_proposal, PDO::PARAM_STR);

            
            // Set parameters
            $param_opportunity = $opportunity;
            $param_amount = $amount; 
	    $param_stage = $stage; 
	    $param_proposal = $proposal; 
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: Create_opportunity_form.php");
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
	<meta charset = "UTF-8">
	<title>Create Opportunity form</title>
</head>
<body>
	<h1>Create Opportunity</h1>
	<p>Please fill this form</p>

	
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

	    <div class="form-group <?php echo (!empty($opportunity_err)) ? 'has-error' : ''; ?>">
                <label>opportunity</label>
                <input type="text" name="opportunity" class="form-control" value="<?php echo $opportunity; ?>">
                <span class="help-block"><?php echo $opportunity_err; ?></span>
            </div>   </br>	
            <div class="form-group <?php echo (!empty($amount_err)) ? 'has-error' : ''; ?>">
                <label>amount</label>
                <input type="text" name="amount" class="form-control" value="<?php echo $amount; ?>">
                <span class="help-block"><?php echo $amount_err; ?></span>
            </div>    </br>
            <div class="form-group <?php echo (!empty($stage_err)) ? 'has-error' : ''; ?>">
                <label>stage</label>
                <input type="text" name="stage" class="form-control" value="<?php echo $stage; ?>">
                <span class="help-block"><?php echo $stage_err; ?></span>
            </div> </br>
            <div class="form-group <?php echo (!empty($proposal_err)) ? 'has-error' : ''; ?>">
                <label>Proposal</label>
                <input type="text" name="proposal" class="form-control" value="<?php echo $proposal; ?>">
                <span class="help-block"><?php echo $proposal_err; ?></span>
            </div> </br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" onclick="alert('Successfully Done!')">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>	



	
            
	
		
        </form>
	
	
</body>	
</html>