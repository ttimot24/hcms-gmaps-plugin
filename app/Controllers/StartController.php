<?php

namespace Plugin\GoogleMaps\App\Controllers;

use Illuminate\Http\Request;
use App\Libs\Controller;

class StartController extends Controller{

	public function index(){

		if(file_exists("plugins/GoogleMaps/resources/map_styles")){

			$custom_styles = [];

			foreach(array_slice(scandir("plugins/GoogleMaps/resources/map_styles"),2) as $file){
				$custom_styles[] = basename($file,'.json');
			}

		}



		$this->view->title('Google Maps');
		return $this->view->render("plugin::index",[
				'all_location' => \Plugin\GoogleMaps\App\Model\Location::paginate(10),
				'map_types' => array_merge(['roadmap','satellite','hybrid','terrain'],$custom_styles),
				'animations' => ['NONE','BOUNCE','DROP'],
				'map_center' => \Plugin\GoogleMaps\App\Model\Location::getCenter(),
			]);
	}


	public function createLocation(){

		$location = new \Plugin\GoogleMaps\App\Model\Location();
		$location->location_name = $this->request->input('location_name');
		$location->latitude = $this->request->input('latitude');
		$location->longitude = $this->request->input('longitude');
		$location->active = 1;

		if($location->save()){
            return $this->redirectToSelf()->withMessage(['success' => trans('plugin::messages.successfully_added_location')]);
        }else{
            return $this->redirectToSelf()->withMessage(['danger' => trans('message.something_went_wrong')]);
        }

	}


	public function deleteLocation($id){

		$location = \Plugin\GoogleMaps\App\Model\Location::find($id);

		if($location->delete()){
            return $this->redirectToSelf()->withMessage(['success' => trans('plugin::messages.successfully_deleted_location')]);
        }else{
            return $this->redirectToSelf()->withMessage(['danger' => trans('message.something_went_wrong')]);
        }

	}



	public function setCenter($location_id){

		if(\Settings::where('setting', 'gmaps_center')->update(['value' => $location_id])){
			 return $this->redirectToSelf()->withMessage(['success' => trans('plugin::messages.successfully_set_center')]);
		}else{
			return $this->redirectToSelf()->withMessage(['danger' => trans('message.something_went_wrong')]);
		}
	}


}