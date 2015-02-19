<?php

class BaseModel extends Eloquent {

	public static function boot() {
        
        parent::boot();

        $created = FALSE;

        static::created(function($entity) use(&$created) {

            Event::fire('activities.store', [
                'created',
                $entity,
            ]);

            $created = TRUE;

        });

        static::saved(function($entity) use(&$created) {

            if($created === FALSE) {
                Event::fire('activities.store', [
                    'updated',
                    $entity,
                ]);
            }

        });


        static::deleted(function($entity) {

            Event::fire('activities.store', [
                'removed',
                $entity,
            ]);

        });

	}

}
