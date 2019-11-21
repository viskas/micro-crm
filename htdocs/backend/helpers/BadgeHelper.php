<?php

namespace backend\helpers;

use backend\models\OrderBalance;
use backend\models\Withdrawal;

use common\models\RequestMessages;
use common\models\ContactUs;
use common\models\Document;
use common\models\Request;

class BadgeHelper
{
    public static function ContactUsCount()
    {
        return ContactUs::find()
            ->where(['status' => ContactUs::STATUS_NEW])
            ->count();
    }

    public static function RequestCount()
    {
        return Request::find()
            ->where(['status' => Request::STATUS_OPENED])
            ->count();
    }

    public static function UnreadStaffMessage($request_id)
    {
        return RequestMessages::find()
            ->where(['request_id' => $request_id, 'staff_id' => null])
            ->andWhere(['status' => RequestMessages::STATUS_UNREAD])
            ->count();
    }

    public static function NewWithdrawal()
    {
        return Withdrawal::find()
            ->andWhere(['status' => 0])
            ->count();
    }

    public static function VerifyDocuments($user_id)
    {
        return Document::find()
            ->where(['user_id' => $user_id, 'status' => Document::STATUS_VERIFY])
            ->count();
    }

    public static function NotVerifyDocuments($user_id)
    {
        return Document::find()
            ->where(['user_id' => $user_id, 'status' => Document::STATUS_NOT_VERIFY])
            ->count();
    }

    public static function DeclineDocuments($user_id)
    {
        return Document::find()
            ->where(['user_id' => $user_id, 'status' => Document::STATUS_DECLINED])
            ->count();
    }

    public static function TotalDocuments()
    {
        return Document::find()
            ->where(['status' => Document::STATUS_NOT_VERIFY])
            ->count();
    }

    public static function NewOrderBalance()
    {
        return OrderBalance::find()
            ->where(['status' => 2])
            ->count();
    }
}