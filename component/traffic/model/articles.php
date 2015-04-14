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

class ModelArticles extends Library\ModelTable
{
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
		    ->insert('published' , 'int')
		    ->insert('street' , 'int')
            ->insert('category' , 'string')
            ->insert('type' , 'string')
		    ->insert('date' , 'string')
            ->insert('results' , 'boolean');
	}

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryJoins($query);
        $state = $this->getState();

        $query->join(array('categories'  => 'traffic_categories'), 'categories.traffic_category_id = tbl.traffic_category_id');

        if(is_numeric($state->street)){
            $query->join(array('street_relation' => 'streets_relations'), 'street_relation.row = tbl.traffic_article_id')
                ->join(array('street' => 'data.streets'), 'street.streets_street_identifier = street_relation.streets_street_identifier');

        }
    }
	
	protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
	    parent::_buildQueryWhere($query);
		$state = $this->getState();

		if ($state->search) {
			$query->where('tbl.title LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
		}

        if(!is_numeric($state->category) && !is_null($state->category)) {
            $query->where('categories.slug = :category')->bind(array('category' => $state->category));
        }

        if(is_numeric($state->category)) {
            $query->where('tbl.traffic_category_id = :category')->bind(array('category' => $state->category));
        }
		
		if (is_numeric($state->published)) {
			$query->where('tbl.published = :published')->bind(array('published' => $state->published));
		}

		if ($state->date == 'past') {
			$query->where('tbl.end_on < :past')->bind(array('past' => date('Y-m-d')));
		}

		if ($state->date == 'upcoming') {
            $query->where('(tbl.end_on >= :today OR tbl.end_on IS NULL)')->bind(array('today' => date('Y-m-d')));
		}

        if ($state->results) {
            $query->where('(tbl.controlled IS NOT NULL AND tbl.in_violation IS NOT NULL)');
            $query->where('tbl.end_on < :past')->bind(array('past' => date('Y-m-d')));
        }

        if(is_numeric($state->street)){
            $query->where('street_relation.table = :table')->bind(array('table' => 'traffic'));
            $query->where('street.streets_street_identifier = :street')->bind(array('street' => $state->street));
        }
	}
}
