<?php
namespace SlkAcl\Entity;

use ZfcUser\Entity\User as BaseUser;

class User extends BaseUser {
	/**
	 * The role assigned to the user
	 * @var string
	 */
	protected $role;
	
	/**
	 * Gets the roles assigned to the user
	 * @return string|null
	 */
	public function getRole() {
		return $this->role;
	}	
	
	/**
	 * Sets the roles to the user
	 * @param string $role
	 */
	public function setRole($role) 
	{
		$this->role = $role;	
	}
}