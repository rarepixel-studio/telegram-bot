<?php

namespace Telegram\Bot\Enums;

enum ParseMode: string
{
    case HTML = 'HTML';
    case Markdown = 'Markdown';
    case MarkdownV2 = 'MarkdownV2';
}
