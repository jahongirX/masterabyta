<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%partnercontact}}".
 *
 * @property int $id
 * @property int $partner_id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $token_cpa_rukiizplech
 * @property string|null $token_cpa_servicelead
 * @property int|null $offer_id_cpa_servicelead
 * @property int|null $thread_id_cpa_servicelead
 */
class Partnercontact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%partnercontact}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['partner_id', 'name'], 'required'],
            [['partner_id'], 'unique'],
            [['partner_id', 'offer_id_cpa_servicelead', 'thread_id_cpa_servicelead'], 'integer', 'min' => 0, 'max' => '1000000000'],
            [['name', 'phone', 'token_cpa_rukiizplech', 'token_cpa_servicelead', 'token_cpa_leadcentre'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partner_id' => 'Partner ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'token_cpa_rukiizplech' => 'Token CPA RukiIzPlech',
            'token_cpa_servicelead' => 'Token CPA ServiceLead',
            'offer_id_cpa_servicelead' => 'Offer id CPA ServiceLead',
            'thread_id_cpa_servicelead' => 'Thread id CPA ServiceLead',
            'token_cpa_leadcentre' => 'Login:Pass of LeadCentre',
        ];
    }
}
