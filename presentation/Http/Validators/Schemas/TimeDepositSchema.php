<?php


namespace Presentation\Http\Validators\Schemas;


class TimeDepositSchema
{
    public function getRules(){
        return [
            'name' => 'bail|required|alpha|min:4|max:16',
            'surname' => 'bail|required|alpha|min:4|max:16',
            'mount' => 'bail|required|numeric',
            'days' => 'bail|required|integer|min:30',
            //'compound' => 'bail|boolean|nullable'
        ];
    }
}
