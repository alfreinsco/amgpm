<?php

if (!function_exists('formatPhoneNumber')) {
    /**
     * Format nomor telepon ke format internasional Indonesia (62)
     *
     * @param string $phoneNumber
     * @return string
     */
    function formatPhoneNumber($phoneNumber)
    {
        // Hapus semua karakter non-digit
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Jika kosong, return kosong
        if (empty($phoneNumber)) {
            return '';
        }

        // Jika dimulai dengan 62, return as is
        if (substr($phoneNumber, 0, 2) === '62') {
            return $phoneNumber;
        }

        // Jika dimulai dengan 0, ganti dengan 62
        if (substr($phoneNumber, 0, 1) === '0') {
            return '62' . substr($phoneNumber, 1);
        }

        // Jika dimulai dengan 8 (tanpa 0), tambahkan 62
        if (substr($phoneNumber, 0, 1) === '8') {
            return '62' . $phoneNumber;
        }

        // Jika format lain, tambahkan 62 di depan
        return '62' . $phoneNumber;
    }
}
