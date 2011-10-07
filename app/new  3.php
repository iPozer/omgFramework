<?
  static public function sortPosition($class, $id, $replace = 0, $link_field = null, $sql_where = ''){
        
        if($item = $class::retrieveByPK($id)){
        
            if($link_field){
                $colname = $class::translateFieldName($link_field, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
                $phpname = 'get' . $class::translateFieldName($link_field, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_PHPNAME);
                if(null === $link_value = $item->$phpname()){
                    $sql_where .= " AND {$colname} IS NULL";
                }else{
                    $sql_where .= " AND {$colname}={$link_value}";
                }            
            }
            
            if($replace === 0){
                $item->setPosition(0);
                $item->save();
            }else if(($replace_item = $class::retrieveByPK($replace)) && (!$link_field || $item->$phpname() == $replace_item->$phpname())){
                $item->setPosition($replace_item->getPosition()+1);
                $item->save();
                $sql_where .=  " AND `position`>{$replace_item->getPosition()}";
            }else{
                return 'Позиция элемента не может быть изменена';
            }
            
            Propel::getConnection()->query('UPDATE '.$class::TABLE_NAME.' SET '.$class:OSITION.'='.$class:OSITION.'+1 WHERE '.$class::ID.'<>'.$item->getId().$sql_where);
            return true;
            
        }else{
            return 'Элемент не найден';
        }
    
    }