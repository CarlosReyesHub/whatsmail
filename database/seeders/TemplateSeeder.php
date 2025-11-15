<?php

namespace Database\Seeders;

use App\Models\Cms\Template;
use App\Models\Cms\TemplateComponent; 
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $template = Template::create([
            'name'          => 'Basic Template',
            'code'          => 'template1',
            'thumbnail'     => 'uploads/templates/template01.jpg',
        ]);   
    
        $data = [
            [
                'id'            => Uuid::uuid4()->toString(),
                'template_id'   => $template->id,
                'type'          => 'styles',
                'path'          => 'assets/frontend/template1/libs/fortawesome/fontawesome-free/css/all.min.css'
            ],
            [
                'id'            => Uuid::uuid4()->toString(),
                'template_id'   => $template->id,
                'type'          => 'styles',
                'path'          => 'assets/frontend/template1/libs/nucleo/css/nucleo.css'
            ],
            [
                'id'            => Uuid::uuid4()->toString(),
                'template_id'   => $template->id,
                'type'          => 'styles',
                'path'          => 'assets/frontend/template1/libs/prismjs/themes/prism.css'
            ],
            [
                'id'            => Uuid::uuid4()->toString(),
                'template_id'   => $template->id,
                'type'          => 'styles',
                'path'          => 'assets/frontend/template1/css/front.css'
            ],

            [
                'id'            => Uuid::uuid4()->toString(),
                'template_id'   => $template->id,
                'type'          => 'scripts',
                'path'          => 'assets/frontend/template1/libs/jquery/dist/jquery.min.js'
            ],
            [
                'id'            => Uuid::uuid4()->toString(),
                'template_id'   => $template->id,
                'type'          => 'scripts',
                'path'          => 'assets/frontend/template1/libs/popper.js/dist/umd/popper.min.js'
            ],
            [
                'id'            => Uuid::uuid4()->toString(),
                'template_id'   => $template->id,
                'type'          => 'scripts',
                'path'          => 'assets/frontend/template1/libs/bootstrap/dist/js/bootstrap.min.js'
            ],
            [
                'id'            => Uuid::uuid4()->toString(),
                'template_id'   => $template->id,
                'type'          => 'scripts',
                'path'          => 'assets/frontend/template1/libs/headroom.js/dist/headroom.min.js'
            ],
            [
                'id'            => Uuid::uuid4()->toString(),
                'template_id'   => $template->id,
                'type'          => 'scripts',
                'path'          => 'assets/frontend/template1/libs/onscreen/dist/on-screen.umd.min.js'
            ],
            [
                'id'            => Uuid::uuid4()->toString(),
                'template_id'   => $template->id,
                'type'          => 'scripts',
                'path'          => 'assets/frontend/template1/libs/waypoints/lib/jquery.waypoints.min.js'
            ],
            [
                'id'            => Uuid::uuid4()->toString(),
                'template_id'   => $template->id,
                'type'          => 'scripts',
                'path'          => 'assets/frontend/template1/libs/jarallax/dist/jarallax.min.js'
            ],
            [
                'id'            => Uuid::uuid4()->toString(),
                'template_id'   => $template->id,
                'type'          => 'scripts',
                'path'          => 'assets/frontend/template1/libs/smooth-scroll/dist/smooth-scroll.polyfills.min.js'
            ],
            [
                'id'            => Uuid::uuid4()->toString(),
                'template_id'   => $template->id,
                'type'          => 'scripts',
                'path'          => 'assets/frontend/template1/js/front.js'
            ],
        ];

        TemplateComponent::insert($data);
    }
}
