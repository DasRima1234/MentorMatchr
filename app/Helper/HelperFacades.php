<?php

namespace App\Helper;

use App\Models\Countries;

class HelperFacades
{
    public static function getCountryDropdown($Selected = '')

    {
        $sqlRow = Countries::IsActive(1)
            ->orderBy('CountryName')
            ->get();

        $valList = '';
        if (count($sqlRow) > 0) {
            if (!empty($Selected)) {
                $valSelct = $Selected;
            } else {
                $valSelct = 'IN';
            }
            foreach ($sqlRow as $DataValue) {
                $valList .=
                    '<option value="' .
                    $DataValue->country_code .
                    '"' .
                    ($DataValue->country_code == $valSelct || $DataValue->CountryName == $valSelct
                        ? 'selected="selected"'
                        : '') .
                    ' >' .
                    stripslashes($DataValue->CountryName) .
                    '</option>';
            }
        }
        return $valList;
    }
}
