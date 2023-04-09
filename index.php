<?php
$countries =  json_decode(file_get_contents('countries.json'), true);
$states    =  json_decode(file_get_contents('states.json'), true);
$cities    =  json_decode(file_get_contents('cities.json'), true);

$countriesWithStatesAndCities = [];

foreach ($countries['countries'] as $country) {
    foreach ($states['states'] as $state) {
        if ($state['country_id'] == $country['id']) {
            $countriesWithStatesAndCities[$country['name']]['states'][] = $state['name'];
            foreach ($cities['cities'] as $city) {
                if ($city['state_id'] == $state['id']) {
                    $countriesWithStatesAndCities[$country['name']]['cities'][] = $city['name'];
                }
            };
        }
    }
}

file_put_contents('places.json', json_encode($countriesWithStatesAndCities));
