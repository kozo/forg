<?php

namespace Shield\View\Components;

use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Shield\ClassAttributeBag;

/*
 * https://github.com/tomsix/laravel-components-library
 * これを参考にする
 */
class Radio extends BaseComponent
{
    public $id;
    public $name;
    public $options;
    public $value;
    public $class;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param array $options
     * @param string|null $id
     * @param string|null $class
     * @param string|null $value
     * @param string|null $defaultValue
     */
    public function __construct($name, $options, $id=null, $class=null, $value=null, $defaultValue=null)
    {
        $this->name = $name;
        $this->options = $options;

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
        return view('shield::components.radio');
    }

    public function selected($option)
    {
        if ($option == $this->value) {
            return 'selected';
        } else {
            return '';
        }
    }

    /**
     * @return string
     */
    public function multipled(): string
    {
        if ($this->multiple === true) {
            return 'multiple';
        } else {
            return '';
        }
    }

    /**
     * @param $empty
     * @return bool
     */
    private function isEmpty($empty): bool
    {
        if ($empty === false) {
            return false;
        }

        if (is_string($empty)) {
            $this->emptyText = $empty;
        }

        return true;
    }
}
