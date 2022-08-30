<?php

function replaceSpaceInNumber($value) 
{
    return (int) str_replace(' ', '', $value);
}
