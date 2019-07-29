<?php

namespace AriAbid\LaravelViewTracer;

use Illuminate\Support\Facades\View;

class LaravelViewTracer {

    public static function initViewComposerAndCreator()
    {
        View::composer('*', function($view) {
            echo '<div class="laravel-view-tracer">';
            echo "<div class='laravel-view-tracer__path'>{$view->getPath()}";
            echo "<div class='laravel-view-tracer__more'>";
            $data = $view->getData();
            unset($data['obLevel']);
            unset($data['__env']);
            unset($data['app']);
            echo '<table class="laravel-view-tracer__table">';
            echo "<tr><td colspan='2'>View name: {$view->getName()}</td></tr>";
            if(sizeof($data) > 0) {
                echo "<tr><th colspan='2'>Data with view</th></tr>";
                echo "<tr><th>Key</td><td>Value</td></tr>";
                foreach($data as $key => $val) {
                    echo "<tr><th>$key - </td><td>$val</td></tr>";
                }
            }
            echo '</table>';
            echo "</div>";
            echo "</div>";
        });

        View::creator('*', function($view) {
            echo '</div>';
        });
    }

    public static function loadStylesToResponse($content)
    {
        $content .= '<style>
            .laravel-view-tracer {
                border: 1px solid red;
                font-family: Arial;
                color: #000;
                position: relative;
                font-size: 12px;
            }
            .laravel-view-tracer .laravel-view-tracer__path {
                position: absolute;
                top: 0;
                left: 0;
                background: #e00909;
                color: #FFF;
                padding: 3px 5px;
                z-index: 99999
            }
            .laravel-view-tracer .laravel-view-tracer__more {
                display: none
            }
            .laravel-view-tracer .laravel-view-tracer__path:hover .laravel-view-tracer__more{
                display: block
            }
            .laravel-view-tracer .laravel-view-tracer__table {
                font-family: inherit;
                font-size: inherit;
                color: inherit;
                text-align: left;
            }
        </style>';

        return $content;
    }

}