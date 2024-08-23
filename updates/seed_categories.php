<?php namespace NiaInteractive\Event\Updates\Seeds;


use NiaInteractive\Event\Models\Category;

class SeedCategories extends \Seeder
{

    /**
     * Run seeding.
     */
    public function run()
    {
        $items = [
            [
                'name' => "Academic Calendar",
            ],
            [
                'name' => "Staff Calendar",
            ],
            [
                'name' => "Board Meetings",
            ],
            [
                'name' => "Parent Advisory Board Calendar",
            ],
            [
                'name' => "Board Calendar",
            ],
        ];

        foreach ($items as $item)
        {
            // create new Status
            $status = Category::create([
                'name' => trim($item['name']),
            ]);
        }
    }

}
