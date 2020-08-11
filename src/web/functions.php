<?php
/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param array $airports
 * @return string[]
 */
function getUniqueFirstLetters(array $airports)
{
    $letters = [];
    foreach ($airports as $airport) {
        $currentLetter = substr($airport['name'], 0, 1);
        $letters[] = $currentLetter;
    }
    $first = array_unique($letters);
    sort($first);

    return $first;
}


function filteringAirportByFirstLetter($airports, $letter)
{
    $result = [];
    foreach ($airports as $airport) {
        if ($airport['name'][0] === $letter) {
            $result[] = $airport;
        }
    }

    return $result;
}


function filterAirportByState($airports)
{
    $columns = array_column($airports, 'state');
    array_multisort($columns, SORT_ASC, $airports);

    return $airports;
}


function filterAirportByName($airports)
{
    $columns = array_column($airports, 'name');
    array_multisort($columns, SORT_ASC, $airports);
    return $airports;

}


function filterAirportByCity($airports)
{
    $columns = array_column($airports, 'city');
    array_multisort($columns, SORT_ASC, $airports);

    return $airports;
}


function filterAirportByCode($airports)
{
    $columns = array_column($airports, 'code');
    array_multisort($columns, SORT_ASC, $airports);

    return $airports;
}


function SortByState($airports, $state)
{
    return array_filter($airports, function ($airports) use ($state) {

        return $airports['state'] == $state;
    });
}