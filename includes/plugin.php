<?php

namespace cpt\rel\includes;

class Plugin{

    public function __construct(){
        register_activation_hook( CPT_REL_BASE_NAME, [ $this, 'dcms_activation_plugin'] );
        register_deactivation_hook( CPT_REL_BASE_NAME, [ $this, 'dcms_deactivation_plugin'] );
    }

    // Activate plugin - create options and database table
    public function dcms_activation_plugin(){
    }

    // Deactivate plugin
    public function dcms_deactivation_plugin(){
    }

}
