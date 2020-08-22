<?php

namespace Shield\View\Components;

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
        if (array_key_exists($name, $oldList)) {
            return $oldList[$name];
        }

        if ($attrValue !== null) {
            return $attrValue;
        }

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
            $classAttributes[] = config('shield.error_class');
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

        $errorKeys = $errors->getBag('default')->keys();
        return in_array($name, $errorKeys, true);
    }
}
