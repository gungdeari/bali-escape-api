<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\TravelPackage;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // read users created by UserSeeder — don't create them here
        // UserSeeder is responsible for users, ReviewSeeder is responsible for reviews
        $reviewers = User::whereHas('roles', fn($q) => $q->where('name', 'user'))
            ->get();

        if ($reviewers->isEmpty()) {
            $this->command->warn('No users found — skipping ReviewSeeder. Run UserSeeder first.');
            return;
        }

        $packages = TravelPackage::all();

        if ($packages->isEmpty()) {
            $this->command->warn('No packages found — skipping ReviewSeeder. Run TravelPackageSeeder first.');
            return;
        }

        // pool of realistic review comments grouped by rating
        $commentsByRating = [
            5 => [
                "Absolutely breathtaking experience. Worth every rupiah and more.",
                "One of the best trips of my life. The guide was incredible.",
                "Perfect from start to finish. Already planning to come back.",
                "Exceeded all my expectations. Highly recommend to everyone.",
                "Stunning views and exceptional service throughout.",
                "A truly unforgettable Bali experience. Five stars easily.",
                "The local knowledge our guide had was simply amazing.",
            ],
            4 => [
                "Really enjoyed this package. A few small hiccups but overall great.",
                "Great value for money. The scenery was gorgeous.",
                "Well organized and the guide was very knowledgeable.",
                "Loved every moment. Would definitely book again.",
                "Beautiful experience. Slightly rushed at some points.",
                "Very good overall. The food included was a lovely touch.",
                "Great trip, minor timing issues but nothing serious.",
            ],
            3 => [
                "Decent experience but felt a bit rushed at times.",
                "Good but not quite what I expected from the description.",
                "Average overall. The highlights were great, some parts slow.",
                "OK experience. Guide was fine but not very engaging.",
                "Middle of the road — some parts excellent, others average.",
            ],
        ];

        $reviewCount = 0;

        foreach ($packages as $package) {
            // randomly assign 1 to 4 reviewers per package
            // shuffle so different packages get different reviewer combinations
            $selectedReviewers = $reviewers->shuffle()->take(rand(1, min(4, $reviewers->count())));

            foreach ($selectedReviewers as $reviewer) {
                // weighted random rating — 60% five stars, 30% four stars, 10% three stars
                // reflects realistic travel review distribution
                $rand   = rand(1, 10);
                $rating = match(true) {
                    $rand <= 6  => 5,
                    $rand <= 9  => 4,
                    default     => 3,
                };

                $comments = $commentsByRating[$rating];
                $comment  = $comments[array_rand($comments)];

                Review::create([
                    'user_id'           => $reviewer->id,
                    'travel_package_id' => $package->id,
                    'rating'            => $rating,
                    'comment'           => $comment,
                ]);

                $reviewCount++;
            }
        }

        $this->command->info("Seeded {$reviewCount} reviews across {$packages->count()} packages.");
    }
}