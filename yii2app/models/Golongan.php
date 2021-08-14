<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gol".
 *
 * @property int $id
 * @property int $gol_pok
 * @property string $gol
 * @property string $judul
 * @property string|null $deskripsi
 */
class Golongan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gol_pok', 'gol', 'judul'], 'required'],
            [['gol_pok'], 'integer'],
            [['deskripsi'], 'string'],
            [['gol'], 'string', 'max' => 3],
            [['judul'], 'string', 'max' => 200],
            [['gol'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gol_pok' => 'Gol Pok',
            'gol' => 'Gol',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
        ];
    }
}
