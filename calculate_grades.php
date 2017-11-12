<?php
//php -S localhost:8000

    $formIsValid = false;
    $currentGrade;
    $sumOfPercents; 
    $whereDecimal; 
    $whereZero;
    $stoppingPoint;

    calculateGrade();

    function calculateGrade() {
        global $formIsValid, $err, $currentGrade, $sumOfPercents, $stoppingPoint;
        
        //check to see if POST is holding data
        if (count($_POST) == 0) { //in case it is the first visit to the page
            return;
        }
        
        $assgns = $_POST["assgns"];
        $percents = $_POST["percents"];
        
        //VALIDATION: check to see if each qualified assgns index has a qualified percents index counterpart                
        for ($i = 0; $i < count($assgns); $i++) {
            
            //are the fields numeric pairs?
            if (is_numeric($assgns[$i]) && is_numeric($percents[$i])) { 
                
                // if numeric, check to see if negative -- if so, return an err
                if ($assgns[$i] < 0 || $percents[$i] < 0) { 
                    $err = "Please do not enter negative numbers.";
                    return;
                }
                
                //now check to see if user entered in the percentage as a decimal in the form of ".89" or "0.89"
                $whereDecimal = strpos($percents[$i], ".");
                $whereZero = strpos($percents[$i], "0");
                
                if (floatval($percents[$i]) > 1 || floatval($percents[$i]) < 0 || $percents[$i] == ".0") {
                    $err = "Check your percent values and try again. Remember to express all percents in decimal form.";
                    return;
                }
                
                //check to see if the grade is less than or equal to 100
                if ($assgns[$i] > 100) {
                    $err = "Check your grade values and try again.";
                    return;
                }
    
                //no need for further tests.. move on to next index pairs
                continue;    
            }
            
            //are both fields non-numeric? 
            //this could mean that the fields are empty (good) OR have unsupported characters in them (bad)
            if (!is_numeric($assgns[$i]) && !is_numeric($percents[$i])) { 
                
                //in case that the rest of the form is empty, need to know where numbers stop
                $stoppingPoint = $i;
                
                if ($i == 0 && ($assgns[$i] == "" && $percents[$i] == "") ) {
                    $err = "Fill out the form.";
                    return;
                }
                
                //if there is at least one pair, then the rest of the form needs to be empty
                for ($i = $i; $i < count($assgns); $i++) {
                    
                    if ($assgns[$i] == "" && $percents[$i] == "") { //MUST be empty strings
                        continue;
                    }
                    else { //if the rest of the form is not empty return an error
                        $err = "Please fill out the fields consecutively using only number values.";
                        return;
                    }
                }
                
                //rest of the form is empty.. sooooooo no need to iterate further
                break;
                
            }
            
            //at this point, input is invalid
            $err = "Fill out the form with numbers and try again.";
            return;
            
        }
        
        $formIsValid = true; 
        
        //calculate the grade and change the currentGrade variable
        for ($i = 0; $i < $stoppingPoint; $i++) {
            $currentGrade += ($assgns[$i] * $percents[$i]);
            $sumOfPercents += $percents[$i];
        }

        $currentGrade = $currentGrade / $sumOfPercents;
    }
    
//http://members.logical.net/~marshall/uab/howtocalculategrade.html

?>