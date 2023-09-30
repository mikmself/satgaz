<?php

namespace App\Helpers;

class SeederHelper{
    public static function getUserIds(): array
    {
        return [
            'superadmin' => 'c2f5a0c1-92d5-4ed4-a9d0-7938a83b2482',
            'admin' => 'f3f6b2f4-d1e6-4b5d-a5a6-3c48be77de99',
            'user' => 'a2455240-6a64-4e9b-ae2e-9f005f496a06',
        ];
    }
    public static function getBouquetIds(): array
    {
        return [
            'bouquet1' => '1a2e0b54-7f6c-4712-90cd-e7a3d43006e1',
            'bouquet2' => '9f718ac6-df93-42b7-863b-cf69e2baca25',
            'bouquet3' => 'c76c9e0f-868c-4a2a-985b-98d00d5a39f4',
            'bouquet4' => 'e846f2db-9c6b-4c62-8e61-34f4c3a4e7c8',
            'bouquet5' => 'd4ab05f9-5f28-4eab-97b9-6b52e8478c06'
        ];
    }
    public static function getBouquetCustomIds(): array
    {
        return [
            'bouquetcustom1' => 'f545ab18-3631-4a9b-9514-3ebd44b4c94e',
            'bouquetcustom2' => 'c1a1e60f-07c1-4d3a-a09f-c7c59db5c3df',
            'bouquetcustom3' => 'a7584b2e-3b08-4b25-a747-4e9150674f9a'
        ];
    }
    public static function getTopingIds(): array
    {
        return [
            'topping1' => '821ed919-cb64-45f2-9b80-9334f2ee50a2',
            'topping2' => '46826a21-5a33-49d2-aecc-c9f7d6e4e1a5',
            'topping3' => 'ce508067-2622-4b61-9c60-2f1e3b95e1db',
            'topping4' => 'b6828df7-34d9-4fc7-b05c-5b8925e251b9',
            'topping5' => '7f327bf3-7840-4b8b-9e1e-274f674f74e9',
            'topping6' => '3c77bfe4-df2a-4a0f-9f57-60b2ef782a6a',
            'topping7' => '9d9eb34e-29e3-4b57-8697-cf27a9d3f743',
            'topping8' => '2075cabc-66f2-44ca-b52d-10a7d94d73dd',
            'topping9' => 'e9e0e14e-747f-42a4-8c06-1895aeb7db70'
        ];
    }
    public static function getOrderIds(): array
    {
        return [
            'order1' => '2c4a5225-5a6f-49a0-8db5-4e35684b572e',
            'order2' => '16d71687-e76e-4f70-80a5-c94373a8ce03',
            'order3' => 'df0ceabf-e6dd-44c5-b61e-e9c5f09a4f8e',
            'order4' => '7b81f2d2-760a-4bf6-8e64-70ce7ed9eb8f',
            'order5' => 'c32df0c5-84d7-4b26-a2de-e4c618d7049b',
        ];
    }
}
