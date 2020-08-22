<?php

namespace Shield\View\Components;

use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Shield\ClassAttributeBag;

/*
 * https://github.com/tomsix/laravel-components-library
 * これを参考にする
 */
class Text extends BaseComponent
{
    public $id;
    public $name;
    public $value;
    public $class;

    /**
     * Create a new component instance.
     *
     * @param $target
     * @param string $name
     * @param $aaa
     */
    public function __construct($name, $id=null, $class=null, $value=null, $defaultValue=null)
    {

        $this->name = $name;

        $this->class = $this->generateClassAttribute($name, $class);

        $this->id = $this->generateId($id, $name);

        $this->value = $this->getValue($name, $value, $defaultValue);

        // 動かないときはキャッシュ？
        // php artisan view:clear

        //dump($this->extractPublicProperties());
        //dump($this->createInvokableVariable());

        // ComponentAttributeBagに使われてないAttibuteが入ってる
        // ただ、値を詰め込むのはもっと後かも(bladeをrennderしないと値取れないはずだし)
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        //dump($this->data()['attributes']);
        return view('shield::components.text');
    }
}
