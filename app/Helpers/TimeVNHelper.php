<?php

use Carbon\Carbon;

function diffInTime($oldTime)
{
    // // Tạo đối tượng Carbon từ thời gian hiện tại
    // $now = Carbon::now();

    // // Tạo đối tượng Carbon từ thời gian đã có
    // $oldTime = Carbon::parse($oldTime);

    // // Tính hiệu thời gian giữa hai thời điểm
    // $diffInSeconds = $now->diffInSeconds($oldTime);
    // if ($diffInSeconds < 60) {
    //     return $diffInSeconds . " giây trước";
    // }

    // $diffInMinutes = $now->diffInMinutes($oldTime);
    // if ($diffInMinutes < 60) {
    //     return $diffInMinutes . " phút trước";
    // }

    // $diffInHours = $now->diffInHours($oldTime);
    // if ($diffInHours < 24) {
    //     return $diffInHours . " giờ trước";
    // }

    // $diffInDays = $now->diffInDays($oldTime);
    // if ($diffInDays < 7) {
    //     return $diffInDays . " ngày trước";
    // }

    // $diffInWeeks = $now->diffInWeeks($oldTime);
    // if ($diffInWeeks < 4) {
    //     return $diffInWeeks . " tuần";
    // }

    // $diffInMonths = $now->diffInMonths($oldTime);
    // if ($diffInMonths < 12) {
    //     return $diffInMonths . " tháng";
    // }

    // $diffInYears = $now->diffInYears($oldTime);
    // return $diffInYears . " năm";


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
