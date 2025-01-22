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

        // random projects
        $projects = [
            [
                'name' => 'Prinsenhof Notarissen',
                'description' => 'Website voor Prinsenhof Notarissen (stage)',
                'link' => 'https://www.prinsenhofnotarissen.nl/',
                'photo' => $this->generateImage('pn.jpg'),
            ],
            [
                'name' => 'Arts Straalbedrijf',
                'description' => 'Website voor Arts Straalbedrijf (stage)',
                'link' => 'https://www.artsstraalbedrijf.nl/',
                'photo' => $this->generateImage('as.jpg'),
            ],
            [
                'name' => 'PBreda Jazz',
                'description' => 'Website voor Breda Jazz festival 2024 (stage)',
                'link' => 'https://www.bredajazzfestival.nl/',
                'photo' => $this->generateImage('bjf.jpg'),
            ],
            [
                'name' => 'Adwin Kanters',
                'description' => 'Website voor Adwin Kanters (stage)',
                'link' => 'https://www.adwinkanters.nl/',
                'photo' => $this->generateImage('ak.jpg'),
            ],
            [
                'name' => 'Oude portfolio',
                'description' => 'Mijn oude portfolio website',
                'link' => 'https://aryasgrave.com/',
                'photo' => $this->generateImage('pw.jpg'),
            ],
            [
                'name' => 'Tarot card generator',
                'description' => 'Geen tarot kaarten bij, en toch zin om een sessie te doen? Gebruik de generator!',
                'link' => 'http://tarot.aryasgrave.com/',
                'photo' => $this->generateImage('tcg.jpg'),
            ],
            [
                'name' => 'ToDo app',
                'description' => 'ToDo app die gebruik maakt van local storage',
                'link' => 'http://todo.aryasgrave.com/',
                'photo' => $this->generateImage('tda.jpg'),
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
