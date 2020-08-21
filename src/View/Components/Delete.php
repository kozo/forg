<?php

namespace Shield\View\Components;

use Illuminate\View\Component;

/*
 * https://github.com/tomsix/laravel-components-library
 * これを参考にする
 */
class Delete extends Component
{
    public $id;
    public $name;
    public $value;

    /**
     * Create a new component instance.
     *
     * @param $target
     * @param string $name
     * @param $aaa
     */
    public function __construct($name, $id=null, $value=null, $defaultValue=null)
    {

        $this->name = $name;

        if ($id === null) {
            $this->id = uniqid($name, false);
        } else {
            $this->id = $id;
        }

        $this->value = $this->getValue($name, $value, $defaultValue);

        dump(Open::model());
        dump($name);
        dump(old($name));
        // 動かないときはキャッシュ？
        // php artisan view:clear
        //dump($this->extractPublicProperties());
        //dump($this->createInvokableVariable());
        //
        //echo "<pre>";
        //ini_set('memory_limit', -1);
        //var_dump(debug_backtrace (DEBUG_BACKTRACE_PROVIDE_OBJECT , 2));exit;
        //$this->name = $name;

        // これでエラーメッセージ関連を取り出せる
        // dump("aaaa");
        // $e = \Request()->session()->get('errors')->getBag('default')->keys();
        // dump($e);

        // ComponentAttributeBagに使われてないAttibuteが入ってる
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
}
