<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Trip;
use App\Models\Accommodation;
use App\Models\Supplement;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Countries with more data
        $countries = [
            [
                'name' => 'USA',
                'image' => 'https://source.unsplash.com/featured/?usa',
                'description' => 'The United States of America, a country of immense diversity, from the skyscrapers of New York to the beaches of California.',
                'currency' => 'USD',
                'continent' => 'North America'
            ],
            [
                'name' => 'Italy',
                'image' => 'https://source.unsplash.com/featured/?italy',
                'description' => 'Italy, the heart of ancient civilization and the Renaissance, with its iconic cities like Rome, Venice, and Florence.',
                'currency' => 'EUR',
                'continent' => 'Europe'
            ],
            [
                'name' => 'Japan',
                'image' => 'https://source.unsplash.com/featured/?japan',
                'description' => 'Japan, a perfect blend of traditional culture and futuristic technology, home to Mount Fuji and beautiful temples.',
                'currency' => 'JPY',
                'continent' => 'Asia'
            ],
        ];

        foreach ($countries as $countryData) {
            $country = Country::create($countryData);

            // Create Trips for each Country
            $trips = [
                [
                    'name' => 'Grand Canyon Tour',
                    'description' => 'Explore the magnificent Grand Canyon, one of the most iconic natural landmarks in the USA.',
                    'image' => 'https://source.unsplash.com/featured/?grand-canyon',
                    'price' => 1500.00,
                    'duration' => 5, // 5 days
                ],
                [
                    'name' => 'Venice City Tour',
                    'description' => 'Discover the romance and history of Venice, a city built on water.',
                    'image' => 'https://source.unsplash.com/featured/?venice',
                    'price' => 1200.00,
                    'duration' => 3, // 3 days
                ],
                [
                    'name' => 'Mount Fuji Hike',
                    'description' => 'Hike the majestic Mount Fuji, Japan’s tallest peak.',
                    'image' => 'https://source.unsplash.com/featured/?mount-fuji',
                    'price' => 1800.00,
                    'duration' => 7, // 7 days
                ],
            ];

            foreach ($trips as $tripData) {
                $trip = $country->trips()->create($tripData);

                // Create Accommodations for each Trip
                $accommodations = [
                    [
                        'name' => 'Luxury Hotel',
                        'price' => 300.00,
                        'image' => 'https://source.unsplash.com/featured/?luxury-hotel',
                        'rating' => 5
                    ],
                    [
                        'name' => 'Budget Inn',
                        'price' => 100.00,
                        'image' => 'https://source.unsplash.com/featured/?budget-hotel',
                        'rating' => 3
                    ],
                ];

                foreach ($accommodations as $accommodationData) {
                    $trip->accommodations()->create($accommodationData);
                }

                // Create Supplements for each Trip
                $supplements = [
                    [
                        'name' => 'Snorkeling',
                        'price' => 75.00,
                        'description' => 'Enjoy a snorkeling experience with beautiful underwater life.',
                        'image' => 'https://source.unsplash.com/featured/?snorkeling',
                        'difficulty_level' => 'easy'
                    ],
                    [
                        'name' => 'Rock Climbing',
                        'price' => 150.00,
                        'description' => 'Challenge yourself with an exhilarating rock climbing session.',
                        'image' => 'https://source.unsplash.com/featured/?rock-climbing',
                        'difficulty_level' => 'hard'
                    ],
                ];

                foreach ($supplements as $supplementData) {
                    $trip->supplements()->create($supplementData);
                }
            }
        }
    }
}
