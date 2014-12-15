<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Traffic;
use Nooku\Library;

class ModelStreets extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('article' , 'int');
    }

    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryColumns($query);

        $cities = $this->getObject('com:police.model.zones')->id($this->getObject('application')->getSite())->getRow()->cities;

        // Add city to street for multi-city zones
        $query->columns(array(
            'title' => $cities == '1' ? 'street.title' : "CONCAT(street.title, ' (', city.title, ')')"
        ));
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        $query->join(array('street' => 'data.streets'), 'street.streets_street_id = tbl.streets_street_id')
              ->join(array('city' => 'data.streets_cities'), 'city.streets_city_id = street.streets_city_id');
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);
        $state = $this->getState();

        if ($state->article) {
            $query->where('tbl.traffic_article_id = :article')->bind(array('article' => $state->article));
        }
    }
}