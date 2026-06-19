<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\TravelPackage;
use App\Models\TravelPackageImage;
use App\Models\Destination;

class TravelPackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            // UBUD 
            [
                'destination'      => 'Ubud',
                'title'            => 'Ubud Cultural Immersion',
                'description'      => 'Spend four days exploring Ubud\'s iconic rice terraces, ancient temples, and traditional Kecak fire dance. Includes a batik workshop and a cooking class with a local family.',
                'price'            => 2800000,
                'duration_days'    => 4,
                'max_people'       => 10,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1531592937781-344ad608fabf?w=800&q=80&fit=crop',
                ],
                
            ],
            [
                'destination'      => 'Ubud',
                'title'            => 'Ubud Wellness Retreat',
                'description'      => 'A five-day sanctuary of yoga, traditional Balinese healing massages, and meditation in the jungle. Includes sunrise yoga, sound healing, and a purification ceremony at Tirta Empul.',
                'price'            => 4200000,
                'duration_days'    => 5,
                'max_people'       => 8,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1604999333679-b86d54738315?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1558005530-a7958896ec60?w=800&q=80&fit=crop',
                ],
            ],

            // TEGALLALANG
            [
                'destination'      => 'Tegallalang',
                'title'            => 'Tegallalang Rice Terrace Trek',
                'description'      => 'A guided morning trek through the world-famous UNESCO rice terraces of Tegallalang. Includes breakfast at a clifftop warung and a visit to a traditional water temple.',
                'price'            => 750000,
                'duration_days'    => 1,
                'max_people'       => 12,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1531592937781-344ad608fabf?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?w=800&q=80&fit=crop',
                ],
            ],

            //  GOA GAJAH 
            [
                'destination'      => 'Goa Gajah',
                'title'            => 'Ancient Temples Day Tour',
                'description'      => 'Explore Goa Gajah\'s 11th century elephant cave and sacred bathing pools, followed by a visit to Pura Kehen — one of Bali\'s most important state temples.',
                'price'            => 650000,
                'duration_days'    => 1,
                'max_people'       => 15,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1604999333679-b86d54738315?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80&fit=crop',
                ],
            ],

            //  SEMINYAK ─
            [
                'destination'      => 'Seminyak',
                'title'            => 'Seminyak Beach Club Experience',
                'description'      => 'Three days of pure indulgence — private beach club access, sunset cocktails at Potato Head, and a guided shopping tour through Bali\'s most stylish boutiques.',
                'price'            => 3500000,
                'duration_days'    => 3,
                'max_people'       => 8,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1573790387438-4da905039392?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1504450758481-7338eba7524a?w=800&q=80&fit=crop',
                ],
            ],
            [
                'destination'      => 'Seminyak',
                'title'            => 'Seminyak Surf and Style',
                'description'      => 'A four-day package combining morning surf lessons on Seminyak\'s famous breaks with afternoons exploring the area\'s art galleries, spas, and rooftop bars.',
                'price'            => 4100000,
                'duration_days'    => 4,
                'max_people'       => 6,
                'difficulty_level' => 'moderate',
                'images'           => [
                    'https://images.unsplash.com/photo-1505118380757-91f5f5632de0?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1504450758481-7338eba7524a?w=800&q=80&fit=crop',],
            ],

            //  KUTA ─
            [
                'destination'      => 'Kuta',
                'title'            => 'Kuta Surf Beginner Course',
                'description'      => 'A three-day intensive surf course designed for complete beginners. Certified instructors, quality boards, and Kuta\'s famously forgiving waves make this the perfect first surf experience.',
                'price'            => 1800000,
                'duration_days'    => 3,
                'max_people'       => 8,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1505118380757-91f5f5632de0?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1573790387438-4da905039392?w=800&q=80&fit=crop',
                ],
            ],
            [
                'destination'      => 'Kuta',
                'title'            => 'Kuta Family Beach Package',
                'description'      => 'A five-day family-friendly package with supervised kids\' surf lessons, dolphin watching, visits to Waterbom Park, and sunset walks along Kuta\'s famous long beach.',
                'price'            => 5500000,
                'duration_days'    => 5,
                'max_people'       => 20,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1504450758481-7338eba7524a?w=800&q=80&fit=crop',
                ],
            ],

            //  CANGGU ─
            [
                'destination'      => 'Canggu',
                'title'            => 'Canggu Surf and Yoga',
                'description'      => 'The ultimate Canggu lifestyle — morning surfs at Echo Beach, afternoon yoga classes, evenings at rooftop bars overlooking rice paddies. Includes five nights in a designer villa.',
                'price'            => 5200000,
                'duration_days'    => 6,
                'max_people'       => 10,
                'difficulty_level' => 'moderate',
                'images'           => [
                    'https://images.unsplash.com/photo-1604999333679-b86d54738315?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1505118380757-91f5f5632de0?w=800&q=80&fit=crop',
                ],
            ],
            [
                'destination'      => 'Canggu',
                'title'            => 'Canggu Digital Nomad Experience',
                'description'      => 'A week in Canggu\'s creative scene — co-working space access, startup networking events, surf evenings, and a guided tour of the best cafes and hidden warungs.',
                'price'            => 3800000,
                'duration_days'    => 7,
                'max_people'       => 12,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1604999333679-b86d54738315?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1573790387438-4da905039392?w=800&q=80&fit=crop',
                ],
            ],

            //  ULUWATU 
            [
                'destination'      => 'Uluwatu',
                'title'            => 'Uluwatu Cliff Temple and Kecak Sunset',
                'description'      => 'An afternoon tour to Uluwatu\'s dramatic clifftop temple, followed by the iconic Kecak fire dance performance at sunset with the Indian Ocean as the backdrop.',
                'price'            => 900000,
                'duration_days'    => 1,
                'max_people'       => 20,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1504450758481-7338eba7524a?w=800&q=80&fit=crop',
                ],
            ],
            [
                'destination'      => 'Uluwatu',
                'title'            => 'Uluwatu Surf Safari',
                'description'      => 'Three days exploring Uluwatu\'s legendary breaks — Padang Padang, Bingin, and Impossibles. Includes a surf guide, photography, and cliff-edge accommodation.',
                'price'            => 3200000,
                'duration_days'    => 3,
                'max_people'       => 6,
                'difficulty_level' => 'hard',
                'images'           => [
                    'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1505118380757-91f5f5632de0?w=800&q=80&fit=crop',
                ],
            ],

            //  NUSA DUA 
            [
                'destination'      => 'Nusa Dua',
                'title'            => 'Nusa Dua Water Sports Day',
                'description'      => 'A full day of adrenaline on the calm lagoon — parasailing, jet skiing, banana boat, and snorkelling. Perfect for groups and families.',
                'price'            => 1200000,
                'duration_days'    => 1,
                'max_people'       => 20,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?w=800&q=80&fit=crop',
                ],
            ],
            [
                'destination'      => 'Nusa Dua',
                'title'            => 'Nusa Dua Luxury Honeymoon',
                'description'      => 'A five-day romantic escape — private beach villa, couples spa treatments, sunset sailing, candlelit seafood dinners, and a flower petal bath on arrival.',
                'price'            => 12000000,
                'duration_days'    => 5,
                'max_people'       => 2,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1602491453631-e2a5ad90a131?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80&fit=crop',
                ],
            ],

            //  JIMBARAN 
            [
                'destination'      => 'Jimbaran',
                'title'            => 'Jimbaran Seafood Sunset Dinner',
                'description'      => 'An evening experience on Jimbaran\'s famous seafood beach — fresh grilled lobster, prawns, and fish served at a candlelit table on the sand as the sun sets over the bay.',
                'price'            => 850000,
                'duration_days'    => 1,
                'max_people'       => 20,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1602491453631-e2a5ad90a131?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1504450758481-7338eba7524a?w=800&q=80&fit=crop',
                ],
            ],

            //  LOVINA 
            [
                'destination'      => 'Lovina',
                'title'            => 'Lovina Dolphin Sunrise Tour',
                'description'      => 'Set off before dawn on a traditional jukung boat to watch hundreds of wild spinner dolphins leaping in the morning light off Lovina\'s black sand coast.',
                'price'            => 600000,
                'duration_days'    => 1,
                'max_people'       => 8,
                'difficulty_level' => 'easy',
                'images'           => ['
                    https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80&fit=crop',
                ],
            ],
            [
                'destination'      => 'Lovina',
                'title'            => 'North Bali Cultural Discovery',
                'description'      => 'Three days exploring Bali\'s quiet north — dolphins at sunrise, hot springs at Banjar, waterfalls at Gitgit, and the colonial charm of Singaraja.',
                'price'            => 2200000,
                'duration_days'    => 3,
                'max_people'       => 10,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1558005530-a7958896ec60?w=800&q=80&fit=crop',
                ],
            ],

            //  MUNDUK 
            [
                'destination'      => 'Munduk',
                'title'            => 'Munduk Waterfall and Plantation Trek',
                'description'      => 'A two-day trek through Munduk\'s misty highlands — four waterfalls, clove and coffee plantations, twin lakes at sunset, and overnight stay in a traditional mountain lodge.',
                'price'            => 1600000,
                'duration_days'    => 2,
                'max_people'       => 8,
                'difficulty_level' => 'moderate',
                'images'           => [
                    'https://images.unsplash.com/photo-1558005530-a7958896ec60?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?w=800&q=80&fit=crop',
                ],
            ],

            //  AMED 
            [
                'destination'      => 'Amed',
                'title'            => 'Amed Snorkel and USAT Liberty Dive',
                'description'      => 'Two days on Bali\'s quiet east coast — snorkelling in crystal-clear water above vibrant coral gardens, and a guided dive of the famous USAT Liberty warship wreck at Tulamben.',
                'price'            => 2400000,
                'duration_days'    => 2,
                'max_people'       => 8,
                'difficulty_level' => 'moderate',
                'images'           => [
                    'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?w=800&q=80&fit=crop',
                ],
            ],
            [
                'destination'      => 'Amed',
                'title'            => 'Amed Fishing Village Sunrise',
                'description'      => 'A single morning with Amed\'s traditional jukung fishermen — watch the painted outrigger boats return at sunrise, visit the salt harvesting fields, and share a fresh catch breakfast.',
                'price'            => 550000,
                'duration_days'    => 1,
                'max_people'       => 10,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&q=80&fit=crop',
                ],
            ],

            //  TIRTA GANGGA 
            [
                'destination'      => 'Tirta Gangga',
                'title'            => 'Tirta Gangga Royal Water Palace Tour',
                'description'      => 'A half-day at the royal water palace of Tirta Gangga — walk the stepping stone fountains, explore ornate gardens, and photograph the sweeping rice terrace views with Mount Agung as the backdrop.',
                'price'            => 500000,
                'duration_days'    => 1,
                'max_people'       => 15,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80&fit=crop',
                ],
            ],

            //  TANAH LOT ─
            [
                'destination'      => 'Tanah Lot',
                'title'            => 'Tanah Lot Sunset Photography Tour',
                'description'      => 'The classic Bali bucket list experience — guided photography walk around the sea temple at golden hour. Includes a professional photographer, traditional sarong, and a beachside dinner.',
                'price'            => 1100000,
                'duration_days'    => 1,
                'max_people'       => 12,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1504450758481-7338eba7524a?w=800&q=80&fit=crop',
                ],
            ],

            //  JATILUWIH ─
            [
                'destination'      => 'Jatiluwih',
                'title'            => 'Jatiluwih UNESCO Rice Terrace Cycling',
                'description'      => 'A full day cycling tour through Jatiluwih\'s expansive UNESCO rice terraces — less visited than Tegallalang, with sweeping mountain views, traditional irrigation systems, and a farm-to-table lunch.',
                'price'            => 1350000,
                'duration_days'    => 1,
                'max_people'       => 10,
                'difficulty_level' => 'moderate',
                'images'           => [
                    'https://images.unsplash.com/photo-1531592937781-344ad608fabf?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?w=800&q=80&fit=crop',
                ],
            ],

            //  NUSA PENIDA ─
            [
                'destination'      => 'Nusa Penida',
                'title'            => 'Nusa Penida Instagram Highlights',
                'description'      => 'A two-day island trip to Nusa Penida\'s most iconic spots — Kelingking Beach cliff viewpoint, Angel\'s Billabong natural pool, Broken Beach arch, and Crystal Bay for snorkelling.',
                'price'            => 2900000,
                'duration_days'    => 2,
                'max_people'       => 10,
                'difficulty_level' => 'moderate',
                'images'           => [
                    'https://images.unsplash.com/photo-1541666282672-5f4aad922c63?q=80&w=2340&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?w=800&q=80&fit=crop',
                ],
            ],
            [
                'destination'      => 'Nusa Penida',
                'title'            => 'Nusa Penida Manta Ray Snorkel',
                'description'      => 'A full day snorkelling trip to Manta Point — swim alongside giant oceanic manta rays in one of Bali\'s most spectacular underwater encounters.',
                'price'            => 1500000,
                'duration_days'    => 1,
                'max_people'       => 8,
                'difficulty_level' => 'moderate',
                'images'           => [
                    'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1573517432985-a3d9d9f3ef81?w=800&q=80&fit=crop',
                ],
            ],

            //  NUSA LEMBONGAN 
            [
                'destination'      => 'Nusa Lembongan',
                'title'            => 'Lembongan Island Escape',
                'description'      => 'Three days on this peaceful island — surfing the famous Shipwrecks break, snorkelling with turtles at Mushroom Bay, exploring the mangrove forest by canoe, and relaxing in cliff-edge villas.',
                'price'            => 3100000,
                'duration_days'    => 3,
                'max_people'       => 8,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1505118380757-91f5f5632de0?w=800&q=80&fit=crop',
                ],
            ],

            //  KINTAMANI ─
            [
                'destination'      => 'Kintamani',
                'title'            => 'Mount Batur Sunrise Trek',
                'description'      => 'The most popular volcano trek in Bali — a 2am start, two-hour climb to the summit of Mount Batur, and breakfast cooked by volcanic steam as the sun rises over Lombok and Agung.',
                'price'            => 1200000,
                'duration_days'    => 1,
                'max_people'       => 12,
                'difficulty_level' => 'moderate',
                'images'           => [
                    'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1531592937781-344ad608fabf?w=800&q=80&fit=crop',
                ],
            ],
            [
                'destination'      => 'Kintamani',
                'title'            => 'Kintamani Caldera and Lake Tour',
                'description'      => 'A scenic day tour around the ancient caldera of Kintamani — traditional Bali Aga villages, lakeside lunch with volcano views, and a stop at the sacred Pura Ulun Danu Batur temple.',
                'price'            => 950000,
                'duration_days'    => 1,
                'max_people'       => 15,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1558005530-a7958896ec60?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?w=800&q=80&fit=crop',
                ],
            ],

            //  CANDIDASA 
            [
                'destination'      => 'Candidasa',
                'title'            => 'East Bali Coast Explorer',
                'description'      => 'Three peaceful days on Bali\'s undiscovered east coast — snorkelling at Padang Bai, the royal palace gardens of Ujung, traditional weaving villages, and the floating Pura Penataran temple.',
                'price'            => 2100000,
                'duration_days'    => 3,
                'max_people'       => 10,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80&fit=crop',
                ],
            ],

            //  SINGARAJA 
            [
                'destination'      => 'Singaraja',
                'title'            => 'North Bali Heritage and Waterfall Trail',
                'description'      => 'A day exploring Singaraja\'s colonial Dutch buildings, the ancient lontar manuscript library, twin waterfalls at Gitgit, and a traditional Buleleng dance performance in the evening.',
                'price'            => 880000,
                'duration_days'    => 1,
                'max_people'       => 12,
                'difficulty_level' => 'easy',
                'images'           => [
                    'https://images.unsplash.com/photo-1558005530-a7958896ec60?w=800&q=80&fit=crop',
                    'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?w=800&q=80&fit=crop',
                ],
            ],
        ];

        foreach ($packages as $data) {
            // find destination — must match exactly what DestinationSeeder created
            $destination = Destination::where('name', $data['destination'])->first();

            if (!$destination) {
                $this->command->warn("Destination not found: {$data['destination']} — skipping");
                continue;
            }

            $package = TravelPackage::create([
                'destination_id'   => $destination->id,
                'title'            => $data['title'],
                'slug'             => Str::slug($data['title']),
                'description'      => $data['description'],
                'price'            => $data['price'],
                'duration_days'    => $data['duration_days'],
                'max_people'       => $data['max_people'],
                'difficulty_level' => $data['difficulty_level'],
                'is_active'        => true,
            ]);

            // create two images per package
            // index 0 = primary, index 1 = secondary
            foreach ($data['images'] as $index => $imageUrl) {
                TravelPackageImage::create([
                    'travel_package_id' => $package->id,
                    'image_path'        => $imageUrl,
                    'is_primary'        => $index === 0,
                    'sort_order'        => $index,
                ]);
            }
        }

        $this->command->info('Seeded ' . count($packages) . ' travel packages.');
    }
}