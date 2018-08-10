<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Room;

class CreateBoarderFromRoomForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_no' => 'required|numeric',
            'occupation' => 'required',
        ];
    }

    public function persist(Room $room, $file) {
        if($file) {
            $path = $this->file('agreement')->store('public/images');
            
            $room->createBoarder([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'occupation' => $this->occupation,
                'contact_no' => $this->contact_no,
                'agreement' => $path,
            ]);
            return;
        }
        
        $room->createBoarder($this->only([
            'first_name',
            'last_name',
            'contact_no',
            'occupation',
        ]));
    }
}
