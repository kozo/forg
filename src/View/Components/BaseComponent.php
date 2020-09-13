<?php

namespace Shield\View\Components;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Shield\ClassAttributeBag;

/*
 * https://github.com/tomsix/laravel-components-library
 * これを参考にする
 */
abstract class BaseComponent extends Component
{
    public $name;
    public $value;

    /**
     * Get the view / view contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    abstract public function render();

    /**
     * @param $name
     * @param $attrValue
     * @param $defaultValue
     * @return mixed|null
     */
    protected function getValue($name, $attrValue, $defaultValue)
    {
        $oldList = old();

        $dotName = $this->parseArrayToDot($name);
        $oldValue = Arr::get($oldList, $dotName);
        //if (array_key_exists($name, $oldList)) {
        if ($oldValue !== null) {
            return $oldValue;
        }

        if ($attrValue !== null) {
            return $attrValue;
        }

        // @todo : get relation value
        $model = Open::model();
        $value = $model->{$name} ?? null;
        if ($value !== null) {
            return $value;
        }

        if ($defaultValue !== null) {
            return $defaultValue;
        }

        return null;
    }

    /**
     * @param $id
     * @param $name
     * @return string
     */
    protected function generateId($id, $name): string
    {
        if ($id === null) {
            return uniqid($name, false);
        } else {
            return $id;
        }
    }

    /**
     * @param $name
     * @param $class
     * @return ClassAttributeBag
     */
    protected function generateClassAttribute($name, $class): ClassAttributeBag
    {
        $classAttributes = new ClassAttributeBag();

        $defaultClass = config('shield.default_class');
        if ($defaultClass !== false && !empty($defaultClass)) {
            $classAttributes[] = $defaultClass;
        }

        if (!empty($class)) {
            $classAttributes[] = $class;
        }

        if ($this->isError($name)) {
            $classAttributes[] = config('shield.has_error_class');
        }

        return $classAttributes;
    }

    /**
     * @param $name
     * @return bool
     */
    protected function isError($name): bool
    {
        $errors = \Request()->session()->get('errors');
        if (empty($errors)) {
            return false;
        }
        $dotName = $this->parseArrayToDot($name);
        /*dump($name);
        dump($errors);exit;//*/

        /*
         * $array = ['products' => ['desk' => ['price' => 100]]];
           $flattened = Arr::dot($array);
           // ['products.desk.price' => 100]
         */
        //Arr::dot($array);

        $errorKeys = $errors->getBag('default')->keys();
        //dump($dotName);
        //dump($errorKeys);
        return in_array($dotName, $errorKeys, true);
    }

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function errorClass()
    {
        return config('shield.error_message_class');
    }

    public function getConfig($name)
    {
        return config('shield.' . $name);
    }

    public function parseArrayToDot($name)
    {
        $contains = Str::contains($name, '[');
        if ($contains === false)  {
            return $name;
        }
        $str = Str::of($name)->replace('[', '.')->replace(']', '');
        return (string)$str;
    }
}
