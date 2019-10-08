<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = ['id'];
    protected $table = 'clients';
    protected $fillable = ['id', 'business_name', 'address', 'postcode', 'municipality', 'province', 'fiscal_code', 'phone', 'email', 'created_at', 'updated_at'];

    
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getBusinessName() {
		return $this->business_name;
	}

	public function setBusinessName($businessName) {
		$this->business_name = $businessName;
	}

	public function getAddress() {
		return $this->address;
	}

	public function setAddress($address) {
		$this->address = $address;
	}

	public function getPostcode() {
		return $this->postcode;
	}

	public function setPostcode($postcode) {
		$this->postcode = $postcode;
	}

	public function getMunicipality() {
		return $this->municipality;
	}

	public function setMunicipality($municipality) {
		$this->municipality = $municipality;
	}

	public function getProvince() {
		return $this->province;
	}

	public function setProvince($province) {
		$this->province = $province;
	}

	public function getFiscalCode() {
		return $this->fiscal_code;
	}

	public function setFiscalCode($fiscalCode) {
		$this->fiscal_code = $fiscalCode;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function setPhone($phone) {
		$this->phone = $phone;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getCreatedAt() {
		return $this->created_at;
	}

	public function setCreatedAt($createdAt) {
		$this->created_at = $createdAt;
	}

	public function getUpdatedAt() {
		return $this->updated_at;
	}

	public function setUpdatedAt($updatedAt) {
		$this->updated_at = $updatedAt;
	}


}
