<?php
/*
 * @since 1.0
 * Content for the options
 *  
 */
?>
          

  
    
<div class="wrap admin-page fegoed-options" >
 
    <h1 class="title"><?php echo esc_html( get_admin_page_title() ); ?></h1>
 
    <form method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">




        <label for="user-checkbox" class="regular-number">Checkbox: </label>
        <input type="checkbox" name="user-checkbox" value="1" <?php echo $this->GetCheckbox('user-checkbox'); ?> >  
        <br/>
        <label for="plugin-serial" class="regular-number">Serial Code: </label>
        <input type="text" name="plugin-serial" value="<?php echo $this->GetOption('plugin-serial'); ?>" >   

        <input type="hidden" name="action" value="<?php echo $this->myaction; ?>">      
        <input type="hidden" name="version" value="<?php echo $this->GetOption('version'); ?>">
        <?php
            wp_nonce_field( $this->mynonce, $this->nonce_field );
            submit_button(); 
        ?> 
    </form>   
    
    
        <h5><a href="index.php?page=fegoeducation-about-page">Return to the Welcome Page</a></h5>
        
        
</div>        

    


            
            
            




 
            
