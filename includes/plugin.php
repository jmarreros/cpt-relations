<?php

namespace cpt\rel\includes;

class Plugin{

    public function __construct(){
        register_activation_hook( CPT_REL_BASE_NAME, [ $this, 'activation_plugin'] );
        register_deactivation_hook( CPT_REL_BASE_NAME, [ $this, 'deactivation_plugin'] );
    }

    // Activate plugin - create options and database table
    public function activation_plugin(){
    }

    // Deactivate plugin
    public function deactivation_plugin(){
    }

}
