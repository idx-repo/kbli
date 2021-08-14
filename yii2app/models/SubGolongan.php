<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_gol".
 *
 * @property int $id
 * @property int $gol
 * @property string $sub_gol
 * @property string $judul
 * @property string|null $deskripsi
 */
class SubGolongan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_gol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gol', 'sub_gol', 'judul'], 'required'],
            [['gol'], 'integer'],
            [['deskripsi'], 'string'],
            [['sub_gol'], 'string', 'max' => 4],
            [['judul'], 'string', 'max' => 200],
            [['sub_gol'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gol' => 'Gol',
            'sub_gol' => 'Sub Gol',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
        ];
    }
}
