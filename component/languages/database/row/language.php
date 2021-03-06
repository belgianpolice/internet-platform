<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Languages;

use Nooku\Library;

/**
 * Language Database Row
 *
 * @author  Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package Nooku\Component\Languages
 */
class DatabaseRowLanguage extends Library\DatabaseRowTable
{
    public function save()
    {
        $modified = $this->isModified('enabled');
        $result   = parent::save();
        
        if($this->getStatus() == Library\Database::STATUS_UPDATED && $modified && $this->enabled && $this->application == 'site')
        {
            $tables   = $this->getObject('com:languages.model.tables')->enabled(true)->getRowset();
            $database = $this->getTable()->getAdapter();
            
            foreach($tables as $table)
            {
                $table_name = strtolower($this->iso_code).'_'.$table->name;
                
                $table->name_primary = $table->name;
                $table->name = 'fr-be_'.$table->name;

                // Add language specific table and copy the content of the original table.
                $database->execute('CREATE TABLE '.$database->quoteIdentifier($table_name).' LIKE '.$database->quoteIdentifier($table->name));
                
                $select = $this->getObject('lib:database.query.select')
                    ->table($table->name);
                
                $insert = $this->getObject('lib:database.query.insert')
                    ->table($table_name)
                    ->values($select);
                
                $database->insert($insert);

                // Add items to the translations table.
                $columns = array(
                    'iso_code'  => ':iso_code',
                    'table'     => ':table',
                    'row'       => 'tbl.'.$table->unique_column,
                    'slug'      => $this->_findColumn($table->name, 'slug') ? 'slug' : ':slug',
                    'status'    => ':status',
                    'original'  => ':original'
                );
                
                $select = $this->getObject('lib:database.query.select')
                    ->columns($columns)
                    ->table(array('tbl' => $table_name))
                    ->bind(array(
                        'iso_code'  => $this->iso_code,
                        'table'     => $table->name_primary,
                        'status'    => DatabaseRowTranslation::STATUS_MISSING,
                        'original'  => 0,
                        'slug'      => null
                    ));
                
                $insert = $this->getObject('lib:database.query.insert')
                    ->table('languages_translations')
                    ->columns(array_keys($columns))
                    ->values($select);
                
                $database->insert($insert);
            }
        }
        
        return $result;
    }

    public function _findColumn($table, $needle)
    {
        $database  = $this->getTable()->getAdapter();

        $query  = $this->getObject('lib:database.query.show')
            ->show('COLUMNS')
            ->from($table);

        foreach($database->select($query) as $column)
        {
            if ( $column['Field'] === $needle )
            {
                return true;
            }
        }

        return false;
    }
}