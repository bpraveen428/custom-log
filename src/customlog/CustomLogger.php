<?php

namespace Praveen\Customlog;

use Monolog\Logger as Monolog;
use Illuminate\Log\Writer;
use Illuminate\Log\LogServiceProvider as BaseLogServiceProvider;
use Monolog\Handler\StreamHandler;

class CustomLogger extends BaseLogServiceProvider {

    protected function configureHandler(Writer $log) {
        $bubble = false;

        $carbon_today = \Carbon\Carbon::today();
        $year = $carbon_today->year;
        $month = $carbon_today->month;
        $day = $carbon_today->day;


        // Stream Handlers
        $infoStreamHandler = new StreamHandler(storage_path('logs/' . $year . '/' . $month . '/' . $day . '/laravel_info.log'), Monolog::INFO, $bubble);
        $warningStreamHandler = new StreamHandler(storage_path('logs/' . $year . '/' . $month . '/' . $day . '/laravel_warning.log'), Monolog::WARNING, $bubble);
        $errorStreamHandler = new StreamHandler(storage_path('logs/' . $year . '/' . $month . '/' . $day . '/laravel_error.log'), Monolog::ERROR, $bubble);
        $alertStreamHandler = new StreamHandler(storage_path('logs/' . $year . '/' . $month . '/' . $day . '/laravel_alert.log'), Monolog::ALERT, $bubble);
        $criticalStreamHandler = new StreamHandler(storage_path('logs/' . $year . '/' . $month . '/' . $day . '/laravel_critical.log'), Monolog::CRITICAL, $bubble);
        $emergencyStreamHandler = new StreamHandler(storage_path('logs/' . $year . '/' . $month . '/' . $day . '/laravel_emergency.log'), Monolog::EMERGENCY, $bubble);

        // Formatting
        // the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
        $logFormat = "%datetime% [%level_name%] (%channel%): %message% %context% %extra%\n";
        $formatter = new \Monolog\Formatter\LineFormatter($logFormat, null, true, true);
        $infoStreamHandler->setFormatter($formatter);
        $warningStreamHandler->setFormatter($formatter);
        $errorStreamHandler->setFormatter($formatter);
        $alertStreamHandler->setFormatter($formatter);
        $criticalStreamHandler->setFormatter($formatter);
        $emergencyStreamHandler->setFormatter($formatter);



        // Get monolog instance and push handlers
        $monolog = $log->getMonolog();
        $monolog->pushHandler($infoStreamHandler);
        $monolog->pushHandler($warningStreamHandler);
        $monolog->pushHandler($errorStreamHandler);
        $monolog->pushHandler($alertStreamHandler);
        $monolog->pushHandler($criticalStreamHandler);
        $monolog->pushHandler($emergencyStreamHandler);
    }

}
