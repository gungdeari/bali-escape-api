<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            // Gianyar Regency
            [
                'name'        => 'Ubud',
                'address'     => 'Ubud, Gianyar',
                'city'        => 'Gianyar',
                'description' => 'The cultural heart of Bali — rice terraces, ancient temples, traditional dance, and world-class art galleries.',
            ],
            [
                'name'        => 'Tegallalang',
                'address'     => 'Tegallalang, Gianyar',
                'city'        => 'Gianyar',
                'description' => 'Famous for its dramatic UNESCO-listed rice terraces carved into the hillside north of Ubud.',
            ],
            [
                'name'        => 'Goa Gajah',
                'address'     => 'Bedulu, Gianyar',
                'city'        => 'Gianyar',
                'description' => 'The Elephant Cave — an 11th century archaeological site with ancient Hindu and Buddhist carvings.',
            ],

            // Badung Regency
            [
                'name'        => 'Seminyak',
                'address'     => 'Seminyak, Badung',
                'city'        => 'Badung',
                'description' => 'Bali\'s most stylish beach strip — luxury beach clubs, designer boutiques, and world-class sunset dining.',
            ],
            [
                'name'        => 'Kuta',
                'address'     => 'Kuta, Badung',
                'city'        => 'Badung',
                'description' => 'Bali\'s original tourist hub — a long sandy beach, surf schools, and buzzing nightlife.',
            ],
            [
                'name'        => 'Canggu',
                'address'     => 'Canggu, Badung',
                'city'        => 'Badung',
                'description' => 'The digital nomad capital of Bali — surf breaks, rice paddies, trendy cafes, and creative energy.',
            ],
            [
                'name'        => 'Uluwatu',
                'address'     => 'Pecatu, Badung',
                'city'        => 'Badung',
                'description' => 'Dramatic clifftop temple, world-famous surf breaks, and spectacular Indian Ocean sunsets.',
            ],
            [
                'name'        => 'Nusa Dua',
                'address'     => 'Nusa Dua, Badung',
                'city'        => 'Badung',
                'description' => 'Bali\'s luxury resort enclave — calm lagoon beaches, five-star hotels, and water sports.',
            ],
            [
                'name'        => 'Jimbaran',
                'address'     => 'Jimbaran, Badung',
                'city'        => 'Badung',
                'description' => 'Renowned for fresh seafood dinners on the beach and a wide crescent bay with calm waters.',
            ],

            // Buleleng Regency
            [
                'name'        => 'Lovina',
                'address'     => 'Lovina, Buleleng',
                'city'        => 'Buleleng',
                'description' => 'North Bali\'s tranquil black-sand beach — famous for dolphin watching at sunrise.',
            ],
            [
                'name'        => 'Munduk',
                'address'     => 'Munduk, Buleleng',
                'city'        => 'Buleleng',
                'description' => 'A cool mountain village surrounded by clove and coffee plantations, waterfalls, and twin lakes.',
            ],
            [
                'name'        => 'Singaraja',
                'address'     => 'Singaraja, Buleleng',
                'city'        => 'Buleleng',
                'description' => 'Bali\'s former colonial capital — rich Dutch heritage, ancient lontar manuscript libraries, and waterfalls.',
            ],

            // Karangasem Regency
            [
                'name'        => 'Amed',
                'address'     => 'Amed, Karangasem',
                'city'        => 'Karangasem',
                'description' => 'A string of peaceful fishing villages on Bali\'s east coast, famous for snorkelling and the USAT Liberty wreck dive.',
            ],
            [
                'name'        => 'Candidasa',
                'address'     => 'Candidasa, Karangasem',
                'city'        => 'Karangasem',
                'description' => 'A quiet coastal town with a Hindu temple built into a hillside and access to the Gili islands.',
            ],
            [
                'name'        => 'Tirta Gangga',
                'address'     => 'Abang, Karangasem',
                'city'        => 'Karangasem',
                'description' => 'A royal water palace with ornate fountains, stepping stones, and sweeping rice terrace views.',
            ],

            // Tabanan Regency
            [
                'name'        => 'Tanah Lot',
                'address'     => 'Beraban, Tabanan',
                'city'        => 'Tabanan',
                'description' => 'Bali\'s most photographed sea temple perched on a rocky outcrop — magical at sunset.',
            ],
            [
                'name'        => 'Jatiluwih',
                'address'     => 'Jatiluwih, Tabanan',
                'city'        => 'Tabanan',
                'description' => 'UNESCO World Heritage rice terraces stretching across 600 hectares — less touristy than Tegallalang.',
            ],

            // Klungkung
            [
                'name'        => 'Nusa Penida',
                'address'     => 'Nusa Penida, Klungkung',
                'city'        => 'Klungkung',
                'description' => 'A wild island off Bali\'s southeast coast — dramatic cliffs, crystal clear water, and manta ray diving.',
            ],
            [
                'name'        => 'Nusa Lembongan',
                'address'     => 'Nusa Lembongan, Klungkung',
                'city'        => 'Klungkung',
                'description' => 'A relaxed island with mangrove forests, surf breaks, and pristine snorkelling beaches.',
            ],

            // Bangli
            [
                'name'        => 'Kintamani',
                'address'     => 'Kintamani, Bangli',
                'city'        => 'Bangli',
                'description' => 'Perched on the rim of Mount Batur\'s ancient caldera — active volcano trekking and stunning lake views.',
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::create([
                ...$destination,
                'slug' => Str::slug($destination['name']),
            ]);
        }
    }
}
