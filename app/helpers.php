<?php

const MONTHS = [

    '1' => 'January',
    '2' => 'February',
    '3' => 'March',
    '4' => 'April',
    '5' => 'May',
    '6' => 'June',
    '7' => 'July',
    '8' => 'August',
    '9' => 'Septemeber',
    '10' => 'October',
    '11' => 'November',
    '12' => 'December',
];

function format_cents_to_dollar_display($cents=0)
{
    return $cents !=0 ? '$'.number_format($cents/100,2) : 0 ;
}

/**
 * Main function used to detect the currently selecetd organisation
 */
function selectedOrganisation()
{ 
    return auth()->user()->selectedOrganisation();
}

/**
 * Returns the id from a Hashid if hash is valid, otherwise false
 */
function getIdFromHashId($hashid)
{
    $resArry =app()->hasher->decode($hashid);
    return isSet($resArry[0]) ? $resArry[0] : false;
}