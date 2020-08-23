<?php

namespace Shield\View\Components;

use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Shield\ClassAttributeBag;

/*
 * https://github.com/tomsix/laravel-components-library
 * これを参考にする
 */
class Textarea extends BaseComponent
{
    public $id;
    public $name;
    public $value;
    public $class;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string|null $id
     * @param string|null $class
     * @param string|null $value
     * @param string|null $defaultValue
     */
    public function __construct($name, $id=null, $class=null, $value=null, $defaultValue=null)
    {

        $this->name = $name;

        $this->class = $this->generateClassAttribute($name, $class);

        $this->id = $this->generateId($id, $name);

        $this->value = $this->getValue($name, $value, $defaultValue);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('shield::components.textarea');
    }
}
