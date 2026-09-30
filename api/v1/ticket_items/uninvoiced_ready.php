<?php

require_once('../validate_api_key.php');
require_once('../require_get_method.php');

$ticket_status = intval($_GET['ticket_status'] ?? 4);

$client_filter = "";
if (isset($client_id) && $client_id !== "%") {
    $client_filter = "AND tickets.ticket_client_id = " . intval($client_id);
}

$sql = mysqli_query(
    $mysqli,
    "SELECT
        tickets.ticket_id AS ticket_id,
        tickets.ticket_client_id AS client_id,
        clients.client_name AS client_name
    FROM ticket_items
    INNER JOIN tickets ON ticket_items.ticket_item_ticket_id = tickets.ticket_id
    INNER JOIN clients ON tickets.ticket_client_id = clients.client_id
    WHERE ticket_items.ticket_item_invoiced_at IS NULL
      AND tickets.ticket_status = $ticket_status
      $client_filter
    GROUP BY tickets.ticket_id, tickets.ticket_client_id, clients.client_name
    ORDER BY tickets.ticket_id DESC
    LIMIT $limit OFFSET $offset"
);

require_once('../read_output.php');
