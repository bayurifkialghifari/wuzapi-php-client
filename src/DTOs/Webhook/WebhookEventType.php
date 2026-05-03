<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Webhook;

enum WebhookEventType: string
{
    case MESSAGE = 'Message';
    case UNDECRYPTABLE_MESSAGE = 'UndecryptableMessage';
    case RECEIPT = 'Receipt';
    case READ_RECEIPT = 'ReadReceipt';
    case MEDIA_RETRY = 'MediaRetry';
    case GROUP_INFO = 'GroupInfo';
    case JOINED_GROUP = 'JoinedGroup';
    case PICTURE = 'Picture';
    case BLOCKLIST_CHANGE = 'BlocklistChange';
    case BLOCKLIST = 'Blocklist';
    case CONNECTED = 'Connected';
    case DISCONNECTED = 'Disconnected';
    case CONNECT_FAILURE = 'ConnectFailure';
    case KEEP_ALIVE_RESTORED = 'KeepAliveRestored';
    case KEEP_ALIVE_TIMEOUT = 'KeepAliveTimeout';
    case LOGGED_OUT = 'LoggedOut';
    case CLIENT_OUTDATED = 'ClientOutdated';
    case TEMPORARY_BAN = 'TemporaryBan';
    case STREAM_ERROR = 'StreamError';
    case STREAM_REPLACED = 'StreamReplaced';
    case PAIR_SUCCESS = 'PairSuccess';
    case PAIR_ERROR = 'PairError';
    case QR = 'QR';
    case QR_SCANNED_WITHOUT_MULTIDEVICE = 'QRScannedWithoutMultidevice';
    case PRIVACY_SETTINGS = 'PrivacySettings';
    case PUSH_NAME_SETTING = 'PushNameSetting';
    case USER_ABOUT = 'UserAbout';
    case APP_STATE = 'AppState';
    case APP_STATE_SYNC_COMPLETE = 'AppStateSyncComplete';
    case HISTORY_SYNC = 'HistorySync';
    case OFFLINE_SYNC_COMPLETED = 'OfflineSyncCompleted';
    case OFFLINE_SYNC_PREVIEW = 'OfflineSyncPreview';
    case CALL_OFFER = 'CallOffer';
    case CALL_ACCEPT = 'CallAccept';
    case CALL_TERMINATE = 'CallTerminate';
    case CALL_OFFER_NOTICE = 'CallOfferNotice';
    case CALL_RELAY_LATENCY = 'CallRelayLatency';
    case PRESENCE = 'Presence';
    case CHAT_PRESENCE = 'ChatPresence';
    case IDENTITY_CHANGE = 'IdentityChange';
    case CAT_REFRESH_ERROR = 'CATRefreshError';
    case NEWSLETTER_JOIN = 'NewsletterJoin';
    case NEWSLETTER_LEAVE = 'NewsletterLeave';
    case NEWSLETTER_MUTE_CHANGE = 'NewsletterMuteChange';
    case NEWSLETTER_LIVE_UPDATE = 'NewsletterLiveUpdate';
    case FB_MESSAGE = 'FBMessage';
    case ALL = 'All';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
