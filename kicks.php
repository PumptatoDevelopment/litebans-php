<?php
require_once './inc/page.php';

$page = new Page("kicks");

$page->print_title();
$page->print_header();

$page->print_check_form();

$page->table_begin();

$rows = $page->run_query();
foreach ($rows as $row) {
    $player_name = $page->get_name($row['uuid']);
    if ($player_name === null) continue;

    $page->print_table_rows($row, array(
        $page->lang->kicks_player => $page->get_avatar($player_name, $row['uuid']),
        $page->lang->kicks_by     => $page->get_avatar($page->get_banner_name($row), $row['banned_by_uuid']),
        $page->lang->kicks_reason => $page->clean($row['reason']),
        $page->lang->kicks_when   => $page->millis_to_date($row['time']),
    ));
}
$page->table_end();
$page->print_pager();

$page->print_footer();
