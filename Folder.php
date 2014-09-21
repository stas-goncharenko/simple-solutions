<?php

class Folder {
    
    /**
     * create folder with empty index.html and 0775 rights
     *
     * @param string $path
     * @param string $base path WWW_PATH/
     */
    public static function prepare($path, $base = WWW_PATH) {
        if (file_exists($base . '/'.$path) || empty($path)) return true;

        $dirs = explode('/', $path);
        $path = '/';

        foreach ($dirs as $dir){
            $path .= $dir . '/';
            
            if (file_exists($base . $path))  continue;
            mkdir($base . $path, 0775);
            chmod($base . $path, 0775);

            @file_put_contents($base . $path . 'index.html', ' ');
        }
    }

    /**
     * base path WWW_PATH/
     *
     * @param string $path
     * @param string $base path WWW_PATH/
     * @return bool
     */
    public static function clear($path, $base = WWW_PATH) {
        
        if(empty($path) || mb_strlen($path, 'utf-8') < 5){
            throw new t4_FolderException('A fatal error occurred while cleaning folder');
        }
        
        if (!file_exists($base . '/' . $path) || !is_dir($base . '/' . $path))  return false;
       
        $dirHandle = opendir($base . '/' . $path);
        while (false !== ($file = readdir($dirHandle))) {
            if ($file != '.' && $file != '..' && $file != 'index.html' ) {// исключаем папки с назварием '.' и '..'
                $tmpPath = $base . '/' . $path . '/' . $file;
                @chmod($tmpPath, 0777);
                // удаляем файл
                @unlink($tmpPath);
            }
        }
        closedir($dirHandle);
        return true;
    }

    /**
     * base path WWW_PATH/
     *
     * @param string $path
     * @param string $base path WWW_PATH/
     * @return bool
     */
    public static function remove($path, $base = WWW_PATH){
        if(empty($path) || mb_strlen($path, 'utf-8') < 5){
            throw new t4_FolderException('A fatal error occurred while deleting a folder "' . $path . '"');
        }
        
        if(!file_exists($base . '/' . $path)){
            return true;
        }
                
        if(!is_dir($base . '/' . $path)) {
            @unlink($base . '/' . $path);
            return true;
        }
        
        $dirHandle = opendir($base . '/' . $path);
        
        if(!$dirHandle){
            throw new t4_FolderException('A fatal error occurred while deleting a folder "' . $path . '"');
        }
        
        while (false !== ($file = readdir($dirHandle))) {
            if ($file!='.' && $file!='..') {// исключаем папки с назварием '.' и '..'
                $tmpPath = $path . '/' . $file;
                @chmod($base . '/' . $tmpPath, 0777);
               
                if (is_dir($base . '/' . $tmpPath)) {  // если папка
                    self::removeFolder($tmpPath);
                } else {
                    @unlink($base . '/' . $tmpPath);
                }
            }
        }
        closedir($dirHandle);

        if(file_exists($base . '/' . $path)) {
            @chmod($base . '/' . $path, 0777);
            @rmdir($base . '/' . $path);
        }
        return true;
    }

    /**
     * remove folder/
     *
     * @param string $path
     * @return bool
     */
    public static function removeFolder($path){
        if(file_exists($path)) {
            @chmod($path, 0777);
            @rmdir($path);
        }
        return true;
    }

}
