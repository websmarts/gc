<?php

function format_cents_to_dollar_display($cents=0)
{
    return $cents !=0 ? '$'.number_format($cents/100,2) : 0 ;
}