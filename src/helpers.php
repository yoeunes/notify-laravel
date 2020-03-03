<?php

if (!function_exists('notify')) {
    /**
     * @param string $message
     * @param string $type
     * @param string $title
     * @param array  $options
     *
     * @return \Yoeunes\Notify\NotifyManager
     */
    function notify($message = null, $type = 'success', $title = '', array $options = [])
    {
        if (is_null($message) && 0 === func_num_args()) {
            return app('notify');
        }

        return app('notify')->notification($type, $message, $title, $options);
    }
}
