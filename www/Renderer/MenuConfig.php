<?php

namespace App\Renderer;

use App\Renderer\Abstract\RenderAbs;

class MenuConfig extends RenderAbs
{
    private $menu;

    public function __construct($menu)
    {
        $this->menu = $menu;
    }

    public function getConfig(): array
    {
        $menuItems = [];
        if ($this->menu) {
            $itemsStr = trim($this->menu[0]['items'], '{}');
            $itemsArray = explode(',', $itemsStr);
            foreach ($itemsArray as $item) {
                $menuItems[$item] = [
                    "id" => $item,
                    "class" => "nav-item",  // add classes as required
                    "text" => ucfirst($item),
                    "link" => "/" . $item
                ];
            }
        }

        return [
            "config" => [
                "id" => "navbar",
                "class" => "text-xl",
            ],
            "menu" => [
                "id" => "navbar",
                "items" => $menuItems
            ]
        ];
    }
}
