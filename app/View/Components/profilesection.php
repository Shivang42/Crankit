<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class profilesection extends Component
{
    protected $sections = [
        'education'=>[
            'header'=>'Add educational experience',
            'icon'=>'https://api.iconify.design/tdesign:education.svg?color=%23ffffff',
            'fields'=>[
                [['name'=>"inst_name",'type'=>'text','placeholder'=>"Name of your institution"]],
                [['label'=>'Starting Date','name'=>"start_date",'type'=>'date'],['label'=>'Completion Date','name'=>"end_date",'type'=>'date']],
                [['name'=>"inst_course",'type'=>'text','placeholder'=>"Name of programme"]],
                [['name'=>"description",'type'=>'textarea','placeholder'=>"Any achievements during the course"]]
            ]
        ],
        'work'=>[
            'header'=>'Add work experience',
            'icon'=>'https://api.iconify.design/uil:suitcase-alt.svg?color=%23ffffff',
            'fields'=>[
                [['name'=>"org_name",'type'=>'text','placeholder'=>"Name of your organization/company"]],
                [['name'=>"start_date",'label'=>'Starting Date','type'=>'date'],['name'=>"end_date",'label'=>'Completion Date','type'=>'date']],
                [['name'=>"org_pos",'type'=>'text','placeholder'=>"Title/position held"]],
                [['name'=>"description",'type'=>'textarea','placeholder'=>"Any responsibilities held"]]
            ]
        ],
        'project'=>[
            'header'=>'Add Project',
            'icon'=>'https://api.iconify.design/tabler:tools.svg?color=%23ffffff',
            'fields'=>[
                [['name'=>"proj_name",'type'=>'text','placeholder'=>"Project Title"]],
                [['name'=>"description",'type'=>'textarea','placeholder'=>"Description"]],
                [['name'=>"start_date",'label'=>'Starting Date','type'=>'date'],['name'=>"end_date",'label'=>'Completion Date','type'=>'date']],
                [['name'=>"proj_media[]",'type'=>'multfiles','limit'=>5]]
            ]
        ]
    ];
    public function __construct(String $type)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Closure
    {
        $section = $this->sections[$this->type];
        return function() use($section){
            return view('components.profilesection',['type'=>$this->type,'section'=>$section]);
        };
    }
}
