<?php

class CreatePagesCollection extends Seeder {

    public function run() {
        
        Collection::create(array(
            'name'     => 'Pages',
            'slug'  => 'pages',
            'max' => -1,
            'fields' => '{"1":{"name":"Content","label":"content","type":"text","value":"","options":""}}',
        ));

    }

}