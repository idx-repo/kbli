<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kelompok".
 *
 * @property int $id
 * @property int $sub_gol
 * @property string $kelompok
 * @property string $judul
 * @property string|null $deskripsi
 */
class Kelompok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kelompok';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sub_gol', 'kelompok', 'judul'], 'required'],
            [['sub_gol'], 'integer'],
            [['deskripsi'], 'string'],
            [['kelompok'], 'string', 'max' => 5],
            [['judul'], 'string', 'max' => 200],
            [['kelompok'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sub_gol' => 'Sub Gol',
            'kelompok' => 'Kelompok',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
        ];
    }
}
