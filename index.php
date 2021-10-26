<?php
    ob_start();
    // Include header.php file
    include ('header.php');
?>
    
    <a class="page-links" href="answers/polling-unit1.php">
        <div class="polling-result result">
            <h3>Polling Units & Results</h3>
        </div>
    </a>

    <a class="page-links" href="answers/lga2.php">
        <div class="lga-result result">
            <h3>Local Government Area & Results</h3>
        </div>
    </a>

    <a class="page-links" href="answers/new-result3.php">
        <div class="upload-result result">
            <h3>Upload Results of New Polling Units</h3>
        </div>
    </a>
    

<?php
// Include footer.php file
include ('footer.php');
?>