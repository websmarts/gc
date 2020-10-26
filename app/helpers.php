<?php

function selected_organisation($uuid = null)
{
    $key = 'selected_organisation_uuid';
    
    if($uuid) {
        session()->put($key,$uuid);
            
    } elseif(session()->has($key)){
        return session()->get($key);
    }
}