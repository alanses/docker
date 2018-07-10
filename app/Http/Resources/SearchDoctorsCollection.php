<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SearchDoctorsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
       return array_map(function ($doctor){
               return [
                   'workerName' => $doctor['workerName'],
                   'workerSecondName' => $doctor['workerSecondName'],
                   'workerLastName' => $doctor['workerLastName'],
                   'userDescription' => $doctor['userDescription'],
                   'userImage' => $doctor['userImage'],
                   'schedulesIdentify' => $doctor['schedulesIdentify'],
                   'start' => $doctor['start'],
                   'end' => $doctor['end'],
               ];
       }, $this->collection->toArray());
    }
}
