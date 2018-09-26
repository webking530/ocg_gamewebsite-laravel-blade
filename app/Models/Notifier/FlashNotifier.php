<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 25/09/18
 * Time: 08:47 PM
 */

namespace Models\Notifier;


use Session;

class FlashNotifier
{
    const FAS_ICONS = [
        'info' => 'fa-info-circle',
        'success' => 'fa-check',
        'danger' => 'fa-times'
    ];

    public function info($message) {
        $this->flash($message, 'info');
    }

    public function success($message) {
        $this->flash($message, 'success');
    }

    public function error($message) {
        $this->flash($message, 'danger');
    }

    private function flash($message, $type) {
        Session::flash('flash_message', $message);
        Session::flash('flash_type', $type);
        Session::flash('flash_icon', self::FAS_ICONS[$type]);
    }
}