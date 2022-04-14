<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompaniesList extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* List of 10 companies*/
        static $companies = [
            '0'=> [
                'name' => 'Apple',
                'email' => 'apple@gmail.com',
                'logo' => 'default.jpg',
                'website' => 'www.apple.com'
            ],
            '1'=> [
                'name' => 'Samsung',
                'email' => 'samsung@gmail.com',
                'logo' => 'default.jpg',
                'website' => 'www.samsung.com'
            ],
            '2'=> [
                'name' => 'Devsspace',
                'email' => 'devsspace@gmail.com',
                'logo' => 'default.jpg',
                'website' => 'www.devsspace.com'
            ],
            '3'=> [
                'name' => 'facebook',
                'email' => 'facebook@gmail.com',
                'logo' => 'default.jpg',
                'website' => 'www.facebook.com'
            ],
            '4'=> [
                'name' => 'Amazom',
                'email' => 'amazom@gmail.com',
                'logo' => 'default.jpg',
                'website' => 'www.amazom.com'
            ],
            '5'=> [
                'name' => 'Microsoft',
                'email' => 'microsoft@gmail.com',
                'logo' => 'default.jpg',
                'website' => 'www.microsoft.com'
            ],
            '6'=> [
                'name' => 'Tesla',
                'email' => 'tesla@gmail.com',
                'logo' => 'default.jpg',
                'website' => 'www.tesla.com'
            ],
            '7'=> [
                'name' => 'Alibaba',
                'email' => 'alibaba@gmail.com',
                'logo' => 'default.jpg',
                'website' => 'www.alibaba.com'
            ],
            '8'=> [
                'name' => 'Saudi Aramco',
                'email' => 'aramco@gmail.com',
                'logo' => 'default.jpg',
                'website' => 'www.aramco.com'
            ],
            '9'=> [
                'name' => 'IBM',
                'email' => 'ibm@gmail.com',
                'logo' => 'default.jpg',
                'website' => 'www.ibm.com'
            ],
        ];

        try{
        foreach ($companies as $company){
            $company_data =new Company;
            foreach ($company as $key=>$value){
                $company_data->$key = $value;
            }
            $company_data->save();
        }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
