<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 19.12.17
 * Time: 21:33
 */


class SiteError
{

    public function siteErrors(){

        error_reporting(E_ALL );
        ini_set('display_errors', 1);
        ini_set('error_log', $_SERVER['DOCUMENT_ROOT'].'/log/php_fatal_errors.log');

        function siteHandler($level, $message, $file, $line, $context) {

            switch ($level) {
                case E_WARNING:
                    $type = 'Warning';
                    break;
                case E_NOTICE:
                    $type = 'Notice';
                    break;
                default;

                    return false;
            }

            $date = date( 'Y m d H:i:s');
            $errorMessage = $date.' :'.$type.':'. $message.'<br>'.'File :'.$file.' line: '.$line;
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.$date.'_php_errors.log',$errorMessage);
            echo '<div class="col-md-12 alert alert-info page-error">
               <strong>
                   Произошел некритический сбой в работе приложения.<br>
                   Администратор приложения уже приступил к устранению сбоя.<br>
                   Скоро сбой будет устранен.
               </strong>
          </div>';

            return true;
        }

        set_error_handler('siteHandler', E_ALL);

        function shutdown() {
            $error = error_get_last();
            if (
                // если в коде была допущена ошибка
                is_array($error) &&
                // и это одна из фатальных ошибок
                in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])
            ) {
                // очищаем буфер вывода (о нём мы ещё поговорим в последующих статьях)
                while (ob_get_level()) {
                    ob_end_clean();
                }
                // выводим описание проблемы
                echo ' <strong>
                   Сервер находится на техническом обслуживании, зайдите позже.
               </strong>';



                //        var_dump($error);
            }
        }
        register_shutdown_function('shutdown');


    }

}