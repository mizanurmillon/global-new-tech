<?php
namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    public function run(): void
    {
        $technologies = [
            ['title' => 'AWS', 'icon' => "/uploads/technologies/aws.jpg"],
            ['title' => 'Docker', 'icon' => "/uploads/technologies/docker.jpg"],
            ['title' => 'Jenkins', 'icon' => "/uploads/technologies/jenkins.jpg"],
            ['title' => 'Elasticsearch', 'icon' => "/uploads/technologies/elasticsearch.jpg"],
            ['title' => 'GitHub Actions', 'icon' => "/uploads/technologies/github-actions.jpg"],
            ['title' => 'GitLab', 'icon' => "/uploads/technologies/gitlab.jpg"],
            ['title' => 'Azure', 'icon' => "/uploads/technologies/azure.jpg"],
            ['title' => 'Kafka', 'icon' => "/uploads/technologies/kafka.jpg"],
        ];

        foreach ($technologies as $tech) {
            Technology::updateOrCreate(
                ['title' => $tech['title']],
                [
                    'icon'      => $tech['icon'],
                    'is_active' => true,
                ]
            );
        }
    }
}
