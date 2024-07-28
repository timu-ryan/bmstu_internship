<?php

class TelegramHTMLConverter {
    public static function convertToHTML($message_text, $entities) {
        $html_text = htmlspecialchars($message_text);

        foreach ($entities as $entity) {
            switch ($entity['type']) {
                case 'bold':
                    $html_text = self::applyTag($html_text, 'b', $entity['offset'], $entity['length']);
                    break;
                case 'italic':
                    $html_text = self::applyTag($html_text, 'i', $entity['offset'], $entity['length']);
                    break;
                case 'underline':
                    $html_text = self::applyTag($html_text, 'u', $entity['offset'], $entity['length']);
                    break;
                case 'strikethrough':
                    $html_text = self::applyTag($html_text, 's', $entity['offset'], $entity['length']);
                    break;
                case 'code':
                    $html_text = self::applyTag($html_text, 'code', $entity['offset'], $entity['length']);
                    break;
                case 'pre':
                    $html_text = self::applyTag($html_text, 'pre', $entity['offset'], $entity['length']);
                    break;
                case 'text_link':
                    $html_text = self::applyLinkTag($html_text, $entity['offset'], $entity['length'], $entity['url']);
                    break;
                case 'hashtag':
                    $html_text = self::applyTag($html_text, 'a', $entity['offset'], $entity['length']);
                    break;
                // Добавьте обработку других типов сущностей по необходимости
            }
        }

        return $html_text;
    }

    private static function applyTag($text, $tag, $offset, $length) {
        return substr_replace($text, '<' . $tag . '>' . substr($text, $offset, $length) . '</' . $tag . '>', $offset, $length);
    }

    private static function applyLinkTag($text, $offset, $length, $url) {
        return substr_replace($text, '<a href="' . $url . '">' . substr($text, $offset, $length) . '</a>', $offset, $length);
    }
}

?>
