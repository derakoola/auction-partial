<?php

namespace App\Models\Api\V1;

use App\Helpers\Api\V1\ApiHelper;
use App\Helpers\Api\V1\PersianLetter;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;

class Country extends Model
{
    use SoftDeletes;


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * @param array $value
     */
    public function setTitleAttribute(array $value)
    {
        if (isset($value['fa'])) {
            $value['fa'] = PersianLetter::changeToPersian($value['fa']);
        }
        $this->attributes['title'] = $value;
    }


    /**
     * @param array $value
     */
    public function setDescriptionAttribute(array $value)
    {
        if (isset($value['fa'])) {
            $value['fa'] = PersianLetter::changeToPersian($value['fa']);
        }
        $this->attributes['description'] = $value;
    }


    /**
     * @return array
     */
    public function trim()
    {
        $data = $this->toArray();
        $data['countryId'] = $this->id;
        return $data;
    }


    /**
     * @return array
     */
    public function trimEmbed()
    {

        $title = [];
        $description = [];

        foreach (ApiHelper::getLocales(false, true) as $languageKey) {
            $title[$languageKey] = $this->title['en'];
            $description[$languageKey] = $this->description['en'];

            if (isset($this->title[$languageKey])) {
                $title[$languageKey] = $this->title[$languageKey];
            }

            if (isset($this->description[$languageKey])) {
                $description[$languageKey] = $this->description[$languageKey];
            }
        }

        $data = [
            'country' => [
                'countryId' => $this->id,
                'title' => $title,
                'description' => $description,
                'media' => $this->media,
            ]
        ];
        return $data;
    }
}
