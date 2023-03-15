<?php
function countStars($count)
{
    $stars = "";
    $cmp_stars = 0;
    // Full Stars
    for ($i = 1; $i <= $count; $i++) {
        $stars .= "<i class='fa-solid fa-star'></i>";
        $cmp_stars++;
    }
    // Half Start
    $half_star = $count - $cmp_stars;
    if ($half_star < 1 && $half_star > 0) {
        $stars .= "<i class='fa-solid fa-star-half-stroke'></i>";
    }
    // Remaining Starts
    $rem_stars = 5 - $count;
    for ($i = 1; $i <= $rem_stars; $i++) {
        $stars .= "<i class='fa-regular fa-star'></i>";
    }
    return $stars;
}
