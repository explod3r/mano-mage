<?php
// app/code/local/Envato/Recentproducts/Model/Recentproducts.php
class Nortal_Workinghours_Model_Workinghours extends Mage_Core_Model_Abstract {
    
    public function getWorkingHours($weekday) {
        
        $resource = Mage::getSingleton('core/resource');
        
        $readConnection = $resource->getConnection('core_read');
        
        $tableName = $resource->getTableName('store_workhours');
        
        $query = "SELECT * FROM " . $tableName . 
            " WHERE weekday = '" . $weekday . "'";
        
        $workinghours = $readConnection->fetchAll($query);
        
        return $workinghours[0];
    }
    
}