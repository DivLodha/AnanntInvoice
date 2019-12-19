<?php
/**
 * Created by PhpStorm.
 * User: danit
 * Date: 12/27/2018
 * Time: 11:34 AM
 */
namespace App\Mandrill;
use App\Mandrill\Mandrill;

class  MandrillMail
{
    private static $instance = NULL;
    function  getInstance(){
        if (self::$instance === NULL)
            self::$instance = new Mandrill('4zCrZSKXRF_qG7mkYBa2Xg');
        return self::$instance;
    }

    /*
     *  // add library in head
     *  use App\Mandrill\MandrillMail;
     *  //get email template
        $mailMessage = view('emails.mental-health')->render();
        // create mailer object
        $mailer = new MandrillMail();
        // pass email information and call  send mail function
        $mailer->mandrillSendMail($_GET['email'],'to name ','New subject message',$mailMessage);
    */
    function  mandrillSendMail($to,$receiver_name="",$subject="Payment Reciept",$message,$from='admin@anannt.com',$template='ajchmails'){
       // include_once 'Mandrill.php';
        $params=array();
        $params['email']=$to;
        $validator = \Validator::make($params,[
            'email' => 'required|email',
        ]);
        if ($validator->fails()){
            return response()->json([ 'errors' => $validator->getMessageBag()->toArray(),'status'=>false,'message'=>"One or more field have errors"],200);
        }
        $mandrilMailerObj = self::getInstance();

        $message = array(
            'from_email' => $from,
            'html' => $message,
            "track_opens" => true,
            "track_clicks" => true,
            'subject' => $subject,
            'to' => array(array('email' => $to, 'name' => $receiver_name)),

        );

        /************Email attachment code Started ***************/
        if(!empty($attachemnts) && count($attachemnts)>=1){
            $message["attachments"] = array();
            $a=1;
            foreach ($attachemnts as $attachemnt){
                $mime_type=$attachment_encoded = $file_name="";
                if(!empty($attachemnt)){
                    $file_name =  basename($attachemnt);
                    $mime_type =  $this->get_mime_type($file_name);
                    $attached_file = file_get_contents($attachemnt);
                    $attachment_encoded = base64_encode($attached_file);
                    $message["attachments"][] = array(
                            'content' => $attachment_encoded,
                            'type' => $mime_type,
                            'name' => $file_name,
                    );
                }
            }
        }
      //  dd( $message["attachments"]);
        /************Email attachment code End ***************/
        $template_name = 'ajchmails';

        $template_content = array(
            array(
                'name' => 'main',
                'content' => 'Hi *|FIRSTNAME|* *|LASTNAME|*, thanks for signing up.'),
            array(
                'name' => 'footer',
                'content' => 'Copyright 2012.')

        );


        /***************************File Attachment*****************************************/
//        $attachment = file_get_contents(WWW_ROOT.'files/downloads/file.pdf');
//        $attachment_encoded = base64_encode($attachment);

//        "attachments" => array(
//            array(
//                'content' => $attachment_encoded,
//                'type' => "application/pdf",
//                'name' => 'file.pdf',
//            )
        /***************************End file Attachment*************************************/
        if(env('Mandrill_Mail')){
            $mandrilMailerObj->messages->sendTemplate($template_name, $template_content, $message);
        }

    }
    function get_mime_type($filename) {
        $idx = explode( '.', $filename );
        $count_explode = count($idx);
        $idx = strtolower($idx[$count_explode-1]);

        $mimet = array(
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'docx' => 'application/msword',
            'xlsx' => 'application/vnd.ms-excel',
            'pptx' => 'application/vnd.ms-powerpoint',


            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        if (isset( $mimet[$idx] )) {
            return $mimet[$idx];
        } else {
            return 'application/octet-stream';
        }
    }

    //function to get the remote data
    function url_get_contents ($url) {
        if (function_exists('curl_exec')){
            $conn = curl_init($url);
            curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($conn, CURLOPT_FRESH_CONNECT,  true);
            curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
            $url_get_contents_data = (curl_exec($conn));
            curl_close($conn);
        }elseif(function_exists('file_get_contents')){
            $url_get_contents_data = file_get_contents($url);
        }elseif(function_exists('fopen') && function_exists('stream_get_contents')){
            $handle = fopen ($url, "r");
            $url_get_contents_data = stream_get_contents($handle);
        }else{
            $url_get_contents_data = false;
        }
        return $url_get_contents_data;
    }
}
