<?php namespace NiaInteractive\NiaCalendar\Updates\Seeds;


use NiaInteractive\NiaCalendar\Models\Category;

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
                'color' => "#3498db",
            ],
            [
                'name' => "Staff Calendar",
                'color' => "#e67e22",
            ],
            [
                'name' => "Board Meetings",
                'color' => "#c0392b",
            ],
            [
                'name' => "Parent Advisory Board Calendar",
                'color' => "#16a085",
            ],
            [
                'name' => "Board Calendar",
                'color' => "#2b3e50",
            ],
        ];

        foreach ($items as $item)
        {
            // create new Status
            $status = Category::create([
                'name' => trim($item['name']),
                'color' => trim($item['color']),
            ]);
        }
    }

}
