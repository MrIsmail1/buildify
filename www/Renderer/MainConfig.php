<?php

namespace App\Renderer;

use App\Renderer\Abstract\RenderAbs;

class MainConfig extends RenderAbs
{
    private $page;
    private $template;

    public function __construct($page, $template)
    {
        $this->page = $page;
        $this->template = $template;
    }
    public function getConfig(): array
    {
        return [
            "config" => [
                "id" => "main",
                "class" => "text-xl",
            ],
            "title" => [
                "id" => "title",
                "class" => "text-[" . $this->template[0]["color"] . "] text-[" . $this->template[0]["font_size"] . "px] font-[" . $this->template[0]["font_family"] . "]",
                "text" => $this->page[0]["pagetitle"],
            ],
            "content" => [
                "id" => "",
                "class" => "text-[" . $this->template[0]["color"] . "] text-[" . $this->template[0]["font_size"] . "px] font-[" . $this->template[0]["font_family"] . "]",
                "text" => $this->page[0]["content"],
            ],
        ];
    }
}
