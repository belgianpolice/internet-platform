<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2007 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Library;

/**
 * Method Not Allowed Dispatcher Exception
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Dispatcher
 */
class DispatcherExceptionMethodNotAllowed extends HttpExceptionMethodNotAllowed implements DispatcherException {}