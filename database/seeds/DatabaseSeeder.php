<?php

use App\Answer;
use App\Question;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $nakamura = User::create([
            'name' => 'なかむら',
            'email' => 'nakamura@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $sato = User::create([
            'name' => '佐藤',
            'email' => 'sato@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $takahashi = User::create([
            'name' => '高橋',
            'email' => 'takahashi@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);


        /** @var Question[] $q */
        $q[0] = $nakamura->questions()->create(factory(Question::class)->raw());
        $q[0]->tags()->attach(Tag::firstOrCreate(['title' => Arr::random(Tag::DEFAULTS)]));
        $q[1] = $nakamura->questions()->create(factory(Question::class)->raw());
        $q[1]->tags()->attach(Tag::firstOrCreate(['title' => Arr::random(Tag::DEFAULTS)]));
        $q[2] = $sato->questions()->create(factory(Question::class)->raw());
        $q[2]->tags()->attach(Tag::firstOrCreate(['title' => Arr::random(Tag::DEFAULTS)]));
        $q[3] = $sato->questions()->create(factory(Question::class)->raw());
        $q[3]->tags()->attach(Tag::firstOrCreate(['title' => Arr::random(Tag::DEFAULTS)]));

        /** @var Answer[] $a */
        $a[0] = $takahashi->answers()->make(factory(Answer::class)->raw());
        $a[0]->question()->associate($q[0])->save();
        $a[1] = $takahashi->answers()->make(factory(Answer::class)->raw());
        $a[1]->question()->associate($q[2])->save();
    }
}
