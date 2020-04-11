<?php
// src/Model/BusesModel.php
namespace App\Model;

use function GuzzleHttp\json_decode;
use GuzzleHttp\RequestOptions;
use App\Model\AbstractModel;

class BusesModel
{
    /**
     * @var AbstractModel
     */
    private $abstractmodel;

    public function __construct(AbstractModel $abstractmodel) {
        $this->abstractmodel = $abstractmodel;
    }

    public function getNextBuses($id){

        $res = $this->abstractmodel->request('https://api.digitransit.fi/routing/v1/routers/waltti/index/graphql', json_decode('{"id":"q64","query":"query StopPageContentContainer_StopRelayQL($id_0:ID!,$startTime_1:Long!,$timeRange_2:Int!,$numberOfDepartures_3:Int!) {node(id:$id_0) {...F1}} fragment F0 on Stoptime {realtimeState,realtimeDeparture,scheduledDeparture,realtimeArrival,scheduledArrival,realtime,serviceDay,pickupType,stopHeadsign,stop {id,code,platformCode},trip {gtfsId,tripHeadsign,stops {id},pattern {route {gtfsId,shortName,longName,mode,color,alerts {id,effectiveStartDate,effectiveEndDate},agency {name,id},id},code,id},id}} fragment F1 on Stop {_stoptimesWithoutPatterns2pWqqz:stoptimesWithoutPatterns(startTime:$startTime_1,timeRange:$timeRange_2,numberOfDepartures:$numberOfDepartures_3) {...F0},id}","variables":{"id_0":"'.$id.'","startTime_1":"'.time().'","timeRange_2":43200,"numberOfDepartures_3":100}}')
        ,  'POST', true);
        
        return json_decode($res);
    }

    private function getCurrentTime(){
        return date("H:i:s", strtotime('+2 hours'));
    }
}