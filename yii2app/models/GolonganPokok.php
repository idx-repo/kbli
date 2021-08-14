<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gol_pok".
 *
 * @property int $id
 * @property int $kategori
 * @property string $gol_pok
 * @property string $judul
 * @property string|null $deskripsi
 */
class GolonganPokok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gol_pok';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kategori', 'gol_pok', 'judul'], 'required'],
            [['kategori'], 'integer'],
            [['deskripsi'], 'string'],
            [['gol_pok'], 'string', 'max' => 2],
            [['judul'], 'string', 'max' => 200],
            [['gol_pok'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kategori' => 'Kategori',
            'gol_pok' => 'Gol Pok',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
        ];
    }
}
