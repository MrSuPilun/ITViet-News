<?php

use Carbon\Carbon;

function diffInTime($oldTime)
{
    // Tạo đối tượng Carbon từ thời gian hiện tại
    $now = Carbon::now();

    // Tạo đối tượng Carbon từ thời gian đã có
    $oldTime = Carbon::parse($oldTime);

    // Tính hiệu thời gian giữa hai thời điểm
    $diffInSeconds = $now->diffInSeconds($oldTime);
    if ($diffInSeconds < 60) {
        return $diffInSeconds . " giây";
    }

    $diffInMinutes = $now->diffInMinutes($oldTime);
    if ($diffInMinutes < 60) {
        return $diffInMinutes . " phút";
    }

    $diffInHours = $now->diffInHours($oldTime);
    if ($diffInHours < 24) {
        return $diffInHours . " giờ";
    }

    $diffInDays = $now->diffInDays($oldTime);
    if ($diffInDays < 7) {
        return $diffInDays . " ngày";
    }

    $diffInWeeks = $now->diffInWeeks($oldTime);
    if ($diffInWeeks < 4) {
        return $diffInWeeks . " tuần";
    }

    $diffInMonths = $now->diffInMonths($oldTime);
    if ($diffInMonths < 12) {
        return $diffInMonths . " tháng";
    }

    $diffInYears = $now->diffInYears($oldTime);
    return $diffInYears . " năm";
}
