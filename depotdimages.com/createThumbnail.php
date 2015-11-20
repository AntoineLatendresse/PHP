<?php
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
class createThumbnail
{
    /**
     * En - $_FILES['xxxx'] defines the value
     */
    public $image;
    /**
     * En - Extension series which allowed to upload
     */
    public $extensions = array('jpeg', 'jpg', 'png', 'gif');
    /**
     * En - The extension of uploaded pic
     */
    public $extension;
    /**
     * En - The original name of uploaded pic
     */
    public $imageName;
    /**
     * En - New name of uploaded pic
     */
    public $imageNewName = '';
    /**
     * En - New directory of uploaded pic
     */
    public $imageDir = '';
    /**
     * En - Variable that control results transfered
     */
    public $control;
    /** Directory error
     * En - Extension Error
     */
    public $extensionError 	= 'Extention Error.';
    /**
     * En - Upload error
     */
    public $uploadError 	= 'Upload Error.';
    /**
     * En - Transport error
     */
    public $moveUploadError = 'Move Upload Error.';
    /** We are collecting the error messages
     * En - We are collecting the error messages in a variable
     */
    public $error = '';
    /**
     * En - Php Error Messages
     *	   Errors hiding as default currently
     *	   If  you like to see the critic errors you can change the value of variable as E_ALL
     */
    public $phpError = 0;
    /**
     * En - $_FILES['image']['name']
     */
    public $files_image_name;
    /**
     * En - $_FILES['image']['tmp_name']
     */
    public $files_image_tmp_name;
    public function start($image, $i=NULL)
    {
        error_reporting($this->phpError);
        $this->image = $image;
        $this->files_image_name = (isset($i)) ? $this->image['name'][$i] : $this->image['name'];
        $this->files_image_tmp_name = (isset($i)) ? $this->image['tmp_name'][$i] : $this->image['tmp_name'];
        // Resmin uzantısı - Extension of pic
        $this->extension = @end(explode('.', $this->files_image_name));
    }
    /**
     * En -  Extension Control
     *       If uploaded file extension is different than defined extensions than $extension
     *       directory  error value returns.
     */
    public function extensionControl()
    {
        // Uzantı kontrolü - Extension control
        if(in_array($this->extension, $this->extensions))
        {
            $this->control = TRUE;
        }
        else
        {
            $this->control = FALSE;
            $this->error = $this->extensionError;
            echo $this->error;
        }
    }
    /**
     * En - Upload control
     *	   If there is no error in previous control the process continues.
     *	   It controls the upload process if it's successful.
     */
    public function isUpload()
    {
        // Upload Kontrolü - Upload Control
        if($this->control == TRUE)
        {
            if(is_uploaded_file($this->files_image_tmp_name))
            {
                $this->control = TRUE;
            }
            else
            {
                $this->control = FALSE;
                $this->error = $this->uploadError;
                echo $this->error;
            }
        }
    }
    /**
     * En - Assinging the new name of pic
     *
     * @param $name;
     * @example 'yeniresim.jpg'
     */
    public function newName($name)
    {
        $this->imageNewName = $name;
    }
    /**
     * En - Transporting uploaded pic
     * @param $save;
     * @example 'upload/'
     */
    public function moveUpload($save)
    {
        if($this->control == TRUE)
        {
            // En - If file extension won't find we create
            if( ! file_exists($save))
            {
                mkdir($save);
            }
            if($this->imageNewName != '')
            {
                $this->imageDir = $save;
                $move = $this->imageDir.$this->imageNewName;
                if(move_uploaded_file($this->files_image_tmp_name, $move))
                {
                    $this->control = TRUE;
                }
                else
                {
                    $this->control = FALSE;
                    $this->error = $this->moveUploadError;
                    echo $this->error;
                }
            }
        }
    }
    function create_thumbnail($save, $name, $width, $height)
    {
        if($this->control == TRUE)
        {
            // En - We create the directory if there isn't.
            if( ! file_exists($save))
            {
                mkdir($save);
            }
            $save = $save.$name;
            // En - We defining exactly path of pic
            $path = $this->imageDir.$this->imageNewName;
            $info = getimagesize($path);
            $size = array($info[0], $info[1]);
            if($info['mime'] == 'image/jpeg')
            {
                $src = imagecreatefromjpeg($path);
            }
            else if($info['mime'] == 'image/gif')
            {
                $src = imagecreatefromgif($path);
            }
            else if($info['mime'] == 'image/png')
            {
                $src = imagecreatefrompng($path);
            }
            else
            {
                return FALSE;
            }
            $thumb = imagecreatetruecolor($width, $height);
            $src_aspect = $size[0] / $size[1];
            $thumb_aspect = $width / $height;
            if($src_aspect < $thumb_aspect)
            {
                // narrover
                $scale = $width / $size[0];
                $new_size = array( $width, $width/$src_aspect );
                $src_pos = array( 0, ($size[1] * $scale - $height) / $scale / 2 );
            }
            else if($src_aspect > $thumb_aspect)
            {
                // wider
                $scale = $height / $size[1];
                $new_size = array($height * $src_aspect, $height);
                $src_pos  = array(($size[0] * $scale - $width) / $scale / 2, 0);
            }
            else
            {
                // some shape
                $new_size = array($width, $height);
                $src_pos = array(0, 0);
            }
            $new_size[0] = max($new_size[0], 1);
            $new_size[1] = max($new_size[1], 1);
            imagecopyresampled($thumb, $src, 0, 0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $size[0], $size[1]);
            if($save === FALSE)
            {
                return imagejpeg($thumb);
            }
            else
            {
                return imagejpeg($thumb, $save);
            }
        }
    }
    /**
     * En - The sentence that print on screen when all process is successful.
     * @param $sentence;
     * @example 'Resim başarıyla yüklendi!';
     */
    public function result($sentence)
    {
        if($this->control == TRUE)
        {
            echo $sentence;
        }
    }
}