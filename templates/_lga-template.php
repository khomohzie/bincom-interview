<?php

    if (isset($_POST['localGovermentSearch'])) {

        if (empty($_POST['lga_info'])) {
            $searchError = "<p class='form-text text-danger'>Select Local Government<p>";
        } else {
            $lga_info = $_POST['lga_info'];
            $lgaInfo = explode("-", $lga_info);
            $lga_id = $lgaInfo[0];
            $lga_name = $lgaInfo[1];

            // Calling the getTotalResultFromLocalGovernment method
            $output1 = $lga->getTotalResultFromLocalGovernment($lga_id);
        }

    }

    $state_id = 25;	

    // Calling the getAllLocalGovermentsFromSingleState method
    $output2 = $lga->getAllLocalGoverments($state_id);

?>

<div class="container-fluid" >
    <div style="min-height: 28rem;">
        <div class="row mt-5">
            <div class="offset-2 col-8">
                <?php

                if(isset($lga_name)){
                ?>
                <h2>Result for <?php echo $lga_name; ?> LGA</h2>
                <?php
                }

                ?>
                <form method="post" action=''>
                <div class="form-row">
                    <div class="col">
                    <input type="text" class="form-control" placeholder="Delta State" disabled>
                    </div>
                    <div class="col">
                    <select  class="form-control" name="lga_info" onchange="">
                        <option value="" id="lga_0">Local Goverment</option>
                        <?php
                            if (is_array($output2)) {
                                $counter = 0;
                                foreach ($output2 as $key => $value) {
                                    $counter++
                                    ?>
                                    <option value="<?php echo $value['lga_id']."-".$value['lga_name'];?>" id="<?php echo "lga".$counter?>"> <?php echo $value['lga_name']?> </option>
                                    <?php
                                }
                            }
                        ?>
                    </select>

                    </div>
                    <div class="col">
                    <input type="submit" value="Search" name='localGovermentSearch' class="form-control btn btn-primary">
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="row mt-2">
            <div class=" offset-2 col-8 table-responsive">
                <table class="table table-light table-hover table-striped">
                    <thead>
                        <th>S/N</th>
                        <th>Polical Parties</th>
                        <th>Total votes</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                            if (isset($output1)) {
                                if (is_array($output1)) {
                                    $counter = 0;
                                    foreach ($output1 as $key => $value) {
                                        $counter++;
                                        ?>
                                        <tr> 	
                                            <td><?php echo $counter; ?></td>
                                            <td><?php echo $value["party_abbreviation"]; ?></td>
                                            <td><?php echo $value["total_result"]; ?></td>
                                            <td></td>
                                        </tr>
                                    <?php
                                    }
                                }else{
                                    ?>
                                    <tr >
                                        <td colspan="3"><div class="alert alert-info">No result available for this Local Government</div></td>
                                    <tr>
    
                                    <?php
                                }
                            }else{
                                ?>
                                    <tr >
                                        <td colspan="3"><div class="alert alert-info">Results will appear here</div></td>
                                    <tr>
    
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
                <?php

                ?>
            </div>
        </div>
    </div>
</div>