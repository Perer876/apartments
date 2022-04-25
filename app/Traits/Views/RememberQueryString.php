<?php

namespace App\Traits\Views;

use Illuminate\Http\Request;

trait RememberQueryString
{
    public $path;

    /**
     * Get the actual values that need to be remember for new sessions.
     * 
     * @return array
     */
    public function getRememberQueryInput()
    {
        if (isset($this->rememberQueryInput))
        {
            return $this->rememberQueryInput;
        }
        return [];
    } 

    /**
     * Get the last query input values for the current route that were stored last time.
     * 
     * @return array
     */
    public function getLastQueryInput(Request $request)
    {
        $pathsLastQuery = $request->session()->get('lastQuery', []);
        if (array_key_exists($request->path(), $pathsLastQuery))
        {
            return $pathsLastQuery[$request->path()];
        }
        return [];
    }

    /**
     * Takes the query string of the current request and decides which variables from
     * the remember query input should be restore acording to the values flashed to the
     * session.
     */
    public function restoreLastQueryInputs(Request $request)
    {
        $lastQueryInputValues = $this->getLastQueryInput($request);
        
        foreach($this->getRememberQueryInput() as $queryInputName)
        {            
            $queryInputValue = $request->query($queryInputName);
            if(!$queryInputValue and array_key_exists($queryInputName, $lastQueryInputValues))
            {
                $this->{$queryInputName} = $lastQueryInputValues[$queryInputName];
            }
        }
    }

    public function mountRememberQueryString(Request $request)
    {
        $this->path = $request->path();
        $this->restoreLastQueryInputs($request);
    }

    public function dehydrateRememberQueryString(Request $request)
    {
        $lastQuery = $request->session()->get('lastQuery', []);

        $currentState = [];
        foreach($this->getRememberQueryInput() as $queryInputName)
        {
            $currentState[$queryInputName] = $this->{$queryInputName};
        }
        
        $lastQuery[$this->path] = $currentState;
        $request->session()->put('lastQuery', $lastQuery);
    }
}
