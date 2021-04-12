<?php

use Illuminate\Database\Seeder;
use App\Models\Posts;

class CreatePostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $array = [
            0 => [
                'title'   => 'test',
                'content' => 'test_content',
            ],
            1 => [
                'title'   => 'test 1',
                'content' => 'test_content 1',
            ],
            2 => [
                'title'   => 'test 2',
                'content' => 'test_content 2',
            ],
        ];

        foreach ($array as $data) {
            $result = (new Posts($data))->save();
        }
    }
}
