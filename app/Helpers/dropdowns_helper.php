<?php

if (!function_exists('sessionDropdown')) {
    function sessionDropdown($name = 'session', $selected = null, $yearsBack = 2, $yearsForward = 3) {
        $currentYear = (int) date('Y');
        $sessions = [];
        for ($y = $currentYear - $yearsBack; $y <= $currentYear + $yearsForward; $y++) {
            $sessions[] = "$y/" . ($y + 1);
        }

        $html = '<select name="' . esc($name) . '" required class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">';
        $html .= '<option value="">Select Session</option>';
        foreach ($sessions as $sess) {
            $sel = $sess === $selected ? 'selected' : '';
            $html .= '<option value="' . esc($sess) . '" ' . $sel . '>' . esc($sess) . '</option>';
        }
        $html .= '</select>';

        return $html;
    }
}

