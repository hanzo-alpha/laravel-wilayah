<?php

/**
 * Read more at https://github.com/hanzo-alpha/laravel-wilayah.
 */
return [
    /**
     * Table prefix for wilayah tables: provinces, cities, districts and villages.
     */
    'table_prefix' => 'ind_',

    /**
     * API Configuration.
     */
    'api' => [
        /**
         * If enabled, this will load Indonesia API.
         * - http://localhost:8000/api/wilayah/provinces
         * - http://localhost:8000/api/wilayah/cities
         * - http://localhost:8000/api/wilayah/districts
         * - http://localhost:8000/api/wilayah/villages
         */
        'enabled' => true,

        /**
         * The middleware for Indonesia API.
         */
        'middleware' => ['api'],

        /**
         * The route name for Indonesia API.
         */
        'route_name' => 'api.wilayah',

        /**
         * The route prefix for Indonesia API.
         */
        'route_prefix' => 'api/wilayah',

        /**
         * Specify which column will be displayed in the response data.
         * Only support columns from database.
         */
        'response_columns' => [
            //.
            'province' => ['code', 'name'],

            'city' => ['city_code', 'province_code', 'name'],

            'district' => ['district_code', 'city_code', 'name'],

            'village' => ['village_code', 'district_code', 'name'],

            'island' => ['province_code', 'city_code', 'island_code', 'name'],
        ],
    ],
];
