<?php

use Carbon\Carbon;

function diffInTime($oldTime)
{
    Carbon::setLocale('vi'); // hiển thị ngôn ngữ tiếng việt.

    // Tạo đối tượng Carbon từ thời gian hiện tại
    $now = Carbon::now();

    // Tạo đối tượng Carbon từ thời gian đã có
    $oldTime = Carbon::parse($oldTime);

    $now = Carbon::now();

    if ($now->diffInHours($oldTime) > 24) {
        return $oldTime->format('d/m/Y');
    }
    return  $oldTime->diffForHumans($now);
}
