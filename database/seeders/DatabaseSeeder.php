<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('images/projects');


        User::insert([
            [
                'name' => 'Vicky',
                'username' => 'aryasgrave',
                'email' => 'v.ernst2006@gmail.com',
                'password' => bcrypt('password'),
                'introduction' => 'I’m an 18 year old full stack developer. I love designing websites, building them and solving the problems that come my way. If I’m not coding I am probably playing games, reading a book or remaking my planning and organization system (this happens a lot.) ',
            ],
        ]);

        $tags = [
            ['name' => 'Frontend Focus'],
            ['name' => 'Backend Focus'],
            ['name' => 'Creativity'],
            ['name' => 'Work'],
            ['name' => 'School'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }

        $projects = [
            [
                'name' => 'Project Alpha',
                'description' => 'Description for Project Alpha',
                'link' => 'https://example.com/project-alpha',
                'photo' => $this->generateImage('alpha.jpg'),
            ],
            [
                'name' => 'Project Beta',
                'description' => 'Description for Project Beta',
                'link' => 'https://example.com/project-beta',
                'photo' => $this->generateImage('beta.jpg'),
            ],
            [
                'name' => 'Project Gamma',
                'description' => 'Description for Project Gamma',
                'link' => 'https://example.com/project-gamma',
                'photo' => $this->generateImage('gamma.jpg'),
            ],
            [
                'name' => 'Project Delta',
                'description' => 'Description for Project Delta',
                'link' => 'https://example.com/project-delta',
                'photo' => $this->generateImage('delta.jpg'),
            ],
            [
                'name' => 'Project Epsilon',
                'description' => 'Description for Project Epsilon',
                'link' => 'https://example.com/project-epsilon',
                'photo' => $this->generateImage('epsilon.jpg'),
            ],
            [
                'name' => 'Project Zeta',
                'description' => 'Description for Project Zeta',
                'link' => 'https://example.com/project-zeta',
                'photo' => $this->generateImage('zeta.jpg'),
            ],
            [
                'name' => 'Project Eta',
                'description' => 'Description for Project Eta',
                'link' => 'https://example.com/project-eta',
                'photo' => $this->generateImage('eta.jpg'),
            ],
            [
                'name' => 'Project Theta',
                'description' => 'Description for Project Theta',
                'link' => 'https://example.com/project-theta',
                'photo' => $this->generateImage('theta.jpg'),
            ],
            [
                'name' => 'Project Iota',
                'description' => 'Description for Project Iota',
                'link' => 'https://example.com/project-iota',
                'photo' => $this->generateImage('iota.jpg'),
            ],
            [
                'name' => 'Project Kappa',
                'description' => 'Description for Project Kappa',
                'link' => 'https://example.com/project-kappa',
                'photo' => $this->generateImage('kappa.jpg'),
            ],
            [
                'name' => 'Project Lambda',
                'description' => 'Description for Project Lambda',
                'link' => 'https://example.com/project-lambda',
                'photo' => $this->generateImage('lambda.jpg'),
            ],
            [
                'name' => 'Project Mu',
                'description' => 'Description for Project Mu',
                'link' => 'https://example.com/project-mu',
                'photo' => $this->generateImage('mu.jpg'),
            ],
        ];

        foreach ($projects as $projectData) {
            $project = Project::create($projectData);
            $project->tags()->attach(Tag::inRandomOrder()->take(rand(1, 3))->pluck('id'));
        }
    }

    /**
     * Simulate image upload and return the stored path.
     *
     * @param string $imageName
     * @return string
     */
    private function generateImage($imageName)
    {
        $sourcePath = public_path('images/projects/default-image.png'); // Correct path to the default image
        $destinationPath = public_path('images/projects/' . $imageName);

        // Ensure the target directory exists
        if (!file_exists(public_path('images/projects'))) {
            mkdir(public_path('images/projects'), 0755, true);
        }

        // Copy the default image if the destination file doesn't already exist
        if (!file_exists($destinationPath)) {
            if (!file_exists($sourcePath)) {
                throw new \Exception('Default image not found at ' . $sourcePath);
            }
            copy($sourcePath, $destinationPath);
        }

        return 'images/projects/' . $imageName;
    }
}
