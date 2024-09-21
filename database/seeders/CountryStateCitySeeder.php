<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CountryStateCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = '{
            "countries": [
                {
                    "name": "India",
                    "code": "IN",
                    "states": [
                        {
                            "name": "Andhra Pradesh",
                            "code": "AP",
                            "cities": ["Vijayawada", "Visakhapatnam", "Guntur", "Nellore", "Tirupati"]
                        },
                        {
                            "name": "Karnataka",
                            "code": "KA",
                            "cities": ["Bangalore", "Mysore", "Hubli", "Mangalore", "Belgaum"]
                        }
                    ]
                },
                {
                    "name": "United States",
                    "code": "US",
                    "states": [
                        {
                            "name": "California",
                            "code": "CA",
                            "cities": ["Los Angeles", "San Francisco", "San Diego", "Sacramento", "Fresno"]
                        },
                        {
                            "name": "Texas",
                            "code": "TX",
                            "cities": ["Houston", "Dallas", "Austin", "San Antonio", "Fort Worth"]
                        }
                    ]
                },
                {
                    "name": "Australia",
                    "code": "AU",
                    "states": [
                        {
                            "name": "New South Wales",
                            "code": "NSW",
                            "cities": ["Sydney", "Newcastle", "Wollongong", "Central Coast", "Albury"]
                        },
                        {
                            "name": "Victoria",
                            "code": "VIC",
                            "cities": ["Melbourne", "Geelong", "Ballarat", "Bendigo", "Shepparton"]
                        }
                    ]
                },
                {
                    "name": "United Kingdom",
                    "code": "UK",
                    "states": [
                        {
                            "name": "England",
                            "code": "ENG",
                            "cities": ["London", "Manchester", "Birmingham", "Liverpool", "Bristol"]
                        },
                        {
                            "name": "Scotland",
                            "code": "SCO",
                            "cities": ["Edinburgh", "Glasgow", "Aberdeen", "Dundee", "Inverness"]
                        }
                    ]
                },
                {
                    "name": "Canada",
                    "code": "CA",
                    "states": [
                        {
                            "name": "Ontario",
                            "code": "ON",
                            "cities": ["Toronto", "Ottawa", "Mississauga", "Brampton", "Hamilton"]
                        },
                        {
                            "name": "Quebec",
                            "code": "QC",
                            "cities": ["Montreal", "Quebec City", "Laval", "Gatineau", "Sherbrooke"]
                        }
                    ]
                }
            ]
        }';

        $dataArray = json_decode($data, true);

        foreach ($dataArray['countries'] as $countryData) {
            $country = new Country();
            $country->name = $countryData['name'];
            $country->code = $countryData['code'];
            $country->save();

            Log::info('Country: ' . $country->name);

            foreach ($countryData['states'] as $stateData) {
                $state = new State();
                $state->name = $stateData['name'];
                $state->code = $stateData['code'];
                $state->country_id = $country->id;
                $state->save();

                Log::info('State: ' . $state->name);

                foreach ($stateData['cities'] as $cityName) {
                    $city = new City();
                    $city->name = $cityName;
                    $city->state_id = $state->id;
                    $city->save();

                    Log::info('City: ' . $city->name);
                }
            }
        }
    }
}
