<?php

namespace Shield\View\Components;

use Illuminate\View\Component;

/*
 * https://github.com/tomsix/laravel-components-library
 * これを参考にする
 */
class Open extends Component
{
    private static $model;

    public $action;
    public $method;
    public $charset;

    /**
     * Create a new component instance.
     *
     * @param $action
     * @param $method
     * @param null $model
     * @param string $charset
     */
    public function __construct($action, $method, $model = null, $charset = 'UTF-8')
    {
        $this->action = $action;
        $this->method = $method;
        $this->charset = $charset;

        self::$model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('shield::components.open');
    }

    public static function model()
    {
        return self::$model;
    }
}
