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
 * Event Command
 *
 * The event commend will translate the command name to a onCommandName format and let the event dispatcher dispatch
 * to any registered event handlers.
 *
 * The 'clone_context' config option defines if the context is clone before being passed to the event dispatcher or
 * it passed by reference instead. By default the context is cloned.
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Command
 */
class CommandEvent extends EventMixin implements CommandInterface
{
    /**
     * The command priority
     *
     * @var integer
     */
    protected $_priority;

    /**
     * Object constructor
     *
     * @param ObjectConfig $config Configuration options
     */
    public function __construct(ObjectConfig $config)
    {
        parent::__construct($config);

        //Set the command priority
        $this->_priority = $config->priority;
    }

    /**
     * Command handler
     *
     * This functions returns void to prevent is from breaking the chain.
     *
     * @param   string  $name    The command name
     * @param   object  $context The command context
     * @return  void
     */
    public function execute($name, CommandContext $context)
    {
        $type = '';

        if ($context->getSubject())
        {
            $identifier = clone $context->getSubject()->getIdentifier();

            if ($identifier->path) {
                $type = array_shift($identifier->path);
            } else {
                $type = $identifier->name;
            }
        }

        $parts = explode('.', $name);
        $name = 'on' . ucfirst(array_shift($parts)) . ucfirst($type) . StringInflector::implode($parts);

        if($this->getConfig()->clone_context) {
            $event = clone($context);
        } else {
            $event = $context;
        }

        $event = new Event($event);
        $event->setTarget($context->getSubject());

        $this->getEventDispatcher()->dispatchEvent($name, $event);
    }

    /**
     * Get the methods that are available for mixin.
     *
     * @param  Object $mixer Mixer object
     * @return array An array of methods
     */
    public function getMixableMethods(ObjectMixable $mixer = null)
    {
        $methods = parent::getMixableMethods();

        unset($methods['execute']);
        unset($methods['getPriority']);

        return $methods;
    }

    /**
     * Get the priority of a behavior
     *
     * @return	integer The command priority
     */
    public function getPriority()
    {
        return $this->_priority;
    }
}