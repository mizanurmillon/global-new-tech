<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            SystemSettingSeeder::class,
            DynamicPageSeeder::class,
            // ContactSubmissionSeeder::class,
            CmsContentSeeder::class,
            CmsContentItemSeeder::class,
            TeamMemberSeeder::class,
            BrandSeeder::class,
            TestimonialSeeder::class,
            SocialMediaSeeder::class,
            BlogSeeder::class,
            ComprServiceSeeder::class,
            CoreServiceSeeder::class,
            SubServiceSeeder::class,

        ]);
    }
}
