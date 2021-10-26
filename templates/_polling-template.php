<?php

	if (isset($_POST['localGovermentSearch'])) {
		$polling_unit_id = $_POST['pollingUnitId'];
	}

	$state_id = 25;
	
	if (isset($_POST['pollingUnitSearch'])) {
		$pollingUnitId = $_POST['pollingUnitId'];
	}

	if (empty($pollingUnitId)) {
		$pollingUnitId = 8;
	}

	// calling the getIndividualPollingUnitResult method
	$output = $poll->getIndividualPollingUnitResult($pollingUnitId);

	// calling the getPollingUnit method
	$select_polling_unit = $poll->getPollingUnit($state_id);
	
?>

<div class="container-fluid">
    <div style="min-height: 28rem;">
        <div class="row mt-4">
            <div class="offset-2 col-8">
                <form action="" method="post">
                <div class="form-row">
                    <div class="col">
                    <input type="text" class="form-control" placeholder="Delta State" disabled>
                    </div>
                    <div class="col">
                    <select value='' class="form-control" name="pollingUnitId">
                        <option value="" id="lga0">Select Polling Unit</option>
                        <?php
                            if (is_array($select_polling_unit)) {
                                $kounter = 0;
                                foreach ($select_polling_unit as $key => $value) {
                                    $kounter++;
                                    if (empty($value['polling_unit_name'])) {
                                        continue;
                                    }
                                    ?>
                                    <option value="<?php echo $value['uniqueid']?>" id="<?php echo "lga".$kounter?>"> <?php echo $value['polling_unit_name']?> </option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                    </div>
                    <div class="col">
                    <input type="submit" value="Search" name='pollingUnitSearch' class="form-control btn btn-primary">
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class=" offset-2 col-8 table-responsive">
                <table class="table table-light table-hover table-striped">
                    <thead>
                        <th>S/N</th>
                        <th>Polical Party</th>
                        <th>Total votes</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                            if (is_array($output)) {
                                $kounter = 0;
                                foreach ($output as $key => $value) {
                                    $kounter++;
                                    ?>
                                    <tr>
                                        <td><?php echo $kounter; ?></td>
                                        <td><?php echo $value["party_abbreviation"]; ?></td>
                                        <td><?php echo $value["party_score"]; ?></td>
                                        <td></td>
                                    </tr>
                                <?php
                                }
                            }else{
                                ?>
                                <tr >
                                    <td colspan="3"><div class="alert alert-info">No result available for this Polling Unit</div></td>
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