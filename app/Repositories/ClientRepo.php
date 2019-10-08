<?php

namespace App\Repositories;

use App\Client;
use Illuminate\Http\Request;

class ClientRepo extends BaseRepo {

    public function getModel() {
        return new Client();
    }

    public function save($businessName, $address, $postcode, $municipality, $province, $fiscalCode, $phone, $email, $client = null) {

        if (is_null($client)) {
            $client = $this->getModel();
        }

        
		$client->setBusinessName($businessName);
		$client->setAddress($address);
		$client->setPostcode($postcode);
		$client->setMunicipality($municipality);
		$client->setProvince($province);
		$client->setFiscalCode($fiscalCode);
		$client->setPhone($phone);
		$client->setEmail($email);
		

        $client->save();

        return $client;
    }

    public function getClients(Request $request){
        $query = $this->getModel()->select('*');

        if($request->input('filter_id')){
            $query->where('id','=', $request->input('filter_id'));
        }
        if($request->input('filter_business_name')){
            $query->where('business_name','like', '%'.$request->input('filter_business_name').'%');
        }
        if($request->input('filter_address')){
            $query->where('address','like', '%'.$request->input('filter_address').'%');
        }
        if($request->input('filter_municipality')){
            $query->where('municipality','like',  '%'.$request->input('filter_municipality').'%');
        }
        if($request->input('filter_province')){
            $query->where('province','like',  '%'.$request->input('filter_province').'%');
        }
        if($request->input('filter_postcode')){
            $query->where('postcode','=',  $request->input('filter_postcode'));
        }
        if($request->input('filter_email')){
            $query->where('email','=', '%'.$request->input('filter_email').'%');
        }

        return $query;

    }

}
