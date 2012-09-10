<?php
namespace bankaccount\framework\router;

use bankaccount\framework\http\Request;
use bankaccount\framework\HashMap;

class Router
{
    use HashMap;

    public function route(Request $request)
    {
        $parts = explode('/', $request->getURI());
        unset($parts[0]);

        $controller = array_shift($parts);

        if (!isset($this->values[$controller])) {
            throw new Exception;
        }

        if (count($parts) % 2 != 0) {
            throw new Exception;
        }

        $keys  = array_keys($parts);
        $count = count($keys);

        for ($i = 0; $i < $count; $i += 2) {
            $request->set($parts[$keys[$i]], $parts[$keys[$i+1]]);
        }

        return $this->values[$controller];
    }
}
