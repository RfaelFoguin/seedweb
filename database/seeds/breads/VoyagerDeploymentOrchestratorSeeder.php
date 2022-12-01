<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

class VoyagerDeploymentOrchestratorSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath = __DIR__.'/';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
        $this->seed(PesquisadoresBreadTypeAdded::class);
        $this->seed(PesquisadoresBreadRowAdded::class);
        $this->seed(SementesBreadDeleted::class);
        $this->seed(SementesBreadTypeAdded::class);
        $this->seed(SementesBreadRowAdded::class);
    }
}
