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
    public $type;

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

        $this->type = $this->createType();
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
        $list = $this->generatePathList();

        foreach ($list as $path) {
            try {
                return view($path);
            } catch (\Exception $e) {
                // nothing to do
            }
        }

        //dump($this->data()['attributes']);
        //return view('shield::components.text');
    }

    private function generatePathList()
    {
        $list = [
            'shield::components.' . $this->name,
            'shield::components.text'
        ];

        return array_unique($list);
    }

    private function createType()
    {
        $request = \Request();
        $prefix = $request->route()->getPrefix();

        $classFullName = get_class($this);
        $list = explode('\\', $classFullName);
        $className = strtolower(end($list));

        if (substr($prefix, 0, 1) === '/') {
            $prefix = ltrim($prefix, '/');
        }

        if ($prefix !== '') {
            $prefix = str_replace('/', '.', $prefix);
            $prefix .= '.';
        }

        return sprintf("%s%s", $prefix, $className);;
    }
}
