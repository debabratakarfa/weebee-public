<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Date;

class EventsController extends BaseController
{
    public function getEventsWithWorkshops()
    {
        $response = [];
        $results = \App\Models\Event::all()->toArray();
        foreach ($results as $result) {
            $workshops = Workshop::orderby('id', 'asc')->select('*')->where('event_id', $result['id'])->get();
            $result['workshops'] = $workshops;
            $response[] = $result;
        }

        if (empty($response)) {
            throw new \Exception('implement in coding task 2');
        } else {
            return response()->json($response);
        }
    }

    public function getFutureEventsWithWorkshops()
    {
        $now = Carbon::now();
        $response = [];
        $results = \App\Models\Event::all()->toArray();
        foreach ($results as $result) {
            $workshops = Workshop::orderby('id', 'asc')
                ->select('*')
                ->where('event_id', $result['id'])
                ->where('end', '>=', $now)
                ->get();
            if (count($workshops) !== 0) {
                $result['workshops'] = $workshops;
                $response[] = $result;
            }
        }

        if (empty($response)) {
            throw new \Exception('implement in coding task 2');
        } else {
            return response()->json($response);
        }
    }
}
