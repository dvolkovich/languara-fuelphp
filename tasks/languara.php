<?php

namespace Fuel\Tasks;

use Languara\Wrapper\LanguaraWrapper as LanguaraWrapper;

class Languara
{
    public function run()
    {
        $languara = new LanguaraWrapper();
        
        \Cli::write($languara->get_message_text('notice_available_commands'));
        \Cli::write($languara->get_message_text('notice_push_command_info'));
        \Cli::write($languara->get_message_text('notice_pull_command_info'));
        \Cli::write($languara->get_message_text('notice_register_command_info'));
    }
    
    public static function push()
    {
        ini_set('memory_limit', '-1');
        $languara = new LanguaraWrapper();
        
        // this is a hack, because FuelPHP buffers all response before printing
        // in the command line, unless you use the frameworks methods for outputing
        while (@ob_end_flush());
        
        $languara->print_message('notice_starting_upload', 'SUCCESS');
        
        try
        {
            $languara->upload_local_translations();            
        } 
        catch (\Exception $ex) 
        {
            $languara->print_message($ex->getMessage(), 'FAILURE');
            return;
        }
        
        $languara->print_message('success_upload_successful', 'SUCCESS');
    }
    
    public static function pull()
    {
        ini_set('memory_limit', '-1');
        $languara = new LanguaraWrapper();
        
        // this is a hack, because FuelPHP buffers all response before printing
        // in the command line, unless you use the frameworks methods for outputing
        while (@ob_end_flush());
        
        $languara->print_message('notice_starting_download', 'SUCCESS');
        
        try
        {
            $languara->download_and_process();          
        } 
        catch (\Exception $ex) 
        {
            $languara->print_message($ex->getMessage(), 'FAILURE');
            return;
        }
        
        $languara->print_message('success_download_successful', 'SUCCESS');
    }
    
    public static function register()
    {
        ini_set('memory_limit', '-1');
        $languara = new LanguaraWrapper();
        
        // this is a hack, because FuelPHP buffers all response before printing
        // in the command line, unless you use the frameworks methods for outputing
        while (@ob_end_flush());
        
        $languara->print_message('notice_register_command', 'SUCCESS');
        
        try
        {
            $languara->register($languara->platform);          
        } 
        catch (\Exception $ex) 
        {
            $languara->print_message($ex->getMessage(), 'FAILURE');
            return;
        }
        
        $languara->print_message('success_registration_completed', 'SUCCESS');
    }
    
    public static function translate()
    {
        $languara = new LanguaraWrapper();
        
        // this is a hack, because FuelPHP buffers all response before printing
        // in the command line, unless you use the frameworks methods for outputing
        while (@ob_end_flush());
        
        $languara->print_message('notice_start_translate', 'SUCCESS');
        
        try
        {
            $languara->translate();          
        } 
        catch (\Exception $ex) 
        {
            $languara->print_message($ex->getMessage(), 'FAILURE');
            return;
        }
        
        $languara->print_message('success_translate_completed', 'SUCCESS');
    }
}

/* End of file tasks/languara.php */
