<?php 
/**
 * Generate Arabic Letter
 *
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/*
 * By Darien Hager, Jan 2007... Use however you wish, but please
 * please give credit in source comments.
 *
 * Change "UTF-8" to whichever encoding you are expecting to use.
 */
function ords_to_unistr($ords, $encoding = 'UTF-8') {
    // Turns an array of ordinal values into a string of unicode characters
    $str = '';
    for ($i = 0; $i < count($ords); $i++) {
        // Pack this number into a 4-byte string
        // (Or multiple one-byte strings, depending on context.)
        $v = $ords[$i];
        $str .= pack("N",$v);
    }
    $str = mb_convert_encoding($str,$encoding,"UCS-4BE");
    return($str);
}

function unistr_to_ords($str, $encoding = 'UTF-8') {
    // Turns a string of unicode characters into an array of ordinal values,
    // Even if some of those characters are multibyte.
    $str = mb_convert_encoding($str,"UCS-4BE",$encoding);
    $ords = array();

    // Visit each unicode character
    for ($i = 0; $i < mb_strlen($str,"UCS-4BE"); $i++) {
        // Now we have 4 bytes. Find their total
        // numeric value.
        $s2 = mb_substr($str,$i,1,"UCS-4BE");
        $val = unpack("N",$s2);
        $ords[] = $val[1];
    }
    return($ords);
}

function alphabet($firstCharacter = 'A', $lastCharacter = 'Z') {
    $firstCharacterValue = unistr_to_ords($firstCharacter)[0];
    $lastCharacterValue = unistr_to_ords($lastCharacter)[0];

    if ($firstCharacterValue < $lastCharacterValue) {
        for ($character = $firstCharacterValue; $character <= $lastCharacterValue; ++$character) {
            yield ords_to_unistr(array($character));
        };
    } else {
        for ($character = $firstCharacterValue; $character >= $lastCharacterValue; --$character) {
            yield ords_to_unistr(array($character));
        };
    }
}