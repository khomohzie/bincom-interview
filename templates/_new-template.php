<?php

    // Calling the getPoliticalParties method
    $output1 = $newResults->getPoliticalParties();
    
    if (isset($_POST['submitPartyScore'])) {
        
        $registered_user = $_POST['registered_user'];
        $polling_unit_id = $_POST['polling_unit_id'];
        $partyScore = $_POST['partyScore'];
        $user_ip_address =  $_SERVER['REMOTE_ADDR'];

        if (empty($registered_user) || empty($polling_unit_id)) {
            $error_msg = "<div class='alert alert-danger'>Please create a new polling unit before uploading result</div>";
        } else {
            // Calling the insertPoliticalPartiesScore method
            $output2 = $newResults->insertPoliticalPartiesScore($partyScore, $registered_user, $polling_unit_id, $user_ip_address);   
        }
        

    }

?>

<div class="container-fluid">
    <div class="row mt-4" style="min-height: 28rem;">
        <div class="offset-2 col-8">
            <?php
            if(isset($_GET['msg'])){
                echo $_GET['msg'];
            }

            if (isset($output2)) {
                echo $output2;
            }
            if (!empty($error_msg)) {
                echo $error_msg;
            }
            ?>
            <form method="post" action=''>
            <fieldset>
                <legend></legend>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="inputEmail4">Registered User</label>
                    <input type="email" class="form-control" id="inputEmail4" value="<?php if(isset($_GET['reg_user'])){echo $_GET['reg_user'];}?>" name="registered_user" readonly>
                    </div>
                    <div class="form-group col-md-6">
                    <label for="inputPassword4">Polling Unit Id</label>
                    <input type="text" class="form-control" id="inputPassword4" value='<?php if(isset($_GET['unique_id'])){echo $_GET['unique_id'];}?>' name="polling_unit_id" readonly>
                    </div>
                </div>
                <?php
                    if (isset($output1)) {
                        if (is_array($output1)) {
                            foreach ($output1 as $key => $value) {
                                $partyName = $value['partyname'];
                ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputAddress">Political Party Name</label>
                        <input type="text" class="form-control" id="inputAddress" value="<?php echo $value['partyname']?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputAddress2">Result</label>
                        <input type="number" class="form-control" id="inputAddress2" name="partyScore[<?php echo  $partyName; ?>]" min='0'>
                        </div>
                    </div>
                <?php
                            }
                        } else {
                            echo $output1;
                        }
                    }
                ?>
                
                
                <button type="submit" class="btn btn-primary" name='submitPartyScore'>Upload result</button>
            </fieldset>
            </form>
        </div>
    </div>
</div>