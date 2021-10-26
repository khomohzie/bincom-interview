<?php

    // Calling the fetchAllWards method
    $output = $create->fetchAllWards();
    
    if (isset($_POST['new_polling_unit'])) {
    
        // Instantiating object of class Sanitize
        $sanitizeInput = new Sanitize;

        $wardInfo = $_POST['ward_info'];
        $registered_user = $sanitizeInput->sanitizeInputs($_POST['registered_user']);
        $polling_unit_id = $_POST['polling_unit_id'];
        $polling_unit_number = "DT".$_POST['polling_unit_number'];
        $polling_unit_name = $sanitizeInput->sanitizeInputs($_POST['polling_unit_name']);
        $polling_unit_decription = $sanitizeInput->sanitizeInputs($_POST['poling_unit_decription']);

        if (empty($wardInfo)) {
            $message1 = "<li>Ward Name required!</li>";
            $errors[] = $message1;
        }
        
        if (empty($registered_user)) {
            $message2 = "<li>Registered User field required!</li>";
            $errors[] = $message2;
        }
        
        if (empty($_POST['polling_unit_id'])) {
            $message3 = "<li>Polling Unit Id field required!</li>";
            $errors[] = $message3;
        }
        
        if (empty($polling_unit_name)) {
            $message4 = "<li>Polling Unit Name field required!</li>";
            $errors[] = $message4;
        }
        
        if (empty($polling_unit_number)) {
            $message4 = "<li>Polling Unit Number field required!</li>";
            $errors[] = $message4;
        }
        
        if (empty($polling_unit_decription)) {
            $message5 = "<li>Polling Unit Description field required!</li>";
            $errors[] = $message5;
        }

        if (empty($errors)) {

            $ward_info = explode("-", $wardInfo);
            $uniquewardid = $ward_info[0];
            $lga_id = $ward_info[1];
            $ward_id = $ward_info[2];

            // Calling the createNewPollingUnit method
            $create->createNewPollingUnit($polling_unit_id, $ward_id, $lga_id, $uniquewardid, $polling_unit_number, $polling_unit_name, $polling_unit_description, $registered_user);

        }
    }

?>


<div class="container-fluid">
    <div class="row mt-4" style="min-height: 28rem;">
        <div class="offset-2 col-8">
                    <?php
                    if (!empty($errors)) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                        <?php
                        foreach ($errors as $key => $value) {
                            echo $value;
                        }
                        
                        ?>
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" arial-label="close">&times;</button>
                        </div>
                    <?php
                    }


                    if (isset($_GET['msg'])) {
                        echo $_GET['msg'];
                    }
                ?>
            <fieldset>
                <legend>Create Polling Unit</legend>
                <form method='post' action=''>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="inputEmail4">Ward Name</label>
                    <select type="number" class="form-control" id="inputEmail4" name='ward_info' >
                        <option value="">Select Ward</option>
                        <?php
                            if (isset($output)) {
                                if (is_array($output)) {

                                foreach ($output as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['uniqueid']."-".$value['lga_id']."-".$value['ward_id'];  ?>"><?php echo $value['ward_name']; ?></option>
                                <?php
                                }
                                }
                            }
                        ?>
                    </select>
                    </div>
                    <div class="form-group col-md-6">
                    <label for="inputPassword4">Registered User</label>
                    <input type="text" class="form-control" id="inputPassword4" name='registered_user' placeholder="Daniel">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputAddress">Polling Unit Id</label>
                        <input type="number" class="form-control" id="inputAddress" placeholder="16" name="polling_unit_id" min='1'>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputAddress2">Polling Unit Number</label>
                        <input type="number" class="form-control" id="inputAddress2" placeholder="DT1901004" name="polling_unit_number" min='1000'>
                    </div>
                </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                        <label for="inputAddress2">Polling Unit Name</label>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="Primary School in Aghara" name="polling_unit_name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputAddress2">Polling Unit Description</label>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="Primary School in Aghara" name="poling_unit_decription">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control" disabled>
                        <option selected>Delta State</option>
                    </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name='new_polling_unit'>Create</button>
            </form>
            </fieldset>
        </div>
    </div>
</div>