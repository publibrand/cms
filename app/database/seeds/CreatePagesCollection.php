<?php

class CreatePagesCollection extends Seeder {

    public function run() {
        
        Collection::create(array(
            'name'     => 'Pages',
            'slug'  => 'pages',
            'is_visible' => 0,
            'max' => -1,
            'fields' => '{"1":{"name":"Content","label":"content","type":"wysiwyg","value":"","options":""}}',
        ));

    }

}