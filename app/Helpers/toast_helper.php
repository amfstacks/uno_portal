<?php
if (!function_exists('toast')) {
    function toast($message, $type = 'success') {
        $bg = $type === 'success' ? 'green' : 'red';
        session()->setFlashdata('toast', [
            'message' => $message,
            'type' => $type
        ]);
        
        // echo "


        // <script>
        //     Toastify({
        //         text: '$message',
        //         duration: 3000,
        //         backgroundColor: '$bg',
        //         position: 'right',
        //         gravity: 'top'
        //     }).showToast();
        // </script>";
    }
}
