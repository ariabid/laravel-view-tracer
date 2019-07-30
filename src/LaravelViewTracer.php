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
            echo "<div>View name : - {$view->getName()}</div>";
            if(sizeof($data) > 0) {
                $dataKeys = array_keys($data);
                $keys = implode(', ', $dataKeys);
                echo "<div>Data vars : - $keys</div>";
            }
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
                border: 1px dashed red;
                font-family: Arial;
                color: #000;
                position: relative;
                font-size: 12px;
				text-align: left !important;
			}
			.laravel-view-tracer__path > div {
				line-height: 1.5;

			}
            .laravel-view-tracer .laravel-view-tracer__path {
                position: absolute;
                top: 0;
                left: 0;
                background: yellow;
    			color: #312f2f;
                padding: 3px 5px;
                z-index: 99999
            }
            .laravel-view-tracer .laravel-view-tracer__more {
                display: none
            }
            .laravel-view-tracer .laravel-view-tracer__path:hover .laravel-view-tracer__more{
                display: block
            }
        </style>';

        return $content;
    }

}