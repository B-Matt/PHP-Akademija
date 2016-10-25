<?php
header("Content-Type: text/plain");

// Help function for grouping areas alphabetically
function getAreaFromZip($zip) 
{
	$tmp = array();
	$fileLines = file('postanski-uredi.csv', FILE_IGNORE_NEW_LINES);
	foreach ($fileLines as $key => $value) {
		$csvData = explode(',', $value);
		if($csvData[1] == $zip)
			$tmp[] = $csvData[4];
	}
	array_multisort($tmp);
	return $tmp;
}

$fileLines = file('postanski-uredi.csv', FILE_IGNORE_NEW_LINES);

$postalOfficesByRegion = array();
$tmpPostOffice;

foreach ($fileLines as $key => $value) 
{
    $csvData = explode(',', $value);
    if( isset($tmpPostOffice) && $csvData[3] !== $tmpPostOffice) 
    {
            $postalOfficesByRegion[$csvData[5]][] = [
                    'name' 	=> $csvData[3],
                    'zip' 	=> $csvData[1],
                    'area' 	=> getAreaFromZip($csvData[1])
            ];
    }
    $tmpPostOffice = $csvData[3];
}

function getRegionName($area)
{
	$returnString = 'Traženo naselje se ne nalazi ovdje!';
	foreach($GLOBALS['postalOfficesByRegion'] as $region => $value) 
	{
		foreach($value as $zip => $tmp) 
		{
			if(in_array(strtolower($area), array_map("strtolower", $GLOBALS['postalOfficesByRegion'][$region][$zip]['area'])))
			{
				$returnString = 'Traženo naselje se nalazi ovdje!';
				break 2;
			}
		}
	}
	return $returnString;
}

array_shift($postalOfficesByRegion);
ksort($postalOfficesByRegion);

// Print functions
echo getRegionName('Osijek') . PHP_EOL . PHP_EOL;
print_r($postalOfficesByRegion);
