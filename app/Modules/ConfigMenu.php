<?php


namespace App\Modules;


use Illuminate\Support\Facades\Route;

class ConfigMenu
{
    private $menu;
    private $submenu;
    private $items;
    private $item;

    public function __construct($menu)
    {
        $menuList = collect(config('menu_header.items'));
        $this->menu = collect($menuList->where('title', 'Manager')->first());
        $this->setSubmenu();
        $this->setItems();
    }

    public function setSubmenu() {
        $this->submenu = collect($this->menu->get('submenu'));

        return $this;
    }

    public function setItems()
    {
        $this->items = collect($this->submenu->get('items'));

        return $this;
    }

    public function item($titleOrPage)
    {
        $titleOrPage = str_replace('https://pay/', '', $titleOrPage);
        $titleOrPage = str_replace('https://gp.gost.agency/', '', $titleOrPage);

        $item = $this->items->where('title', $titleOrPage)->isNotEmpty() ?
            $this->items->where('title', $titleOrPage) :
            $this->items->where('page', $titleOrPage);

        $this->item = collect($item->first());

        return $this;
    }

    public function permission()
    {
        $result = $this->item->get('permission') ?: $this->menu->get('permission');

        return $result;
    }

    public function title()
    {
        return $this->item->get('title');
    }

    public function description()
    {
        return $this->item->get('description');
    }

    public static function whereRoute($route)
    {

        $route = str_replace('https://pay/', '', $route);
        $route = str_replace('https://gp.gost.agency/', '', $route);

        $menuList = collect(config('menu_header.items'));

        foreach ($menuList as $menu) {
            if(empty($menu)) continue;

            $menu = self::make($menu['title']);
            $menu->item = collect($menu->items->where('page', $route)->first());
        }

        return $menu ?? '';
    }

    public static function getPermission($route)
    {
        return self::whereRoute($route)->permission();
    }

    public static function getTitle($route)
    {
        return self::whereRoute($route)->title();
    }

    public static function getDescription($route)
    {
        return self::whereRoute($route)->description();
    }

    static function make(string $menu = '')
    {
        return new self($menu);
    }
}
