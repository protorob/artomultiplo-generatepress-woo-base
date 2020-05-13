<?php

if ( ! defined( 'ABSPATH' ) ) { 
        exit; // Exit if accessed directly
}

?>

<div class="xoo-el-container">

        <div class="xoo-el-opac"></div>

        <div class="xoo-el-modal">

                <div class="xoo-el-inmodal">
        
                        <span class="xoo-el-close xoo-el-icon-cancel-circle"></span>
        
                        <div class="xoo-el-wrap">
                                <div class="xoo-el-sidebar"></div>
                                <div class="xoo-el-srcont">

                                        <div class="xoo-el-main">
                                                <?php
                                                $args = array(
                                                        'form_class' => 'xoo-el-form-popup',
                                                );  
                                                xoo_get_template( 'xoo-el-form.php', XOO_EL_PATH.'/templates/', $args ); ?>
                                        </div>

                                </div>
                        </div>

                </div>

        </div>

</div>

