<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AbsencesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->check_absence($this->attendance , $this->intern_date) ,
            'start' => date('Y-m-d' , strtotime($this->intern_date)),
            'end'=> date('Y-m-d' , strtotime($this->intern_date)),
            'className'=> 'bg'
        ];
    }

    public function check_absence($attendace , $intern_date){
        if(!$attendace){
            if(strtotime($intern_date) < strtotime(date('Y-m-d'))){
                return 'Absen';
            }else{
                return '';
            }
        }else{
            return 'in:'.date('H:i' , strtotime($attendace->checkin)).'|out:'.date('H:i' , strtotime($attendace->checkout));
        }
    }
}
