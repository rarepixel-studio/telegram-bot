<?php

$file = 'C:\Users\ariab\.gemini\antigravity\brain\7b941aa9-6037-4bbf-86f3-b703ebd90383\.system_generated\steps\82\content.md';
$content = file_get_contents($file);
$json_start = strpos($content, '{');
$json = substr($content, $json_start);
$data = json_decode($json, true);

$objects_to_extract = [
    'User', 'Message', 'Update', 'SentGuestMessage',
    'ChatMemberRestricted', 'ChatPermissions',
    'InputMediaSticker', 'InputMediaLocation', 'InputMediaVenue',
    'PollMedia', 'Poll', 'PollOption',
    'InputPollMedia', 'InputPollOptionMedia', 'InputPollOption',
    'LivePhoto', 'InputMediaLivePhoto', 'ExternalReplyInfo',
    'PaidMediaLivePhoto', 'InputPaidMediaLivePhoto',
    'BotAccessSettings',
];

$methods_to_extract = [
    'answerGuestQuery', 'getChatAdministrators',
    'deleteAllMessageReactions', 'deleteMessageReaction',
    'sendPoll', 'sendLivePhoto', 'sendMediaGroup', 'editMessageMedia',
    'getManagedBotAccessSettings', 'setManagedBotAccessSettings',
    'getUserPersonalChatMessages', 'sendMessageDraft',
];

$output = "## Objects\n\n";
foreach ($objects_to_extract as $obj) {
    if (isset($data['types'][$obj])) {
        $output .= '### '.$obj."\n";
        foreach ($data['types'][$obj]['fields'] as $field) {
            $typeStr = implode('|', $field['types']);
            $required = $field['required'] ? 'Required' : 'Optional';
            $output .= "- {$field['name']} ({$typeStr}, {$required}): {$field['description']}\n";
        }
        $output .= "\n";
    }
}

$output .= "## Methods\n\n";
foreach ($methods_to_extract as $method) {
    if (isset($data['methods'][$method])) {
        $output .= '### '.$method."\n";
        if (isset($data['methods'][$method]['fields'])) {
            foreach ($data['methods'][$method]['fields'] as $field) {
                $typeStr = implode('|', $field['types']);
                $required = $field['required'] ? 'Required' : 'Optional';
                $output .= "- {$field['name']} ({$typeStr}, {$required}): {$field['description']}\n";
            }
        }
        if (isset($data['methods'][$method]['returns'])) {
            $output .= 'Returns: '.implode('|', $data['methods'][$method]['returns'])."\n";
        }
        $output .= "\n";
    }
}

file_put_contents('scratch/changes_extracted.md', $output);
echo "Done extracting\n";
