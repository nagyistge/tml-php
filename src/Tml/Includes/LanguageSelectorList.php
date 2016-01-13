<?php use Tml\Session;

include dirname(__FILE__)."/"."LanguageSelectorJs.php" ?>

<?php

$style = isset($opts['style']) ? $opts['style'] : '';
$class = isset($opts['class']) ? $opts['class'] : '';
$opts['flag'] = true;

echo "<div id='tml_language_selector' style='$style' class='$class'>";

$languages = Session::application()->languages;
foreach($languages as $lang) {
    echo "<div>";

    if ($lang->locale == tml_current_language()->locale) {
        echo "<div style='float:right; font-weight: bold;font-size: 16px;'>✓</div>";
        echo "<strong>";
    }

    echo "<a href='#' onclick=\"tml_change_locale('" . $lang->locale . "')\">";
    tml_language_name_tag($lang, $opts);
    echo "</a>";

    if ($lang->locale == tml_current_language()->locale) {
        echo "</strong>";
    }

    echo "</div>";
}
echo "</div>";

tml_language_selector_footer_tag($opts);
