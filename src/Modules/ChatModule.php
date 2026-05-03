<?php

namespace Bayurifkialghifari\WuzApi\Modules;

use Bayurifkialghifari\WuzApi\DTOs\Chat\DownloadMediaRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\DownloadMediaResponse;
use Bayurifkialghifari\WuzApi\DTOs\Chat\HistoryMessage;
use Bayurifkialghifari\WuzApi\DTOs\Chat\ListSection;
use Bayurifkialghifari\WuzApi\DTOs\Chat\MarkReadRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\ReactRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendAudioRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendButtonsRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendContactRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendDocumentRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendImageRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendListRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendLocationRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendMessageResponse;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendPollRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendStickerRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendTemplateRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendTextRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendVideoRequest;
use Bayurifkialghifari\WuzApi\WuzApiClient;

class ChatModule
{
    public function __construct(protected WuzApiClient $client) {}

    public function sendText(SendTextRequest $request, ?string $token = null): SendMessageResponse
    {
        $data = $this->client->post('/chat/send/text', $request->toArray(), $token);

        return SendMessageResponse::fromArray((array) $data);
    }

    public function sendTemplate(SendTemplateRequest $request, ?string $token = null): SendMessageResponse
    {
        $data = $this->client->post('/chat/send/template', $request->toArray(), $token);

        return SendMessageResponse::fromArray((array) $data);
    }

    public function sendAudio(SendAudioRequest $request, ?string $token = null): SendMessageResponse
    {
        $data = $this->client->post('/chat/send/audio', $request->toArray(), $token);

        return SendMessageResponse::fromArray((array) $data);
    }

    public function sendImage(SendImageRequest $request, ?string $token = null): SendMessageResponse
    {
        $data = $this->client->post('/chat/send/image', $request->toArray(), $token);

        return SendMessageResponse::fromArray((array) $data);
    }

    public function sendDocument(SendDocumentRequest $request, ?string $token = null): SendMessageResponse
    {
        $data = $this->client->post('/chat/send/document', $request->toArray(), $token);

        return SendMessageResponse::fromArray((array) $data);
    }

    public function sendVideo(SendVideoRequest $request, ?string $token = null): SendMessageResponse
    {
        $data = $this->client->post('/chat/send/video', $request->toArray(), $token);

        return SendMessageResponse::fromArray((array) $data);
    }

    public function sendSticker(SendStickerRequest $request, ?string $token = null): SendMessageResponse
    {
        $data = $this->client->post('/chat/send/sticker', $request->toArray(), $token);

        return SendMessageResponse::fromArray((array) $data);
    }

    public function sendLocation(SendLocationRequest $request, ?string $token = null): SendMessageResponse
    {
        $data = $this->client->post('/chat/send/location', $request->toArray(), $token);

        return SendMessageResponse::fromArray((array) $data);
    }

    public function sendContact(SendContactRequest $request, ?string $token = null): SendMessageResponse
    {
        $data = $this->client->post('/chat/send/contact', $request->toArray(), $token);

        return SendMessageResponse::fromArray((array) $data);
    }

    public function sendButtons(SendButtonsRequest $request, ?string $token = null): SendMessageResponse
    {
        $data = $this->client->post('/chat/send/buttons', $request->toArray(), $token);

        return SendMessageResponse::fromArray((array) $data);
    }

    /**
     * @param  ListSection[]  $sections
     */
    public function sendList(
        string $phone,
        string $buttonText,
        string $desc,
        string $topText,
        array $sections = [],
        ?string $footerText = null,
        ?string $id = null,
        ?string $token = null
    ): SendMessageResponse {
        $request = new SendListRequest($phone, $buttonText, $desc, $topText, $sections, $footerText, $id);
        $data = $this->client->post('/chat/send/list', $request->toArray(), $token);

        return SendMessageResponse::fromArray((array) $data);
    }

    /**
     * @param  string[]  $options
     */
    public function sendPoll(
        string $groupJid,
        string $header,
        array $options,
        ?string $id = null,
        ?string $token = null
    ): SendMessageResponse {
        $request = new SendPollRequest($groupJid, $header, $options, $id);
        $data = $this->client->post('/chat/send/poll', $request->toArray(), $token);

        return SendMessageResponse::fromArray((array) $data);
    }

    public function sendPresence(string $phone, string $state, ?string $media = null, ?string $token = null): void
    {
        $payload = array_filter(['Phone' => $phone, 'State' => $state, 'Media' => $media], fn ($v) => $v !== null);
        $this->client->post('/chat/presence', $payload, $token);
    }

    public function markRead(MarkReadRequest $request, ?string $token = null): array
    {
        return (array) $this->client->post('/chat/markread', $request->toArray(), $token);
    }

    public function react(ReactRequest $request, ?string $token = null): SendMessageResponse
    {
        $data = $this->client->post('/chat/react', $request->toArray(), $token);

        return SendMessageResponse::fromArray((array) $data);
    }

    public function deleteMessage(string $messageId, ?string $token = null): array
    {
        return (array) $this->client->post('/chat/delete', ['Id' => $messageId], $token);
    }

    public function editMessage(string $messageId, string $phone, string $newBody, ?string $token = null): SendMessageResponse
    {
        $data = $this->client->post('/chat/send/edit', ['Id' => $messageId, 'Phone' => $phone, 'Body' => $newBody], $token);

        return SendMessageResponse::fromArray((array) $data);
    }

    public function downloadImage(DownloadMediaRequest $request, ?string $token = null): DownloadMediaResponse
    {
        $data = $this->client->post('/chat/downloadimage', $request->toArray(), $token);

        return DownloadMediaResponse::fromArray((array) $data);
    }

    public function downloadVideo(DownloadMediaRequest $request, ?string $token = null): DownloadMediaResponse
    {
        $data = $this->client->post('/chat/downloadvideo', $request->toArray(), $token);

        return DownloadMediaResponse::fromArray((array) $data);
    }

    public function downloadAudio(DownloadMediaRequest $request, ?string $token = null): DownloadMediaResponse
    {
        $data = $this->client->post('/chat/downloadaudio', $request->toArray(), $token);

        return DownloadMediaResponse::fromArray((array) $data);
    }

    public function downloadDocument(DownloadMediaRequest $request, ?string $token = null): DownloadMediaResponse
    {
        $data = $this->client->post('/chat/downloaddocument', $request->toArray(), $token);

        return DownloadMediaResponse::fromArray((array) $data);
    }

    public function downloadSticker(DownloadMediaRequest $request, ?string $token = null): DownloadMediaResponse
    {
        $data = $this->client->post('/chat/downloadsticker', $request->toArray(), $token);

        return DownloadMediaResponse::fromArray((array) $data);
    }

    /**
     * @return HistoryMessage[]
     */
    public function getChatHistory(string $chatJid, ?int $limit = null, ?string $token = null): array
    {
        $query = ['chat_jid' => $chatJid];
        if ($limit !== null) {
            $query['limit'] = $limit;
        }
        $data = $this->client->get('/chat/history', $query, $token);

        return array_map(fn (array $m) => HistoryMessage::fromArray($m), (array) $data);
    }

    public function requestUnavailableMessage(string $chat, string $sender, string $messageId, ?string $token = null): array
    {
        return (array) $this->client->post('/chat/request-unavailable-message', [
            'chat' => $chat,
            'sender' => $sender,
            'id' => $messageId,
        ], $token);
    }

    public function archiveChat(string $jid, bool $archive, ?string $token = null): array
    {
        return (array) $this->client->post('/chat/archive', ['jid' => $jid, 'archive' => $archive], $token);
    }
}
