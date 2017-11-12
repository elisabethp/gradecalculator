<?php 
    $err = "";
    include "calculate_grades.php";
    $setDropdown = array()
    //echo "<pre>";
    //var_dump($_POST);
    //echo count($_POST);
    //echo "</pre>";
    //http://stackoverflow.com/questions/1801499/how-to-change-options-of-select-with-jquery
?>


<html>
    <title>Simple Implementation of Grade Calculator</title>
    <script src="./jquery-3.1.1.min.js"></script>
    <script src="./site.js"></script>
    <link rel="stylesheet" href="./style.css">
    
    <body>
        <div id="site-container">
            <div class="site-col" id="left-col">
                <h2>Grade Calculator</h2>

                <!-- DESCR reword lol -->
                <p>In the form below, enter the grades for your current assignments as well as the overall grade percentage (expressed as a decimal) associated with the assignment.</p>

                <p>Example: For an assignment where you received a 96, enter '96' in the 'Assignment Grade' field. If the assignment is worth 20% of the overall grade, enter '.20' in the 'Percentage of Overall Grade' field.</p>

                <!-- GRADE DISPLAY -->
                <?php
                    if ($formIsValid) {
                        echo "<h3>Your grade in this class is: </h3>" . $currentGrade;
                    }
                ?>

            </div> <!-- end of left-col div-->

            <div class="site-col" id="right-col">
                
                <h3>Graded Assignments</h3>

                <!--ERROR -->
                <span id="error"><?php if ($err != "") { echo $err; } ?> </span>

                <!-- FORM -->
                <form action="./" method="post">

                    <!-- Generate grade items -->
                    <?php
                        

                        for($i = 1; $i <= 5; $i++) {

                            echo "<div class=\"grade-item\">
                                    <span>Assigment " . $i . "</span>
                                    <div>
                                        <span>Grade: </span><input name=\"assgns[]\" type=\"text\"/><br>
                                        <span>Percentage of Overall Grade: </span><input name=\"percents[]\" type=\"text\"/>
                                    </div>
                                 </div>";
                        }

                        for($i = 6; $i <= 10; $i++) {

                            echo "<div class=\"grade-item hidden\">
                                    <span>Assigment " . $i . "</span>
                                    <div>
                                        <span>Grade: </span><input name=\"assgns[]\" type=\"text\"/><br>
                                        <span>Percentage of Overall Grade: </span><input name=\"percents[]\" type=\"text\"/>
                                    </div>
                                 </div>";
                        }

                    ?>
                    
                    <div id="button-container">
                        <input type="button" id="add-button" value="Add Assignment"/>   
                        <input type="submit" value="Calculate Grade"/>
                    </div>

                    
                </form>
            </div> <!-- end of right-col div -->
       </div> <!-- end of site-container -->
    </body>
  
</html>