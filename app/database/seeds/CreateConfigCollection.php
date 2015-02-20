<?php

class CreateConfigCollection extends Seeder {

    public function run() {
        
        Collection::create(array(
            'name' => 'Config',
            'slug'  => 'config',
            'is_visible' => 0,
            'max' => 1,
    		'fields' => '{"1":{"name":"Site title","label":"site_title","type":"text","value":"","required":"1","options":""},"2":{"name":"Site description","label":"site_description","type":"text","value":"","options":""},"3":{"name":"Site keywords","label":"site_keywords","type":"text","value":"","options":""}}',
        ));

    }

}