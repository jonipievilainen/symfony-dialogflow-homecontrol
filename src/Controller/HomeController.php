<?php
// header('Content-type: application/json');
// src/Controller/HomeController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Dialogflow\WebhookClient;

use Dialogflow\Action\Responses\SimpleResponse;
use Dialogflow\Action\Responses\Image;
use Dialogflow\Action\Responses\BasicCard;
use Dialogflow\Action\Responses\BrowseCarousel;
use Dialogflow\Action\Responses\BrowseCarousel\Option;
use Dialogflow\Action\Responses\LinkOutSuggestion;

use Dialogflow\Action\Responses\MediaObject;
use Dialogflow\Action\Responses\MediaResponse;
use Dialogflow\Action\Responses\Suggestions;

use App\Model\BusesModel;
use App\Model\Devices\NodemcuModel;
use App\Service\MessageGenerator;


// php bin/console cache:clear
// php bin/console make:migration
// php bin/console doctrine:migrations:migrate

class HomeController
{
    protected $agent;
    protected $conv;
    private $response;

    public function __construct() {
        $this->agent = new WebhookClient(json_decode(file_get_contents('php://input'),true));
	    $this->conv = $this->agent->getActionConversation();
    }

    private function displayResponse() {
        if ($this->conv){
            $this->conv->close($this->response);
        }else{
            $this->agent->reply($this->response);
        }

        if ($this->conv) {
            $this->agent->reply($this->conv);
        }

        $response = new Response();
        $response->setContent(json_encode($this->agent->render()));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function rest(
        BusesModel $busesModel,
        NodemcuModel $nodemcuModel
    ){  
        error_log($this->agent->getIntent());

        switch($this->agent->getIntent()){
            case 'Bus info':

                $message = "No bus available";

                $busses = ($busesModel->getNextBuses("U3RvcDpMYWh0aToxMDM4MDA=")); // TODO: remove hardcode

                $countter = 0;
                foreach ($busses->{'data'}->{'node'}->{'_stoptimesWithoutPatterns2pWqqz'} as $bus) {

                    date_default_timezone_set("Europe/Helsinki"); 
                    $currentTime = time();
                    $nextBusTime = strtotime('today midnight') + $bus->{'realtimeDeparture'};
                    $timeLeft = floor(($nextBusTime - $currentTime) / 60);
                    
                    if($countter === 0){
                        $message = 'first bus will be left in ' . $timeLeft . ' minute.';
                    }else{
                        $message .= ' second bus will be left in ' . $timeLeft. ' minute.';
                        break;
                    }
                    $countter++;
                }
                
                $this->response = $message;
                
                break;
            case 'Get temps':

                $this->response = 'still in progress';

                // // $action = $this->agent->getAction();
                // $parameters = $this->agent->getParameters();

                // if((isset($parameters['device'])) && ($parameters['device'] === 'nodemcu')){
                //     $_POST['method'] = 'getTemp';
                //     $_POST['deviceId'] = 1;
                    
                //     $this->response = (string) devices_nodemcu_action(). ' degrees';
                // }
                
                break;
            case 'Led strips':

                $this->response = 'still in progress';

                // $parameters = $this->agent->getParameters();

                // if(isset($parameters['device']) && $parameters['device'] === 'nodemcu'){
                //     $color = (isset($parameters['color']) ? $parameters['color'] : 'black');

                //     require PLUGIN_DIR_PATH.'helpers/Color.php';
                //     $colors = new Color;

                //     $rgbw = $colors->getRgpByName($color);

                //     ePrint($rgbw);

                //     $_POST['method'] = 'setLeds';
                //     $_POST['deviceId'] = 1;
                //     $_POST['r'] = $rgbw->{'r'};
                //     $_POST['g'] = $rgbw->{'g'};
                //     $_POST['b'] = $rgbw->{'b'};
                //     $_POST['w'] = $rgbw->{'w'};
                    
                //     $this->response = devices_nodemcu_action();

                // }elseif(isset($parameters['device']) && $parameters['device'] === 'raspi'){
                //     $color = (isset($parameters['color']) ? $parameters['color'] : 'black');

                //     require PLUGIN_DIR_PATH.'helpers/Color.php';
                //     $colors = new Color;

                //     $rgbw = $colors->getRgpByName($color, 1);

                //     ePrint($rgbw);

                //     $_POST['method'] = 'setLeds';
                //     $_POST['r'] = $rgbw->{'r'};
                //     $_POST['g'] = $rgbw->{'g'};
                //     $_POST['b'] = $rgbw->{'b'};
                //     $_POST['w'] = $rgbw->{'w'};
                    
                //     $this->response = devices_raspberrypi_action();
                // }else{
                //     $this->response = 'Leds not set';
                // }

                break;
            case 'Raspi relays':

                $this->response = 'still in progress';
                
                // $parameters = $this->agent->getParameters();

                // if(isset($parameters['device']) && $parameters['device'] === 'raspi'){
                //     if(isset($parameters['raspiRelay'])){
                        
                //         $pin = $parameters['raspiRelay'];

                //         $_POST['method'] = 'relayOnOff';
                //         $_POST['pin'] = $pin;
                        
                //         $this->response = devices_raspberrypi_action();
                //     }
                // }elseif(isset($parameters['device']) && $parameters['device'] === 'nodemcu'){
                //     $_POST['method'] = 'setRelay';
                //     $_POST['deviceId'] = 1;
                //     $_POST['ms'] = 1000;

                //     $this->response = devices_nodemcu_action();

                // }elseif(isset($parameters['device']) && $parameters['device'] === 'wakeonlan'){
                //     $_POST['method'] = 'wakeUpDevice';
                //     $_POST['deviceId'] = 1;

                //     $this->response = devices_wakeonlan_action();
                // }

                break;
            case 'Conversation status':

                $this->response = 'still in progress';

                // $parameters = $this->agent->getParameters();
                // $status = (int) $parameters['yesNo'];
                
                // update_option('conv_status', $status);

                // $this->response = 'Conversation status set to '.$status;
                
                break;
            case 'Discord users':

                $this->response = 'still in progress';

                // $_POST['method'] = 'getUsers';
                // $rooms = json_decode(discord_action());
                // $msg = '';

                // foreach($rooms as $room => $users) {
                //     $msg .= 'Channel '.$room.' have users: ';

                //     $i = 0;
                //     $len = count((array)$users);

                //     foreach($users as $name) {
                //         if ($i == $len - 1) {
                //             $msg .= $name.'. ';
                //         } else {
                //             $msg .= $name.', ';
                //         }
                //         $i++;
                //     }
                //     error_log($msg);
                // }

                // if($msg == '') {
                //     $msg = 'No users in voice channels.';
                // }

                // $this->response = $msg;
                
                break;
            case 'Supervisor':

                $this->response = 'still in progress';

                // $parameters = $this->agent->getParameters();

                // /**
                //  * 
                //  * Add device rtl = db => 192.168.*.*
                //  * Add process start, stop, status
                //  */

                // if(isset($parameters['supervisor-device']) && $parameters['supervisor-device'] === 'rtl'){

                //     $_POST['method'] = $parameters['supervisor-function'];
                //     $_POST['device'] = $parameters['supervisor-device'];
                    
                //     $this->response = supervisorapi_action();

                // }else{
                //     $this->response = 'Supervisor error';
                // }

                break;
            case 'News':

                $this->response = 'still in progress';

                // $parameters = $this->agent->getParameters();

                // if(isset($parameters['news-type']) && $parameters['news-type'] === 'iltalehti'){

                //         $this->conv->close('Liten news mp3');
                //         $this->conv->ask(
                //             new MediaResponse(
                //                 // MediaObject::create('http://storage.googleapis.com/automotive-media/Jazz_In_Paris.mp3')
                //                 MediaObject::create('https://kaikenalku.zapto.org/public/chrome/out.mp3')
                //                 ->name('Iltalehti')
                //                 ->description('Uutiset')
                //                 ->icon('http://storage.googleapis.com/automotive-media/album_art.jpg')
                //                 ->image('http://storage.googleapis.com/automotive-media/album_art.jpg')
                //             )
                //         );
                //         $this->conv->ask(new Suggestions(['Pause', 'Stop', 'Start over']));
                    
                //     if ($this->conv)
                //         $this->agent->reply($this->conv);
                //     else
                //         $this->agent->reply();

                // }else{
                //     $error = 'News error';
                //     if ($this->conv)
                //         $this->conv->close($error);
                //     else
                //         $this->agent->reply($error);
                // }

                break;
            default:
                $this->response = 'Oh no';
        }

        return $this->displayResponse();
    }
}