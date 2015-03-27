<?php

class CreateConfigCollection extends Seeder {

    public function run() {
        
        Collection::create(array(
            'name' => 'Settings',
            'slug'  => 'settings',
            'type'  => 'config',
            'is_visible' => 0,
            'max' => 1,
    		'fields' => '{"1":{"name":"Site title","label":"site_title","type":"text","value":"","required":"1","options":""},"2":{"name":"Site description","label":"site_description","type":"text","value":"","options":""},"3":{"name":"Site keywords","label":"site_keywords","type":"text","value":"","options":""},"4":{"name":"Client id","label":"client_id","type":"text","value":"","options":""},"5":{"name":"Client email","label":"client_email","type":"text","value":"","options":""},"6":{"name":"Key file","label":"key_file","type":"file","value":"","options":""},"7":{"name":"Profile id","label":"profile_id","type":"text","value":"","options":""}}',
        ));

    }

}