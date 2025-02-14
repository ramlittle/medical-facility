<?php
    function displayDate($datetime){
        return date("Y-m-d", strtotime($datetime));
    }
    function displayYesOrNo($value){
        if($value === 1){
            return 'Yes';
        }
        return 'No';
    }
?>