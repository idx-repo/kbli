<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kategori".
 *
 * @property int $id
 * @property string $kd
 * @property string $judul
 * @property string|null $deskripsi
 */
class Kategori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kategori';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd', 'judul'], 'required'],
            [['deskripsi'], 'string'],
            [['kd'], 'string', 'max' => 1],
            [['judul'], 'string', 'max' => 200],
            [['kd'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kd' => 'Kd',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
        ];
    }
}
