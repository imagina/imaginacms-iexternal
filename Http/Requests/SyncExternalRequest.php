<?php

namespace Modules\Iexternal\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class SyncExternalRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
          'id' => 'required',
          'provider' => 'required',
          'data' => 'required',
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }

    public function getValidator(){
        return $this->getValidatorInstance();
    }

}
