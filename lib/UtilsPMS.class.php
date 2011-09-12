<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UtilsPMS
 *
 * @author david
 */
class UtilsPMS {
    //put your code here

    public static function getTicketTypeIcon($type)
    {

        switch ($type) {
            case 'question':
                return image_tag('icons/help.png');
                break;
            case 'bug':
                return image_tag('icons/bug.png');
                break;
            case 'feature':
                return image_tag('icons/plugin.png');
                break;
            case 'internal':
                return image_tag('icons/cog.png');
                break;
            case 'change':
                return image_tag('icons/wrench.png');
                break;
            default:
                break;
        }

    }

    public static function getLinkAttachement($value)
    {
        $string = '';
        $fancybox = '';

        $ar_images = array('jpg','gif','png');

        $type = substr(strstr($value, '.'),1);
        //return $type;

        switch ($type) {
            case in_array($type, $ar_images):

                $string .= image_tag('icons/picture.png') ;
                $fancybox = 'fancybox';
                break;

            case('pdf'):
                $string .= image_tag('icons/page_white_acrobat.png');
                break;

            case('txt'):
                $string .= image_tag('icons/page_white_text.png');
                break;

            case('doc'):
                $string .= image_tag('icons/page_word.png');
                break;

             case('xls'):
                $string .= image_tag('icons/page_excel.png');
                break;

            default:
                $string .= image_tag('icons/page_white_text.png');
                
                break;
        }

        $path = $_SERVER['HTTP_HOST'];
        //echo $path;
        $string .= " <a href='http://$path/uploads/pms/attachements/$value' target='blank' class='pms-doc-link $fancybox'>$value</a>";
        //link_to($value, '../uploads/pms/attachements/'.$value);

        return $string;




    }


}
?>
