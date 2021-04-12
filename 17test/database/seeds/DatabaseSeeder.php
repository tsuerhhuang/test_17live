<?php

use Illuminate\Database\Seeder;
use App\Models\Posts;
use App\Models\Comments;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
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

        $array = [
            0 => [
                'post_id' => 1,
                'message' => 'Comments 1',
            ],
            1 => [
                'post_id' => 1,
                'message' => 'Comments 2',
            ],
            2 => [
                'post_id' => 1,
                'message' => 'Comments 3',
            ],
        ];

        foreach ($array as $data) {
            $result = (new Comments($data))->save();
        }
    }
}
