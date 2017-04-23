<?php
// app/code/local/Envato/Recentproducts/Block/Recentproducts.php
class Nortal_Workinghours_Block_Workinghours extends Mage_Core_Block_Template {
    
    public function getWorkingHours() {
        
        $timezone = Mage::getStoreConfig('general/locale/timezone');
        
        $date = new DateTime('NOW', new DateTimeZone($timezone));
        
        $weekday = $date->format('l');
        $hour = $date->format('H');
        
        $todays_workhours = Mage::getModel("workinghours/workinghours")->getWorkingHours($weekday);
        
        $msg = [];
        
        if($hour <= $todays_workhours['close_at']){
            if($hour >= $todays_workhours['open_at']){
                $msg['text'] = 'Open Until: Today '.$todays_workhours['close_at'].'p.m.';
                $msg['status'] = 1;
            } else {
                $msg['text'] = 'Open At: Today '.$todays_workhours['open_at'].'a.m.';
                
                $msg['status'] = 0;
            }
        } elseif($weekday != 'Saturday') {
            $tomorrow = $date->modify('+1 day')->format('l');
            
            $tomorrow_workhours = Mage::getModel("workinghours/workinghours")->getWorkingHours($tomorrow);
            
            $msg['text'] = 'Open At: Tomorrow '.$tomorrow_workhours['open_at'].'a.m.';
            
            $msg['status'] = 0;
        } else {
            $monday = $date->modify('+2 day')->format('l');
            
            $tomorrow_workhours = Mage::getModel("workinghours/workinghours")->getWorkingHours($monday);
            
            $msg['text'] = 'Open At: Monday '.$tomorrow_workhours['open_at'].'a.m.';
            
            $msg['status'] = 0;
        }
        
        return $msg;
    }
    
}