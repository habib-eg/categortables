<?php

namespace Habib\Categortable\Traits;

use Ramsey\Uuid\Uuid;

trait UuidTrait{

    protected static function uuidField():string { return 'id'; }

    protected static function isValid():bool{ return true; }

    public function initializeUuidTrait(){
        if (static::isValid()){
            $this->incrementing = false;
            $this->keyType = 'string';
            $this->attributes[self::uuidField()] = Uuid::uuid4()->toString();
        }
    }

    protected static function bootUuidTrait(){

        if (static::isValid()){

            static::creating(function ($model) {
                $model->{self::uuidField()} = $model->{self::uuidField()} ?? Uuid::uuid4()->toString();
            });
        }

    }

}
