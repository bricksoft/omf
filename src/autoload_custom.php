<?php
    date_default_timezone_set('Europe/Berlin');
    class autoload_custom
    {
        const FILE_EXTENSION = '.php';
        public static function register()
        {
            spl_autoload_register(array(
                __CLASS__,
                'load'
            ));
            \App\handlers\error::register();
        }
        
        public static function load($className)
        {
            if (strrpos($className, "App", -strlen($className)) !== FALSE || strrpos($className, "\\App", -strlen($className)) !== FALSE) {
                $className = substr_replace($className, "src" . ds, 0, 0);
            }
            
            $filePath = BASE_DIR . ds . str_replace('\\', ds, $className) . self::FILE_EXTENSION;
			
            // first let composer autoloader try to load it -> else create error if it fails
            file_exists($filePath) ? include $filePath : new \App\handlers\error('error', 'Main-autoloader', 'could not find $className');
        }
    }
    
    /*
     * BASE_DIR is used as Constant of the BASE directory
     * it is essential else that directory would need to get found out every time
     *
     * ds is used as shortcut for DIRECTORY_SEPARATOR,
     * as DIRECTORY_SEPARATOR would be less readable
     * this is optional and only for readability
     */
    define("BASE_DIR", dirname(__DIR__));
    define("ds", DIRECTORY_SEPARATOR);
    
    //registering autoloaders
    autoload_custom::register();  
?>