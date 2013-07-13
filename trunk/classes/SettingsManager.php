<?php
class SettingsManager{
	public function getSetting($name){
		$setting = new Setting();
		$setting->Load("name = ?",array($name));
		if($setting->name == $name){
			return $setting->value;
		}	
		return null;
	}
}