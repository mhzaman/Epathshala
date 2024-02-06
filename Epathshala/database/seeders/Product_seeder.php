<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Product_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('products')->insert([
            [
            'name' => 'Robotics Specialization',
            'catagory'=>'Intermediate',
            'discription'=>'The Introduction to Robotics Specialization introduces you to the concepts of robot flight and movement, how robots perceive their environment.',
            'views' => '0',
            'difficulty'=> '2',
            'cover'=> 'https://drive.google.com/file/d/1pFpN6NWY-l3ZJYEyVQ85_qUCk-X_Ng1A/view?usp=sharing'
            ],
            [
                'name' => 'Building Test Automation Framework using Selenium and TestNG',
                'catagory'=>'Advanced ',
                'discription'=>'Selenium is one of the most widely used functional UI automation testing tools and TestNG is a brilliant testing framework.',
                'views' => '0',
                'difficulty'=> '3',
                'cover'=> 'https://drive.google.com/file/d/1gwa5bFE0WnKE6iCs3QzDPR_fRDdDuI2Z/view?usp=drive_link'
                ]
            

        ]);
    }
}
